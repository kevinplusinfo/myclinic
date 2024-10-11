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
                <h1>Img</h1>
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
                <form action="{{ route('img.imageuplode') }}" method="POST" id="form" enctype="multipart/form-data">
                    @csrf
                    <div class="col-mb-3">  
                        <input type="file" name="img" class="form-control" required>
                    </div>
                    <div>
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
<script>
     $(document).ready(function(){
        $(".sidebar .nav-link").removeClass('active');
        $(".img-link").addClass('active');
    });
</script>

@endsection