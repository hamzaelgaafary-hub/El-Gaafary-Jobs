<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Employer extends Model
{
    /** @use HasFactory<\Database\Factories\EmployerFactory> */
    use HasFactory, HasRoles, Notifiable;

    protected $fillable = [
        'user_id',
        'name',
        'website',
        'description',
        'logo',
    ];

    protected $table = 'Employers';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function job(): HasMany
    {
        return $this->hasMany(Job::class);
    }
    
}
