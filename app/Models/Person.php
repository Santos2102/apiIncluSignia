<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = 'persons';
    protected $fillable = ['personId','name','lastName','cui','birthDate','age','created_at','updated_at'];
    protected $primaryKey = 'personId';

    public function students(){
        return $this->hasMany('App\Models\Student');
    }

    public function teachers(){
        return $this->hasMany('App\Models\Teacher');
    }
}
