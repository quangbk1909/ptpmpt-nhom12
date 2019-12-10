@extends('layout.index')

@section('content')

<!-- Page Content -->
<div class="bg-white p-3">
    <div class="row">
        <div class=" offset-md-1  mr-auto">
            <h1><strong>Post</strong>
                <small>create</small>
            </h1>
        </div>
        <div class="col-md-2 d-flex align-content-center justify-content-center p-2">
            <a href="post/show" class="btn btn-primary">Back to show</a>  
        </div>
    </div>
    @if (session('success'))
		<div class="col-md-11 alert alert-success alert-dismissible fade show" role="alert">
	  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    	<span aria-hidden="true">&times;</span>
	 	 </button>
	 	 {{session('success')}}
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


    <form action="post/create" method="POST" enctype="multipart/form-data" >
		@csrf
    <!-- Create post content -->
	<div class="row">
		
		<!-- Post info left -->
    	<div class="col-md-8 col-sm-8  border m-3">
    		<div class="border-bottom">
				<h3 class="m-3">Post Information</h3>		
			</div>
			<div class="m-3">
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" class="form-control" name="title" id="title" placeholder="Enter your title"	>
				</div>
				<div class="form-group">
					<label for="content">Content</label>
					<input type="textarea" name="content" style="min-height: 300px;" > 
				</div>
			</div>		
    	</div>

		<!-- Option right -->
		<div class="col-md-3 col-sm-3 m-2">
			<!-- Publish -->
			<div class="row border m-2">
				<div class="col-md-12 col-sm-12 ">
					<div class="border-bottom">
						<h3 class="m-3">Publish</h3>		
					</div>
					<div class=" m-2">
						<div class="form-group">
							<label class="mr-auto" for="visibility">Visibility</label>
							<select class="form-control" name="visibility" id="visibility">
								<option value="1">Public</option>
								<option value="2">Follower</option>
								<option value="0">Only me</option>
							</select>
						</div>
						<div class="form-group">
							<label for="status">Publish</label>
							<select class="form-control" name="status" id="status">
								<option value="0">Save draft</option>
								<option value="1">Save complete</option>
							</select>
						</div>
						<button class="btn btn-primary btn-block" type="submit">Save</button>
					</div>	
				</div>
			</div>

			<!-- Category -->
			<div class="row border m-2">
				<div class="col-md-12 col-sm-12">
					<div class="border-bottom">
						<h3 class="m-3">Category</h3>		
					</div>
					<div class=" m-2">
						<div class="form-group">
							<div class="form-control" style="width:300px; height: 100px; overflow-y: scroll;">
								@foreach ($categories as $category)
									<input type="checkbox" name="categories[]" value="{{$category->id}}"> {{$category->name}}<br>
								@endforeach								
							</div>								
						</div>
						<a href=""> Create new category</a>	
					</div>	
				</div>
			</div>

			<!-- Image -->
			<div class="row border m-2">
				<div class="col-md-12 col-sm-12">
					<div class="border-bottom">
						<h3 class="m-3">Feature image</h3>		
					</div>
					<div class=" m-2">
						    <input type="file" name="img" accept="image/*">
					</div>	
				</div>
			</div>
		</div>
		
    </div>

    </form>
</div>

@endsection

@section('script')
	
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=3p4k7yt02rru583b2zs2gd9mrdx7q3rizyx03r9wsywt3qy7"></script>

  	<script>tinymce.init({ selector:'input[type="textarea"]' });</script>

@endsection