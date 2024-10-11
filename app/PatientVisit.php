<?php

namespace App;
use App\PatientVisit;
use App\Patients;
use App\PatientsMedicine;

use Illuminate\Database\Eloquent\Model;

class PatientVisit extends Model
{
	protected $table = 'patients_visit';
	
	public function patient()
	{
    	return $this->belongsTo(Patients::class, 'patient_id', 'id');
	}
	
	public function patients_visit_medicine()
	{
    	return $this->hasMany(PatientsMedicine::class, 'patients_visit_id', 'id');
	}
}