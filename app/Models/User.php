<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserStatusEnum;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Spatie\Permission\Traits\HasRoles;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
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

    protected $casts =[
        'status' => UserStatusEnum::class,  
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
    public function Employer()
    {
        return $this->hasOne(Employer::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->hasRole('admin') && $this->status === 'admin';
        }

        if ($panel->getId() === 'employer') {
            return $this->hasRole('employer') && $this->status === 'employer';
        }
        if ($panel->getId() === 'jobseeker') {
            return $this->hasRole('jobseeker') && $this->status === 'jobseeker';
        }

        return false;
        /*
        return match ($panel->getId()) {
                    'admin'     => $this->hasRole('admin'),
                    'employer'  => $this->hasRole('employer'),
                    'jobseeker' => $this->hasRole('jobseeker'),
                    default     => false,
                };    
        */
    }

}
