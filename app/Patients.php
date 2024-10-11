<?php

namespace App;
use App\PatientVisit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patients extends Model
{
	    use SoftDeletes;
	    protected $table = 'patients';
    	public function PatientVisit()
	    {
	        return $this->hasMany(PatientVisit::class);
	    }
}
