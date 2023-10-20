<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Diagnostic
 *
 * @property $diagnosticsId
 * @property $diagnostic
 * @property $date
 * @property $studentId
 * @property $created_at
 * @property $updated_at
 *
 * @property Student $student
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Diagnostic extends Model
{
    
    static $rules = [
		'diagnosticsId' => 'required',
		'diagnostic' => 'required',
		'date' => 'required',
		'studentId' => 'required',
    ];

    protected $perPage = 20;
    protected $primaryKey = 'diagnosticsId';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['diagnosticsId','diagnostic','date','studentId'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function student()
    {
        return $this->hasOne('App\Models\Student', 'studentId', 'studentId');
    }
    

}
