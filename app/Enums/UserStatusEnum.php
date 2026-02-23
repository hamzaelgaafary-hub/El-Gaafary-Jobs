<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum UserStatusEnum: string implements HasColor, HasLabel
{
    case Admin = 'Admin';
    case Employer = 'Employer';
    case JobSeeker = 'JobSeeker';

    public function getLabel(): string
    {
        return $this->value;
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Admin => 'danger',
            self::Employer => 'warning',
            self::JobSeeker => 'success',
            default => 'gray',
        };
    }
}
