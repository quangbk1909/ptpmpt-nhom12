@extends('layout.index')

@section('css')
    <style>
        #example td a{
            color: #697F85;
        }
         #example td a:hover{
            color: #000;
        }
    </style>
@endsection
@section('content')

<!-- Page Content -->
<div class="bg-white p-3">
    <div class="row">
        <div class=" offset-md-1 col-md-9 mr-auto">
            <h1><strong>Main Task</strong>
                <small>List</small>
            </h1>
        </div>
        <div class="col-md-2 d-flex align-content-center justify-content-center p-2">
            <a href="procedure/create" class="btn btn-primary">Create main task</a>  
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

    <!-- Table data -->
    <form action="post/delete/all" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row my-2">
        </div>
        
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Finish</th>
                    <th>Procedure</th>
                    <th>Creator</th>
                    <th>Responsible person</th>
                    <th>Department</th>
                    <th>Create</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{$task->id}}</td>
                        <td>{{$task->name}}</td>
                        <td>{{substr($task->description,0,50)}} ...</td>
                        <td>{{$task->deadline}}</td>
                        @if($task->status == 1)
                        	<td>Complete</td>
                        @else
                        	@if($task->overdue == 0)
                        		<td>In process</td>
                        	@elseif($task->overdue == 1)
                        		<td>Overdue</td>
                        	@endif
                        @endif
                        <td>{{$task->finished_at}}</td>
                        <td>{{$task->procedure->title}}</td>
                        @if(isset($task->creator_detail->name))
                            <td>{{$task->creator_detail->name}}</td>
                        @else
                            <td></td>
                        @endif

                        @if(isset($task->responsible_person_detail->name))
                            <td>{{$task->responsible_person_detail->name}}</td>
                        @else
                            <td></td>
                        @endif

                        @if(isset($task->department_detail->depart_name))
                            <td>{{$task->department_detail->depart_name}}</td>
                        @else
                            <td></td>
                        @endif
                        <td>{{$task->created_at}}</td>
                        <td><a href="main-task/{{$task->id}}/procedure-tasks"><i class="fas fa-tasks"></i> Tasks</a> | <a href="main-task/update/{{$task->id}}"><i class="fas fa-pencil-alt"></i> Update</a> | <a href="main-task/delete/{{$task->id}}"  onclick="return confirm('Are you sure to delete category ?');"><i class="fas fa-trash-alt"></i> Delete</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>
    <!-- Table -->
    
</div>

@endsection
