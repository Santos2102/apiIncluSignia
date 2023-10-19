<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeControl extends Model
{
    use HasFactory;
    protected $table = 'codesControl';
    protected $primaryKey = 'controlId';
    protected $fillable = ['controlId', 'code', 'disabilityId', 'created_at', 'updated_at'];

    public function disability(){
        return $this -> belongsTo('App\Models\Disability','disabilityId', 'disabilityId');
    }
}
