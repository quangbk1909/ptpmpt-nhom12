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
                <small>Edit</small>
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
            <form action="main-task/update{{$mainTask->id}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required="" placeholder="Enter main task name" value="{{$mainTask->name}}">
                </div> 

                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" required="" placeholder="Enter main task description" value="{{$mainTask->description}}">
                </div>

                <div class="form-group">
                    <label for="description">Deadline</label>
                    <input type="datetime-local" class="form-control" name="deadline" value="{{$mainTask->deadline}}">
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" name="status" id="status">
                            @if($mainTask->status == 0)
                                <option value="0" selected>In process</option>
                                <option value="1" >Complete</option>
                            @else
                                <option value="0" >In process</option>
                                <option value="1" selected>Complete</option>
                            @endif
                    </select>
                </div>

                <div class="form-group">
                    <label for="responsible_person">Responsible person</label>
                    <input type="number" class="form-control" id="responsible_person" name="responsible_person" required="" placeholder="Enter id responsible user" value="{{$mainTask->responsible_person}}">
                </div>


                
                <button type="submit" class="btn btn-primary">Create</button>
                <button type="reset" class="btn btn-light m-2">Reset</button>

            </form>    
        </div>
        
        
    </div>

    
</div>

@endsection

