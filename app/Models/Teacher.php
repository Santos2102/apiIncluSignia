<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Teacher
 *
 * @property $teacherId
 * @property $status
 * @property $personId
 * @property $roleId
 * @property $created_at
 * @property $updated_at
 *
 * @property Person $person
 * @property Role $role
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Teacher extends Model
{
    
    static $rules = [
		'teacherId' => 'required',
		'status' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['teacherId','status','personId','email','created_at', 'updated_at'];
    protected $primaryKey = 'teacherId';

    public function person()
    {
        return $this->hasOne('App\Models\Person', 'personId', 'personId');
    }

    public function students(){
      return $this->hasMany('App\Models\Student');
  }
}