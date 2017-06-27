<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleAuth extends Model
{
    protected $connection='mysql_paper';
    protected $table = 'T_AS_ROLEAUTH';
    protected $primaryKey = 'id';
}
