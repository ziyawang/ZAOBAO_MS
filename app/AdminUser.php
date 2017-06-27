<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    protected $connection='mysql_paper';
    protected $table = 'T_AS_USER';
    protected $primaryKey = 'id';
}
