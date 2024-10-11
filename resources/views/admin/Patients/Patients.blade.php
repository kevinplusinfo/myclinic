@extends('admin.layout.main')
@section('title')Patients @endsection
@section('styles')

<link href="{{asset('assets/plugins/daterange-picker/css/daterangepicker-bs3.css')}}" rel="stylesheet">
<style>
    .error{color: red;font-weight: normal!important;}
    #reportrange{cursor: pointer;}
    .daterangepicker .calendar th, .daterangepicker .calendar td{font-family: monospace!important;}
    .badge{font-size: 15px;cursor: pointer}
    th,td{text-align: center;}
</style>
@endsection
@section('content-header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Patients</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active"><a href="">Patients</a></li>
                    <li class="breadcrumb-item active">List</li>
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
            <button id="" class="btn btn-primary btn-sm add_patients">Add Patients</button>
        </div><br>
        <div class="card mt-3">
            <div class="card-header">
                <form>
                    <div class="row">
                        <div class="col-md-5">
                            <label for="name">Name</label>
                            <input type="search" class="form-control" name="name" id="name" placeholder="Search For Name" value="{{@$_GET['name']}}">
                        </div>
                        <div class="col-md-3">
                            <label for="action">Action</label><br>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = $patients->firstItem())
                            @foreach ($patients as $p)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>
                                        <a  href="{{ route('patients.patient_medicine', ['id' => $p->id]) }}">
                                            {{$p->name}}
                                        </a>
                                    </td>
                                    <td>
                                        <a id="update" class="update_patients" data-patients="{{$p}}" id="update_patients" href="javascript:void(0);">
                                            <i class="far fa-edit text-success"></i> 
                                        </a>
                                    </td> 
                                    <td>
                                        <a id="delete" href="{{ route('patients.delete', $p->id) }}" onclick="return confirm('Are You Sure Delete This Patient')">
                                            <i class="fas fa-trash  text-danger"></i>
                                        </a>
                                    </td> 
                                </tr>
                           @php($i++) 
                       @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $patients->appends(Request::except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form action="{{route('patients.add')}}" method="post" id="registerform">
        @csrf
        <input type="hidden" name="id" class="id" value="" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="staticBackdropLabel"><b>Patients</b></h4>
                    <i class="fa-solid fa-xmark btn-close" style="cursor:pointer;" ></i>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="Patients Name" class="form-label">Name</label>
                        <input type="text" class="form-control name" id="name" name="name" aria-describedby="name" placeholder="Enter The Patients Name" required="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-secondary btn-close btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
    $(document).ready(function(){
        $('.add_patients').on('click', function(){
            $('#staticBackdrop').modal('show'); 
            $('.name').val(''); 
        });
        $('.btn-close').on('click', function(){
            $('#staticBackdrop').modal('hide'); 
        });
        $('.update_patients').on('click' ,function(){
            $('#staticBackdrop').modal('show'); 
            let patients = $(this).data('patients');
            $('.id').val(patients.id);
            $('.name').val(patients.name);
            console.log(patients.id);
        })
        $('#registerform').validate({
            rules: {
                name: {
                    required: true,
                    remote: {
                        url: "{{route('patients.name') }}",
                        type: "post",
                        data: {
                            name: function() {
                                return $('.name').val();
                            },
                            id: function() {
                                return $('.id').val();
                            },
                            _token: "{{csrf_token() }}"
                        },
                        dataType: 'json',
                        dataFilter: function(response) {
                            var json = JSON.parse(response);
                            return json.valid ? "true" : "false"; 
                        }
                    }
                }
            },
            messages: {
                name: {
                    required: "Please Enter a Patient Name",
                    remote: "This Patient Name Is Already Exists"
                }
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element); 
            }
        });
        $(".sidebar .nav-link").removeClass('active');
        $(".peshant-link").addClass('active');
    });
</script>
@endsection