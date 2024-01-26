<?php

namespace App\Enums;

enum ApplicationStatus: string
{
    case RECOMMENDED = 'Qualify For Admission';
    case PENDING = '';
    case SHORTLISTED = 'shortlisted';
}
