@extends('admin.layout.main')
@section('title')Patients @endsection
@section('styles')
    <link href="{{asset('assets/plugins/daterange-picker/css/daterangepicker-bs3.css')}}" rel="stylesheet">
    <style>
        .error{color: red;font-weight: normal!important;}
        #reportrange{cursor: pointer;}
        .daterangepicker .calendar th, .daterangepicker .calendar td{font-family: monospace!important;}
        /*#add_medicine{margin-left: 920px;}*/
        .badge{font-size: 15px;cursor: pointer}
        th,td{text-align: center;}
    </style>
@endsection
@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><b>{{$patient->name}}'s</b> Visit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('patients')}}">Patients</a></li>
                        <li class="breadcrumb-item active">List</li>
                        <li class="breadcrumb-item active">{{$patient->name}}</li>
                        <li  class="breadcrumb-item active">Medicine</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="float-right">
                <a href="{{route('patients.exportCsv', ['id' => $patient->id])}}" class="btn btn-warning btn-sm">
                    <i class="fa-duotone fa-solid fa-download mr-1"></i>Download
                </a>
                <a href="{{route('patients.patients_medicine_form', ['patient_id' => $patient->id])}}" class="btn btn-primary btn-sm">Add Patients Medicine</a>
            </div><br>
            @if(isset($patient_visits) && $patient_visits->isNotEmpty())
                @foreach($patient_visits as $p)
                    <div class="card mt-3">
                        <div class="card-body">
                             <div class="float-right">
                                <a href="{{route('patients.update_medicine_form', ['patient_visit_id' => $p->id , 'patient_id' => $patient->id, 'clone' => true])}}">
                                    <i class="fa-solid fa-clone mr-4 fa-lg"></i>
                                </a>
                                <a href="{{route('patients.update_medicine_form', ['patient_visit_id' => $p->id , 'patient_id' => $patient->id])}}" class=" btn-sm">
                                    <i class="far fa-edit text-success mr-4 fa-lg"></i> 
                                </a>
                                <a id="delete" href="{{ route('patients.delete_patients_visit_medicine', ['patient_visit_id' => $p->id, 'patient_id' => $patient->id]) }}" 
                                   onclick="return confirm('Are You Sure Delete This Visit')">
                                   <i class="fas fa-trash text-danger fa-lg"></i>
                                </a>
                            </div>
                            <h5><b>Date: </b> {{ \Carbon\Carbon::parse($p->date)->format('d-m-Y') }}</h5>
                            <?php if ($p->amount > 0): ?>
                                <h5><b>Amount: </b></i>{{$p->amount}}</h5>
                            <?php endif ?>
                            <h5><b>Note: </b> {{$p->remark}}</h5>
                            @if(isset($p->patients_visit_medicine) && $p->patients_visit_medicine->isNotEmpty())
                                <hr>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Medicine</th>
                                            <th>Power</th>
                                            <th>Count</th>
                                            <th>Timing</th>
                                            <th>Precaution</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1; @endphp
                                        @foreach($p->patients_visit_medicine as $m)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$m->medicine ? $m->medicine->name : '' }}</td>
                                                <td>{{$m->medicine ? $m->medicine->power : ''}}</td>
                                                <td>{{$m->medicine ? $m->count : ''}}</td>
                                                <td>
                                                    @if($m->medicine ? $m->medicine->morning : '')
                                                        <span class="badge bg-primary">Morning</span>
                                                    @endif
                                                
                                                    @if($m->medicine ? $m->medicine->afternoon : '')
                                                        <span class="badge bg-primary">Afternoon</span>
                                                    @endif
                                               
                                                    @if($m->medicine ? $m->medicine->evening : '')
                                                        <span class="badge bg-primary">Evening</span>
                                                    @endif
                                                
                                                    @if($m->medicine ? $m->medicine->night : '')
                                                        <span class="badge bg-primary">Night</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($m->medicine ? $m->medicine->precaution : '')
                                                        <span class="badge  bg-success"> After Eating</span>
                                                    @else
                                                        <span class="badge  bg-info">Before Eating</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="card mt-3">
                    <div class="card-body">
                        <h5><b>Date:</b></h5>
                        <h5><b>Amount :</b> </h5>
                        <h5><b>Note :</b> </h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Medicine</th>
                                    <th>Power</th>
                                    <th>Timing</th>
                                    <th>Precaution</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $("#precaution").val("{{@$_GET['precaution']}}");
        $(document).ready(function(){
            $(".sidebar .nav-link").removeClass('active');
            $(".peshant-link").addClass('active');
        });
    </script>
@endsection