<?php

namespace App\Enums;

enum UserStatusEnum: string
{
    case Admin = 'admin';
    case Employer = 'employer';
    case JobSeeker = 'job_seeker';


}
