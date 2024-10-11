<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\PatientVisit;
use App\Patients;

class PatientsMedicine extends Model
{
  	protected $table = 'patients_visit_medicine';

    public function medicine()
    {
        return $this->hasOne(Medicine::class, 'id', 'medicine_id');
    }
}
