<?php

namespace App\Enums;

use \Filament\Support\Contracts\HasLabel;
use \Filament\Support\Contracts\HasColor;

enum UserStatusEnum: string implements HasLabel, HasColor
{
    case admin = 'admin';
    case Employer = 'Employer';
    case JobSeeker = 'JobSeeker';

    public function getLabel(): string
    {
        return $this->value;
    }

    public function getColor(): string
    {
        return match($this) {
            self::admin => 'danger',
            self::Employer => 'warning',
            self::JobSeeker => 'success',
            default => 'gray',
        };
    }
}

