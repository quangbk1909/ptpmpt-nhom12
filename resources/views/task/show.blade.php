@extends('layout.index')

@section('css')
    <link rel="stylesheet" href="css/categoryadmin.css" type="text/css" >
@endsection
@section('content')

<!-- Page Content -->
<div class="bg-white p-3">
    <div class="row">
        <div class=" offset-md-1 col-md-9 mr-auto">
            <h1><strong>Procedure task in {{$mainTask->name}}</strong>
            </h1>
        </div>
        <div class="col-md-2 d-flex align-content-center justify-content-center p-2">
            <a href="category/create" class="btn btn-primary">Create new procedure task</a>  
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

    <div class="row">
        <!-- Categories treeview -->
        <div class="col-md-3 border p-0">
            <div class="tree well">
                <ul>
                    @foreach ($mainTask->procedure->procedureSteps as $step)
                        @include('task.treeview', ['step' => $step])
                    @endforeach
                </ul>
            </div>
        </div>
        
        <!-- Table data -->
        <div class="col-md-9">           
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                  
                        <th>Deadline</th>
                        <th>Start</th>
                        <th>Status</th>
                        <th>Finish</th>
                        <th>Progress</th>
                        <th>Creator</th>
                        <th>Implementer</th>
                        <th>Step</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($procedureTasks as $task)
                        <tr>
                            <td>{{$task->id}}</td>
                            <td>{{$task->name}}</td>
                            <td>{{$task->deadline}}</td>
                            <td>{{$task->started_at}}</td>
                            @if($task->status == 1)
                                <td>Complete</td>
                            @else
                                <td>In process</td>
                            @endif
                            <td>{{$task->finished_at}}</td>
                            <td>{{(int)($task->amount_of_accomplished_work * 100 / $task->amount_of_work) }} %</td>
                            @if(isset($task->creator_detail->name))
                                <td>{{$task->creator_detail->name}}</td>
                            @else
                                <td></td>
                            @endif

                            @if(isset($task->implementer_detail->name))
                                <td>{{$task->implementer_detail->name}}</td>
                            @else
                                <td></td>
                            @endif
                            <td>{{$task->step}}</td>
                            <td><a href="category/edit/"><i class="fas fa-tasks"></i> Tasks</a> | <a href="category/edit/"><i class="fas fa-pencil-alt"></i> Edit</a> | <a href="procedure/delete/"  onclick="return confirm('Are you sure to delete category ?');"><i class="fas fa-trash-alt"></i> Delete</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table> 
       </div> 
       <!-- Table -->
    </div>
</div>

@endsection

@section('script')
    <script>
        $(function () {
            $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
            $('.tree li.parent_li > span').on('click', function (e) {
                var children = $(this).parent('li.parent_li').find(' > ul > li');
                if (children.is(":visible")) {
                    children.hide('fast');
                    $(this).attr('title', 'Expand this branch').find(' > svg').attr('data-icon', 'plus');;
                } else {
                    children.show('fast');
                    $(this).attr('title', 'Collapse this branch').find(' > svg').attr('data-icon', 'minus');;
                }
                e.stopPropagation();
            });
        });
    </script>

@endsection