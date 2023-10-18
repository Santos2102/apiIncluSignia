<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = 'persons';
    protected $primaryKey = 'personId';
    protected $fillable = ['personId','name','lastName','cui','birthDate','age','created_at','updated_at'];
    
    public function students(){
        return $this -> HasMany('App\Models\Student');
    }

    public function teachers(){
        return $this -> HasMany('App\Models\Teacher');
    }
}
