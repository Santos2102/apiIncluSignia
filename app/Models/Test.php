<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $table = 'tests';
    protected $fillable = ['testId','level','score','dateTime','studentId','created_at','updated_at'];
    protected $primaryKey = 'testId';

    public function student(){
        return $this->belongsTo('App\Models\Student','studentId','studentId');
    }
}
