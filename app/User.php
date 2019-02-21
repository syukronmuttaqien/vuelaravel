<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['nickname', 'password', 'lastname', 'email', 'organization', 'firstname', 'lastname'];
}
