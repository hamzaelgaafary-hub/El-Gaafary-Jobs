# ---- Stage 1: build frontend assets (Vite + Tailwind) ----
FROM node:20-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY resources/ resources/
COPY vite.config.js ./
RUN npm run build

# ---- Stage 2: application image ----
# نفس الصورة المستخدمة في مثال Render الرسمي لـ Laravel
FROM richarvey/nginx-php-fpm:3.1.6

COPY . .
# ننسخ نتيجة بناء Vite من المرحلة الأولى فوق أي public/build قديم
COPY --from=assets /app/public/build ./public/build

# صلاحية كتابة لازمة لـ storage وbootstrap/cache (مستخدم nginx-php-fpm الداخلي: nginx)
RUN chown -R nginx:nginx /var/www/html/storage /var/www/html/bootstrap/cache

# إعدادات صورة nginx-php-fpm
ENV SKIP_COMPOSER=1
ENV WEBROOT=/var/www/html/public
ENV PHP_ERRORS_STDERR=1
ENV RUN_SCRIPTS=1
ENV REAL_IP_HEADER=1

# إعدادات Laravel للإنتاج
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr

# السماح لـ Composer بالعمل كـ root داخل الحاوية
ENV COMPOSER_ALLOW_SUPERUSER=1

CMD ["/start.sh"]
