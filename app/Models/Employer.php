<?php

namespace App\Models;

use Database\Factories\EmployerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Employer extends Model
{
    /** @use HasFactory<EmployerFactory> */
    use HasFactory , Notifiable;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'website',
        'logo',
    ];

    protected $table = 'employers';

    public function getDashboardUrl(): string
    {
        $locale = app()->getLocale();

        // Route to the Admin panel
        if ($this->IsAdmin()) {
            // You can use url('/Admin') or the exact route name if you prefer
            return url($locale.'/Admin');
        }

        // Route to the Employer panel
        if ($this->IsEmployer()) {
            return url($locale.'/Employer');
        }

        // Fallback for regular users (e.g., job seekers)
        return url($locale.'/');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function job(): HasMany
    {
        return $this->hasMany(Job::class);
    }
}
