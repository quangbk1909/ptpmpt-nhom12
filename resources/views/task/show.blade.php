@extends('layout.index')

@section('css')
    <link rel="stylesheet" href="assets/css/categoryshow.css" type="text/css" >
@endsection
@section('content')

<!-- Page Content -->
<div class="bg-white p-3">
    <div class="row">
        <div class=" offset-md-1 col-md-9 mr-auto">
            <h1><strong>Category</strong>
                <small>List</small>
            </h1>
        </div>
        <div class="col-md-2 d-flex align-content-center justify-content-center p-2">
            <a href="category/create" class="btn btn-primary">Create new category</a>  
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
        <div class="col-md-4 border p-0">
            <div class="tree well">
                <ul>
                    @foreach ($categoryRoots as $category)
                        @include('category.treeview', $category)
                    @endforeach
                </ul>
            </div>
        </div>
        
        <!-- Table data -->
        <div class="col-md-8">           
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Current Parent</th>
                        <th>Create</th>
                        <th>Update</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $tCategory) 
                        <tr>
                            <td>{{$tCategory->name}}</td>
                            <td>
                                @if ($tCategory->currentParent() != null)
                                    {{$tCategory->currentParent()->name}} 
                                @endif
                            </td>
                            <td>{{$tCategory->created_at}}</td>
                            <td>{{$tCategory->updated_at}}</td>
                            <td><a href="category/edit/{{$tCategory->id}}"><i class="fas fa-pencil-alt"></i> Edit</a> | <a href="category/delete/{{$tCategory->id}}"  onclick="return confirm('Are you sure to delete category {{$tCategory->name}}?');"><i class="fas fa-trash-alt"></i> Delete</a></td>
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