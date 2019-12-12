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
            <a href="main-task/{{$lastProcedureTask->mainTask->id}}/procedure-tasks" class="btn btn-primary">Back to show</a>  
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
            <form action="procedure-task/create" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required="" placeholder="Enter main task name">
                </div> 

                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="content" required="" placeholder="Enter main task description">
                </div>

                <div class="form-group">
                    <label for="deadline">Deadline</label>
                    <input type="datetime-local" class="form-control" name="deadline">
                </div>

                <div class="form-group">
                    <label for="amount_of_work">Amount of work</label>
                    <input type="number" class="form-control" name="amount_of_work">
                </div>

                <div class="form-group">
                    <label for="procedure_id">Procedure step</label>
                    <select class="form-control" name="procedure_step_id" id="procedure_id">
                            <option value="{{$lastProcedureTask->procedureStep->id}}">{{$lastProcedureTask->procedureStep->content}}</option>
                            @if(isset($nextStep))
                                <option value="{{$nextStep->id}}">{{$nextStep->content}}</option>
                            @endif
                    </select>
                </div>

                <input type="hidden" name="creator" value="4614718215946240" >
                <input type="hidden" name="main_task_id" value="{{$lastProcedureTask->mainTask->id}}" >

                
                
                <button type="submit" class="btn btn-primary">Create</button>
                <button type="reset" class="btn btn-light m-2">Reset</button>

            </form>    
        </div>
        
        
    </div>

    
</div>

@endsection

