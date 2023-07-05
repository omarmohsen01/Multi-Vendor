<?php

namespace App\Models;

use App\Concerns\HasRolles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Admin extends User
{
    use HasFactory,Notifiable,HasRolles;

    protected $fillable=[
        'name','email','password','phone_number','super_admin','status'
    ];
    
    
}