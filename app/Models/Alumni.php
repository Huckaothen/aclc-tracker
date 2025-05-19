<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Alumni extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $table = 'alumni';

    protected $fillable = [
        'email',
        'password',
        'college_id',
        'fullname',
        'contact',
        'dob',
        'address',
        'gender',
        'civil_status',
        'batch',
        'graduated_course',
        'employability_status',
        'company_name',
        'profile_picture',
        'status',
        'email_verified_at',
        'github_link',
        'facebook_link',
        'twitter_link',
        'linkedin_link',
        'verification_token',
    ];

    protected $hidden = [
        'password',
        'verification_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'date',
        'password' => 'hashed',
    ];

    public function jobs()
    {
        return $this->hasMany(AlumniJob::class, 'alumni_id');
    }
}