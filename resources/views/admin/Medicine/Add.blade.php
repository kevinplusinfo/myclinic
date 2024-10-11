@extends('admin.layout.main')
@section('title')Medicines @endsection
@section('styles')
<link href="{{asset('assets/plugins/daterange-picker/css/daterangepicker-bs3.css')}}" rel="stylesheet">
<style>
    .error{color: red;font-weight: normal!important;}
    #reportrange{cursor: pointer;}
    .daterangepicker .calendar th, .daterangepicker .calendar td{font-family: monospace!important;}
    #add_medicine{margin-left: 950px;}
    .cursor-pointer{cursor: pointer;}
</style>
@endsection
@section('content-header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Medicine</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('medicine')}}">Medicine</a></li>
                    <li class="breadcrumb-item active">List</li>
                    <li class="breadcrumb-item active">Add</li>
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
                <form action="{{route('medicine.add')}}/{{ isset($medicine) ? $medicine->id : '' }}"  id="form">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="tetx" name="name" class="form-control" id="" aria-describedby="emailHelp" placeholder="Enter Medicine Name" value="{{ isset($medicine) ? $medicine->name : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="power" class="form-label">Power</label>
                        <input type="text" name="power" class="form-control" id="" placeholder="Enter Medicine Power" value="{{ isset($medicine) ? $medicine->power : '' }}">
                    </div>
                    <label for="power" class="form-label">Timing</label>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input cursor-pointer" name="morning" value="morning" id="morning" {{ isset($medicine) && $medicine->morning ? 'checked' : '' }}>
                                    <label class="custom-control-label cursor-pointer" for="morning" value="{{ isset($medicine) ? $medicine->morning : '' }}">Morning</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input cursor-pointer" name="afternoon" value="afternoon" id="afternoon" {{ isset($medicine) && $medicine->afternoon ? 'checked' : '' }}>
                                    <label class="custom-control-label cursor-pointer" for="afternoon">Afternoon</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input cursor-pointer" name="evening" value="evening" id="evening" {{ isset($medicine) && $medicine->evening ? 'checked' : '' }}>
                                    <label class="custom-control-label cursor-pointer" for="evening">Evening</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input cursor-pointer" name="night" value="night" id="night" {{ isset($medicine) && $medicine->night ? 'checked' : '' }}>
                                    <label class="custom-control-label cursor-pointer" for="night">Night</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="time">Precaution</label>
                        <select name="precaution" class="form-control">
                            <option value="">Chosee..</option>
                            <option value="0" {{ isset($medicine) && $medicine->precaution == 0 ? 'selected' : '' }}>Before Eating</option>
                            <option value="1" {{ isset($medicine) && $medicine->precaution == 1 ? 'selected' : '' }}>After Eating</option>
                        </select>
                    </div>
                    <div class="float-right">
                        <a href="{{route('medicine')}}" class="btn btn-default btn-sm">Cancel</a>&nbsp;&nbsp;
                        <button type="submit" id="submit" class="btn btn-primary btn-sm">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>            
@endsection
@section('scripts')
<script src="{{asset('assets/plugins/daterange-picker/js/moment.min.js')}}"></script>
<script src="{{asset('assets/plugins/daterange-picker/js/daterangepicker.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $("#form").validate({
    rules: {
        name: {
            required: true
        },
        power: {
            required: true
        },
        precaution: {
            required: true
        }
    },
    messages: {
        name: {
            required: "This field is required"
        },
        power: {
            required: "This field is required"
        },
        precaution: {
            required: "This field is required"
        }
    },
    errorPlacement: function(error, element) {
        element.closest('.form-control').after(error);
    }
});

$(document).ready(function(){
    $('#submit').click(function(e){
        if ($("#form").valid()) {
            if ($('input[type="checkbox"]:checked').length === 0) {
                alert('Please Select At Least One Timing.');
                e.preventDefault();
            }
        }
        else {
            e.preventDefault();
        }
    });
});

</script>
<script>
     $(document).ready(function(){
        $(".sidebar .nav-link").removeClass('active');
        $(".medicine-link").addClass('active');
    });
</script>
@endsection