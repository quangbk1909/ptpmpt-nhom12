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
                <small>Create</small>
            </h1>
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
        <div class="col-md-5">
             <div class="tree well">
                <ul>
                    @foreach ($categoryRoots as $category)
                        @include('category.treeview', $category)
                    @endforeach
                </ul>
            </div>
        </div>


        <div class="col-md-6">
            <form action="category/edit/{{$cCategory->id}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required="" placeholder="Enter category name" value="{{$cCategory->name}}">
                </div>    
                <div class="form-group">
                    <label for="category_parent">Category parent</label>
                    <select class="form-control" name="category_parent" id="category_parent">
                        <option value="0">New branch</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" 
                            	@if (($parentCategory != null)&&($parentCategory->id == $category->id))
                            		selected="" 
                            	@endif
                            >{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="category/show" class="btn btn-light m-2">Back</a>

            </form>    
        </div>
        
        
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

        $(document).ready(function(){
            var children = $('li.parent_li > ul > li');
            children.hide();
        });
    </script>

@endsection