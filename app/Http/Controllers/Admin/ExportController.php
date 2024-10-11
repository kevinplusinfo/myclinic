<?php
namespace App\Http\Controllers\Admin;

use App\Patients;
use App\PatientsMedicine;
use App\Medicine;
use App\PatientVisit;
use App\Http\Controllers\Controller;

class ExportController extends Controller
{
    public function exportCsv($id)
    {
        $patient = Patients::findOrFail($id);
        $patient_visits = PatientVisit::where('patient_id', $id)
                                        ->with('patients_visit_medicine.medicine') 
                                        ->orderByDesc('id')
                                        ->get();

        $fileName = "patient_{$patient->id}_data.csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
        ];

        return response()->stream(function () use ($patient, $patient_visits) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ["Name: {$patient->name}"]);
            foreach ($patient_visits as $visit) {
                fputcsv($file, []); 
                fputcsv($file, ["Date: " . ($visit->date ? \Carbon\Carbon::parse($visit->date)->format('d-m-Y') : '')]);
                fputcsv($file, ["Amount: {$visit->amount}"]);
                fputcsv($file, ["Note: {$visit->remark}"]);

                if ($visit->patients_visit_medicine->isNotEmpty()) {
                    fputcsv($file, ['#', 'Medicine', 'Power', 'Count', 'Timing', 'Precaution']);

                    $i = 1;
                    foreach ($visit->patients_visit_medicine as $patient_visit_medicine) {
                        $medicine = $patient_visit_medicine->medicine;

                        $timing = [];
                        if ($medicine->morning) $timing[] = 'Morning';
                        if ($medicine->afternoon) $timing[] = 'Afternoon';
                        if ($medicine->evening) $timing[] = 'Evening';
                        if ($medicine->night) $timing[] = 'Night';

                        $precaution = $medicine->precaution ? 'After Eating' : 'Before Eating';

                        fputcsv($file, [
                            $i++,
                            $medicine->name,
                            $medicine->power,
                            $patient_visit_medicine->count,
                            implode(', ', $timing),  
                            $precaution
                        ]);
                    }
                }
            }

            fclose($file);
        }, 200, $headers);
    }
}
