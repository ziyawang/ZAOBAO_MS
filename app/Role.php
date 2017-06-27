<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $connection='mysql_paper';
    protected $table = 'T_AS_ROLE';
    protected $primaryKey = 'id';
}
