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
            <h1><strong>Procedure</strong>
                <small>List</small>
            </h1>
        </div>
        <div class="col-md-2 d-flex align-content-center justify-content-center p-2">
            <a href="post/create" class="btn btn-primary">Create new procedure</a>  
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

    <!-- Table data -->
    <form action="post/delete/all" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row my-2">
        </div>
        
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Adder</th>
                    <th>Create</th>
                    <th>Update</th>
                    <th>Detail step</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($procedures as $procedure)
                    <tr>
                        <td>{{$procedure->id}}</td>
                        <td>{{$procedure->title}}</td>
                        <td>{{$procedure->procedureType->name}}</td>
                        <td>{{substr($procedure->content,0,50)}} ...</td>
                        <td>{{$procedure->adder->name}}</td>
                        <td>{{$procedure->created_at}}</td>
                        <td>{{$procedure->updated_at}}</td>
                        <td> Number steps: {{$procedure->procedureSteps->count()}}
                            @foreach ($procedure->procedureSteps as $step)
                            <p style="color: #3F3F3F; font-size: 16px;">Step {{$step->step}} : {{$step->content}}</p>



                            
                            @endforeach

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>
    <!-- Table -->
    
</div>

@endsection

@section('script')
    <script>
        var listSubChk = $('.sub-chk');
        var flagChecked = true;
        
        $(document).ready(function (){
            $('#bulk-all').on('click', function(event) {
                if ($('#bulk-all').prop('checked') == true) {
                    $('.sub-chk').prop('checked', true);
                } else {
                    $('.sub-chk').prop('checked', false);
                }
            });

            var checkBulkAll = function() {
                for (var i = 0; i < listSubChk.length; i++) {
                    //console.log($(listSubChk[i]).prop('checked'));
                    if ($(listSubChk[i]).prop('checked') == false ){
                        flagChecked = false;
                        break;
                    }
                }

                if (flagChecked == true) {
                    return $('#bulk-all').prop('checked', true);
                }else {
                    return $('#bulk-all').prop('checked', false);       
                }
            }
            checkBulkAll();

            $('#example').on('draw.dt', function() {
                listSubChk = $('.sub-chk');
                flagChecked = true;
                checkBulkAll();
            });

            listSubChk.click( function(event) {
                listSubChk = $('.sub-chk');
                flagChecked = true;
                checkBulkAll();
            });
        });

    </script>

@endsection