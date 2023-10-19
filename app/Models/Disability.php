<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disability extends Model
{
    use HasFactory;
    protected $table = "disabilities";
    protected $primaryKey = "disabilityId";
    protected $fillable = ['disabilityId', 'disabilityName','created_at', 'updated_at'];

    public function students(){
        return $this -> hasMany('App\Models\Student');
    }

    public function codeControl(){
        return $this -> hasMany('App\Models\CodeControl');
    }
}
