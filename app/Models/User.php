<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable, Uuid;

    const ACADEMIC_STAFF = 'ACADEMIC_STAFF',
        STUDENT = 'STUDENT',
        STUDY_PROGRAM_LEADER = 'STUDY_PROGRAM_LEADER',
        LECTURER = 'LECTURER';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     *
     */
    protected $fillable = [
        'full_name',
        'username',
        'email',
        'password',
        'level',
        'avatar',
        'registration_number'
    ];

    public $incrementing = false;

    public function studentProfile()
    {
        return $this->hasOne(Student::class, 'nim', 'registration_number');
    }

    public function lecturerProfile()
    {
        return $this->hasOne(Lecturer::class, 'nidn', 'registration_number');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
