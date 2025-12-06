<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\user;
use App\Models\job;

class employer extends Model
{
    /** @use HasFactory<\Database\Factories\EmployerFactory> */
    use HasFactory;

    protected $fillable = [];

    protected $taple = 'employer';

    public function user(): belongsTo
    {
        return $this->belongsTo(user::class);
    }
    public function job(): hasMany
    {
        return $this->hasMany(job::class);
    }
}
