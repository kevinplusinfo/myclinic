<?php

namespace App\Http\Controllers\admin;
use App\Medicine;
use App\PatientsMedicine;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function medicine(Request $request ){
        $medicine = Medicine::query(); 
        if ($request->filled('name')) {
            $medicine->where('name', 'like', '%'.$request->name.'%'); 
        }
        if ($request->filled('power')) {
            $medicine->where('power', $request->power); 
        }
        if ($request->filled('precaution')) {
            $medicine->where('precaution', $request->precaution);
        }
        $medicine = $medicine->paginate(30);
	   return view('admin.Medicine.Medicine', ['medicine' => $medicine ]);
    }
    public function form(){
    	return view('admin.Medicine.Add');
    }
    public function add(Request $request , $id = NUll){
        if($id) {
            $medicines = medicine::find($id);
            $msg = "Medicine Updated Successfully...";
        }
        else{
    	    $medicines = new Medicine;
            $msg = "Medicine Added Successfully...";
        }
        $medicines->name = $request->input('name');
        $medicines->power = $request->input('power');
        $medicines->morning = isset($request['morning']) && $request['morning'] !== null ? 1 : 0;
        $medicines->afternoon = isset($request['afternoon']) && $request['afternoon'] !== null ? 1 : 0;
        $medicines->evening = isset($request['evening']) && $request['evening'] !== null ? 1 : 0;
        $medicines->night = isset($request['night']) && $request['night'] !== null ? 1 : 0;
        $medicines->precaution  = $request['precaution'];   
        $medicines->save();
        return redirect()->route('medicine')->with('alert_success', $msg);
    }
    public function update($id){
        $medicine =  medicine::find($id);
        return view('admin.Medicine.Add' , ['medicine' => $medicine]);
    }
    public function delete($id){
        $check_medicine = PatientsMedicine::where('medicine_id' , $id)->get();

        if ($check_medicine->isNotEmpty()) {
            $msg = "This Medicine Cannot Be Deleted Because It Is Associated With a Patient.";
            return redirect()->route('medicine')->with('alert_error', $msg); 
        } 
        else {
            $medicine = Medicine::find($id);
            if ($medicine) {
                $medicine->delete();
                $msg = "Medicine Deleted Successfully.";
            } else {
                $msg = "Medicine not found.";
            }
            return redirect()->route('medicine')->with('alert_success', $msg); 
        }
    }
    public function trash(Request $request){
        $trash_medicine = Medicine::onlyTrashed(); 
        if ($request->filled('name')) {
            $medicine->where('name', 'like', '%'.$request->name.'%'); 
        }
        if ($request->filled('power')) {
            $medicine->where('power', $request->power); 
        }
        if ($request->filled('precaution')) {
            $medicine->where('precaution', $request->precaution);
        }
        $trash_medicine = $trash_medicine->paginate(30);
        return view('admin.Medicine.Medicine', ['trash_medicine' => $trash_medicine ]);
    }
    public function restore($id)
    {
        $medicine = Medicine::onlyTrashed()->findOrFail($id);
        $medicine->restore();
        $msg = "Medicine Restore Successfully..";
        return redirect()->back()->with('alert_success', $msg);
    }
}


