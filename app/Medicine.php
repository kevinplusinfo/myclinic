<?php

namespace App;
use App\PatientsMedicine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicine extends Model
{
    use SoftDeletes;
    protected $table = 'medicine';
     public function PatientsMedicine()
    {
        return $this->hasMany(PatientsMedicine::class);
    }
}
