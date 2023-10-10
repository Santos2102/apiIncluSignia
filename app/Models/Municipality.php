<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;

    protected $table = "municipalities";
    protected $fillable=['municipalityId','municipalityName','departmentId','status','created_at','updated_at'];

    public function departments(){
        return $this->belongsTo('App\Models\Department','departmentId','departmentId');
    }
}
