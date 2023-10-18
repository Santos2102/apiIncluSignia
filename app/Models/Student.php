<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = ['studentId','code','grade','status','disabilityId','personId','created_at','updated_at'];
    protected $primaryKey = 'studentId';
    
    public function disability(){
        return $this->belongsTo('App\Models\Disability','disabilityId','disabilityId');
    }

    public function person(){
        return $this->belongsTo('App\Models\Person','personId','personId');
    }
}
