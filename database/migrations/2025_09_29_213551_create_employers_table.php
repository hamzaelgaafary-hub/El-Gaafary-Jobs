<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
<<<<<<< HEAD
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(user::class);
            $table->string('name');
=======
        Schema::create('Employers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('website')->nullable();
            $table->text('description')->nullable();
>>>>>>> 328b122 (First commit from New pulled version)
            $table->string('logo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
<<<<<<< HEAD
        Schema::dropIfExists('employers');
=======
        Schema::dropIfExists('Employers');
>>>>>>> 328b122 (First commit from New pulled version)
    }
};
