<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Test
 *
 * @property $testId
 * @property $level
 * @property $score
 * @property $dateTime
 * @property $studentId
 * @property $created_at
 * @property $updated_at
 *
 * @property Student $student
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Test extends Model
{
    
    static $rules = [
		'testId' => 'required',
		'level' => 'required',
		'score' => 'required',
		'dateTime' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['testId','level','score','dateTime','studentId'];
    protected $primaryKey = 'testId';


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function student()
    {
        return $this->hasOne('App\Models\Student', 'studentId', 'studentId');
    }
    

}
