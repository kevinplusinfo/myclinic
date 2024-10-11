@extends('admin.layout.main')
@section('title')Patients @endsection
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .error{color: red;font-weight: normal!important;}
    #reportrange{cursor: pointer;}
    .daterangepicker .calendar th, .daterangepicker .calendar td{font-family: monospace!important;}
    #add_medicine{margin-left: 950px;}
    .cursor-pointer{cursor: pointer;}
    .select2-container .select2-selection--single{height: 40px!important;}
    #remove_btn{margin-top: 34px;}
</style>
@endsection
@section('content-header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>{{$patient->name}}</b> Medicine</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('patients')}}">Patients</a></li>
                    <li class="breadcrumb-item active">List</li>
                    <li class="breadcrumb-item active">{{$patient->name}}</li>
                    <li class="breadcrumb-item active">Medicine</li>
                </ol>
            </div>
        </div>
    </div>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{route('patients.add_patients_medicine',['patient_id' => $patient->id])}}" id="form" method="post">
                    @csrf
                    <?php if (isset($patient_visit)): ?>
                        @foreach($patient_visit as $p)
                            <input type="hidden" name="id" value="{{$p->id}}">
                        @endforeach
                    <?php endif ?>
                    @if(isset($_GET['clone']))
                    <input type="hidden" name="clone" value="1">
                    @endif
                    <div class="d-flex justify-content-end mb-3">
                        <button type="button" id="add" class="btn btn-primary btn-sm" name="add">Add Medicine</button>
                    </div>
                    @php $r = 1; @endphp
                    <?php if (isset($patient_visit)): ?>
                        @foreach($patient_visit as $visit)
                            <?php foreach ($visit->patients_visit_medicine as $key => $patient_medicine): ?>
                                <div id="remove_item-@php echo $r @endphp" class='item-div'>
                                    <div class="row">
                                        <div class="col-5">
                                            <div class=" price-container">
                                                <label for="name">Medicine</label>
                                                <select required="" class="medicine form-control" name="medicine[]" required="" >
                                                    <option value="'">Select Medicine</option>
                                                    <?php foreach ($medicine as $m): ?>
                                                        <option value="<?= $m->id ?>" <?= $m->id == $patient_medicine->medicine_id ? 'selected' : '' ?>>
                                                            <?= $m->name ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <label for="count">Count</label>
                                            <input type="number" name="count[]" class="form-control" value="{{$patient_medicine->count}}" required="">
                                        </div><br>
                                        <div class="col-1">
                                            <button type="button" class="btn btn-danger btn-sm " id="remove_btn" name="" onClick="remove(@php echo $r @endphp)">Remove</button>
                                        </div>
                                    </div>
                                </div><br id="br- @php  echo $r @endphp">
                                @php $r++ @endphp
                            <?php endforeach ?>
                        @endforeach
                    <?php endif ?>
                    <div id="size" class="element-container"></div>
                    <input type="hidden" name="patients_id">
                    <div class="col">
                        <label for="amount" class="">Amount</label>
                        <input type="text" name="amount" required="" placeholder="Enter Amount" class="form-control" value="{{ isset($patient_visit) ? $visit->amount : '' }}">
                    </div>
                    <div class="col">
                        <label for="Remark" class="mt-3">Remark</label>
                        <textarea rows="4" cols="10" class="form-control" name="remark">{{ (isset($patient_visit) && !isset($_GET['clone'])) ? $visit->remark : ''}}</textarea>
                    </div><br>
                    <div class="float-right">
                        <a href="{{route('patients.patient_medicine', ['id' => $patient->id])}}" class="btn btn-default btn-sm">Cancel</a>&nbsp;&nbsp;
                        <button type="submit" id="submit" class="btn btn-primary btn-sm " style="position: right;">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>            
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        var i = 1;
        var medicine = "";
        $(document).on('click', '#add', function(){     
            $(".element-container").append(`<div id="ele-container-`+i+`" class='item-div'>
                <div class="row mt-2">
                    <div class=" price-container col-5 ">
                        <label for="name">Medicine</label>
                        <select required="" class="medicine form-control "  name="medicine[]" required="">
                            <option value="'">Select Medicine</option>
                            <?php foreach ($medicine as $m): ?>
                                <option value="<?= $m->id ?>"><?= $m->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-5">
                        <label for="count">Count</label>
                        <input type="number" value="0" class="form-control" name="count[]" required="">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-danger btn-sm" name="" id="remove_btn" onClick="removeElement(`+i+`)">Remove</button>
                    </div>
                </div>
                </div><br id="br-`+i+`">`);
            $('.medicine').select2({
                tags: true, 
                placeholder: 'Select an option',
                closeOnSelect: false,  
                dropdownAutoWidth: true,
                width: '100%'  
            });
            $(document).on("select2:open", () => {
                document.querySelector(".select2-container--open .select2-search__field").focus();
            });
            i++;
        });
        $('.medicine').select2({
            tags: true, 
            placeholder: 'Select an option',
            closeOnSelect: false,  
            dropdownAutoWidth: true,
            width: '100%'  
        });
        $(document).on("select2:open", () => {
            document.querySelector(".select2-container--open .select2-search__field").focus();
        });
        $(document).ready(function(){
            $(".sidebar .nav-link").removeClass('active');
            $(".peshant-link").addClass('active');
        });
    });
    function removeElement(id) {
        document.getElementById("ele-container-"+id).remove();
        document.getElementById("br-"+id).remove();
    }
    function remove(id) {
        document.getElementById("remove_item-"+id).remove();
        document.getElementById("br-"+id).remove();
    }
</script>
@endsection



                    