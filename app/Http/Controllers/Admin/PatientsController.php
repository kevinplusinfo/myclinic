<?php

namespace App\Http\Controllers\Admin;
use App\Patients;
use App\PatientsMedicine;
use App\Medicine;
use App\PatientVisit;
use Carbon\Carbon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
	public function patients(Request $request)
    {
		$patients = Patients::query(); 
        if ($request->filled('name')) {
            $patients->where('name', 'like', '%'.$request->name.'%'); 
        }
        $patients = $patients->orderByDesc('id')
                            ->paginate(30);
// $patients = Patients::onlyTrashed()->orderByDesc('id')->paginate(30);
        

	   	return view('admin.Patients.Patients', ['patients' => $patients]);
	}

	public function checkusername(Request $request)
    {
        $name = $request->input('name');
        $id = $request->input('id');
        if($id){
        	$exists = Patients::where('name', $name)
		                  ->where('id', '!=', $id)
		                  ->exists();
        }
        else{
        	$exists = Patients::where('name', $name) ->exists();
        }
	    return response()->json(['valid' => !$exists]);
    }

	public function add(Request $request)
    {
		$id = $request->id;
		if ($id) {
            $msg = "Patients Name Updated Successfully...";
            $patients = Patients::find($id);
		}
		else{
			$patients = new Patients;
            $msg = "Patients Name Added Successfully...";
		}
		$patients->name = $request->input('name');
		$patients->save();
        return redirect()->route('patients')->with('alert_success', $msg);
	}
	  
	public function delete(int $id)
    {
        $patients =  Patients::find($id)->delete();
     	$msg = "Patients Delete Successfully...";
        return redirect()->route('patients')->with('alert_success', $msg);
    }

    public function patient_medicine(Request $request , $id)
    {
        $patient = Patients::findOrFail($id);
        $patient_visits = PatientVisit::where('patient_id', $id)
                                    ->orderByDesc('id')
                                    ->get();
        foreach ($patient_visits as $key => $visit) {
            foreach ($visit->patients_visit_medicine as $key => $patient_visit_medicine) {
            }
        }
        return view('admin.Patients.PatientsMedicine',compact('patient_visits','patient'));
    }

    public function patients_medicine_form(int $id)
    {
        $medicine = Medicine::get(); 
        $patient = Patients::findOrFail($id);
        return view('admin.Patients.AddPatientsMedicine' ,["medicine" => $medicine, 'patient' => $patient ]);
    }

    public function add_patients_medicine(Request $request , $patient_id)
    {   
        if ($request->filled('id') && !$request->filled('clone')) {
            $patientvisit = PatientVisit::find($request->id);
            $msg = "Medicine Updated Successfully...";
        } else {
            $patientvisit = new PatientVisit;
            $msg = "Medicine Added Successfully...";
        }
        $patientvisit->date = date("Y-m-d");
        $patientvisit->amount = $request->input('amount'); 
        $patientvisit->remark = $request->input('remark'); 
        $patientvisit->patient_id = $patient_id; 
        $patientvisit->save();
        $patientvisitid = $patientvisit->id;

        if ($request->filled('id') && !$request->filled('clone')) {
            PatientsMedicine::where('patients_visit_id', $patientvisitid)->delete();
        }
        if ($request->filled('medicine')){
            $medicineCount = count($request->input('medicine'));
            for ($i = 0; $i < $medicineCount; $i++) {
                if (!empty($request->input('medicine')[$i]) && is_numeric($request->input('medicine')[$i])) {
                    $patientsmedicine = new PatientsMedicine;
                    $patientsmedicine->medicine_id = $request->input('medicine')[$i];
                    $patientsmedicine->count = $request->input('count')[$i];
                    $patientsmedicine->patients_visit_id = $patientvisitid;
                    $patientsmedicine->save();
                }
            }
        }
        return redirect()->route('patients.patient_medicine', ['id' => $patient_id])->with('alert_success', $msg);
    }

    public function delete_patients_visit_medicine($id , $patient_id)
    {
        $delete_patient_visit =  PatientVisit::find($id)->delete();
        $delete_patients_visit_medicine = PatientsMedicine::where('patients_visit_id', $id)->delete();
        $msg = "Patients Visit Delete Sccessfully...";
        return redirect()->route('patients.patient_medicine', ['id' => $patient_id])->with('alert_success', $msg);
    }

    public function update_medicine_form (Request $request , $patient_id , $patient_visit_id)
    {
        $medicine = Medicine::get(); 
        $patient = Patients::findOrFail($patient_id);
        $patient_visit = PatientVisit::where('id', $patient_visit_id)
                                    ->orderByDesc('id')
                                    ->get();
        return view('admin.Patients.AddPatientsMedicine' ,["medicine" => $medicine, 'patient' => $patient , 'patient_visit' => $patient_visit]);
    }
}
