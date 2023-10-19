<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Student
 *
 * @property $studentId
 * @property $code
 * @property $grade
 * @property $direction
 * @property $inscriptionDate
 * @property $status
 * @property $disabilityId
 * @property $personId
 * @property $created_at
 * @property $updated_at
 *
 * @property Diagnostic[] $diagnostics
 * @property Disability $disability
 * @property Person $person
 * @property Test[] $tests
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Student extends Model
{
    
    static $rules = [
		'studentId' => 'required',
		'code' => 'required',
		'grade' => 'required',
		'status' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['studentId','code','grade','status','disabilityId','personId'];
    protected $primaryKey = 'studentId';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function diagnostics()
    {
        return $this->hasMany('App\Models\Diagnostic', 'studentId', 'studentId');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function disability()
    {
        return $this->hasOne('App\Models\Disability', 'disabilityId', 'disabilityId');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function person()
    {
        return $this->hasOne('App\Models\Person', 'personId', 'personId');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tests()
    {
        return $this->hasMany('App\Models\Test', 'studentId', 'studentId');
    }
    

}
