<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherSchool extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $dateFormat = 'U';

    const DEGREE_ACADEMY = 1;
    const DEGREE_UNDERGRADUATE = 2;
    const DEGREE_MASTER = 3;
    const DEGREE_DOCTOR = 4;
}
