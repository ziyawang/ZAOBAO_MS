<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $connection='mysql_paper';
    protected $table = 'T_AS_USERROLE';
    protected $primaryKey = 'id';
}
