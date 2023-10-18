<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = ['roleId', 'roleName','created_at', 'updated_at'];
    protected $primaryKey ='roleId';

    public function users(){
        return $this->hasMany('App\Models\User');
    }

    public function teachers(){
        return $this->hasMany('App\Models\Teacher');
    }
}
