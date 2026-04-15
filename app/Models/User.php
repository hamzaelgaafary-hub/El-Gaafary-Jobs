<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserStatusEnum;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'type',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'status' => UserStatusEnum::class,
        'locale' => 'string',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function Employer(): HasMany
    {
        return $this->hasMany(Employer::class);
    }

    public function IsEmployer()
    {
        return $this->type === 'Employer' || $this->email === 'Employer@Employer.com';
    }

    public function IsAdmin(): bool
    {
        return $this->type === 'Admin';
    }

    public function IsJobSeeker(): bool
    {
        return $this->type === 'JobSeeker';
    }

    /**
     * Get the correct dashboard URL for the user.
     */
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

    public function canAccessPanel(Panel $panel): bool
    {
        /*
        dd($panel->getId() .' '. $this->type);
        if ($panel->getId() === 'Admin') {
            return $this->type === 'Admin';
        }

        if ($panel->getId() === 'Employer') {
            return $this->type === 'Employer';
        }

        if ($panel->getId() === 'jobseeker') {
            return $this->type === 'JobSeeker';
        }

        return false;
        */
      //dd($panel->getId() .' '. $this->type);
         return true ; // --- IGNORE ---
    }
}
