@extends('layout.index')

@section('css')
    <link rel="stylesheet" href="assets/css/categoryshow.css" type="text/css" >
@endsection

@section('content')

<!-- Page Content -->
<div class="bg-white p-3">
    <div class="row">
        <div class=" offset-md-1 col-md-9 mr-auto">
            <h1><strong>Main task</strong>
                <small>Create</small>
            </h1>
        </div>
        <div class="col-md-2 d-flex align-content-center justify-content-center p-2">
            <a href="main-task/show" class="btn btn-primary">Back to show</a>  
        </div>
    </div>
    <hr>
    @if (session('success'))
        <div class="col-md-11 alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         {{session('success')}}
    </div>
    @endif

    @if (session('warning'))
        <div class=" col-md-11 alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         {{session('warning')}}
    </div>
    @endif
    @if ($errors->first())
        <div class=" col-md-11 alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         {{$errors->first()}}
    </div>
    @endif

    <div class="row ">
        <div class="col-md-12">
            <form action="main-task/create" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required="" placeholder="Enter main task name">
                </div> 

                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" required="" placeholder="Enter main task description">
                </div>

                <div class="form-group">
                    <label for="description">Deadline</label>
                    <input type="datetime-local" class="form-control" name="deadline">
                </div>

                <div class="form-group">
                    <label for="procedure_id">Procedure</label>
                    <select class="form-control" name="procedure_id" id="procedure_id">
                        @foreach($procedures as $procedure)
                            <option value="{{$procedure->id}}">{{ucfirst($procedure->title)}}</option>
                        @endforeach 
                    </select>
                </div>
                <div class="form-group">
                    <label for="responsible_person">Responsible person</label>
                    <input type="number" class="form-control" id="responsible_person" name="responsible_person" required="" placeholder="Enter id responsible user" value="4727110530760704">
                </div> 

                <input type="hidden" name="creator" value="4614718215946240" >
                
                <div class="form-group">
                    <label for="department_id">Department</label>
                    <input type="text" class="form-control" id="department_id" name="department_id" required="" placeholder="Enter id department" value="5deb08110351e97280dd2984">
                </div>

                
                <button type="submit" class="btn btn-primary">Create</button>
                <button type="reset" class="btn btn-light m-2">Reset</button>

            </form>    
        </div>
        
        
    </div>

    
</div>

@endsection

