<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    use HasFactory;
    protected $table = 'diagnostics';
    protected $fillable = ['diagnosticsId','diagnostic','date','studentId','created_at','updated_at'];
    protected $primaryKey = 'diagnosticsId';

    public function students(){
        return $this->hasMany('App\Models\Student');
    }
}
