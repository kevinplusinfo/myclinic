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
            <div class="float-right">
        
            <a href="{{route('img.imageuplodeform')}}" class="btn btn-primary btn-sm">Add Image</a>
        </div><br>
            <div class="card-body">
                @foreach($images as $image)
                    <img src="{{ Storage::url($image->img) }}" alt="Uploaded Image">
                @endforeach
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