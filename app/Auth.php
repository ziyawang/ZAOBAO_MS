<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
    protected $connection='mysql_paper';
    protected $table = 'T_AS_AUTH';
    protected $primaryKey = 'Auth_ID';
}
