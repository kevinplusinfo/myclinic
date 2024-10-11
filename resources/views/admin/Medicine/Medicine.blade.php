@extends('admin.layout.main')
@section('title')Medicine @endsection
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
                <h1>Medicine</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('medicine')}}">Medicine</a></li>
                    <li class="breadcrumb-item active">List</li>
                </ol>
            </div>
        </div>
    </div>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="float-right">
            <a href="{{route('medicine.trash')}}" class="btn btn-danger btn-sm ml-2">Trash Medicine</a>
        
            <a href="{{route('medicine.form')}}" class="btn btn-primary btn-sm">Add Medicine</a>
        </div><br>
        <div class="card mt-3">
            <div class="card-header">
                <form>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="name">Name</label>
                            <input type="search" name="name" id="name" class="form-control" placeholder="Search For Name" value="{{ request()->get('name') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="power">Power</label>
                            <input type="search" name="power" id="power" class="form-control" placeholder="Search For Power" value="{{ request()->get('power') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="precaution">Precaution</label>
                            <select name="precaution" id="precaution" class="form-control">
                                <option value="">Choose...</option>
                                <option value="0" {{ request()->get('precaution') == '0' ? 'selected' : '' }}>Before Eating</option>
                                <option value="1" {{ request()->get('precaution') == '1' ? 'selected' : '' }}>After Eating</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="action">Action</label><br>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                @if(isset($medicine) && $medicine->isNotEmpty())
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Power</th>
                            <th>Timing</th>
                            <th>Precaution</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = $medicine->firstItem() @endphp
                        @foreach($medicine as $m)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $m->name }}</td>
                            <td>{{ $m->power }}</td>
                            <td>
                                @if($m->morning) 
                                    <span class="badge bg-primary">Morning</span> 
                                @endif
                                @if($m->afternoon) 
                                    <span class="badge bg-primary">Afternoon</span>
                                @endif
                                @if($m->evening) 
                                    <span class="badge bg-primary">Evening</span> 
                                @endif
                                @if($m->night) 
                                    <span class="badge bg-primary">Night</span> 
                                @endif
                            </td>
                            <td>
                                @if($m->precaution)
                                    <span class="badge bg-success">After Eating</span>
                                @else
                                    <span class="badge bg-info">Before Eating</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('medicine.update', $m->id) }}"><i class="far fa-edit text-success"></i></a>
                            </td>
                            <td>
                                <a href="{{ route('medicine.delete', $m->id) }}" onclick="return confirm('Are You Sure  Delete This Medicine?')"><i class="fas fa-trash text-danger"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $medicine->appends(request()->except('page'))->links() }}
                </div>
                @endif
                @if(isset($trash_medicine) && $trash_medicine->isNotEmpty())
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Power</th>
                                <th>Timing</th>
                                <th>Precaution</th>
                                <th>Restore</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = $trash_medicine->firstItem() @endphp
                            @foreach($trash_medicine as $m)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $m->name }}</td>
                                <td>{{ $m->power }}</td>
                                <td>
                                    @if($m->morning) 
                                        <span class="badge bg-primary">Morning</span> 
                                    @endif
                                    @if($m->afternoon) 
                                        <span class="badge bg-primary">Afternoon</span>
                                    @endif
                                    @if($m->evening) 
                                        <span class="badge bg-primary">Evening</span> 
                                    @endif
                                    @if($m->night) 
                                        <span class="badge bg-primary">Night</span> 
                                    @endif
                                </td>
                                <td>
                                    @if($m->precaution)
                                        <span class="badge bg-success">After Eating</span>
                                    @else
                                        <span class="badge bg-info">Before Eating</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('medicine.restore', $m->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are You sure Restore This Medicine?')"><i class="fa-solid fa-trash-can-arrow-up fa-beat-fade"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $trash_medicine->appends(request()->except('page'))->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
     $("#precaution").val("{{@$_GET['precaution']}}");
     $(document).ready(function(){
        $(".sidebar .nav-link").removeClass('active');
        $(".medicine-link").addClass('active');
    });
</script>
@endsection