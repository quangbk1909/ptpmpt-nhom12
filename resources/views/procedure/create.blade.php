@extends('layout.index')

@section('content')

<!-- Page Content -->
<div class="bg-white p-3">
    <div class="row">
        <div class=" offset-md-1  mr-auto">
            <h1><strong>Procedure</strong>
                <small>create</small>
            </h1>
        </div>
        <div class="col-md-2 d-flex align-content-center justify-content-center p-2">
            <a href="procedure/show" class="btn btn-primary">Back to show</a>  
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
				<h3 class="m-3">Procedure Information</h3>		
			</div>
			<div class="m-3">
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" class="form-control" name="title" id="title" placeholder="Enter your title"	>
				</div>

				<div class="form-group">
					<label for="type">Type</label>
					<select class="form-control" name="type" id="type">
						@foreach($procedureTypes as $type)
							<option value="{{$type->id}}">{{ucfirst($type->name)}}</option>
						@endforeach	
					</select>
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
						<h3 class="m-3">Step</h3>		
					</div>
					<div class=" m-2">
						<div class="form-group input_fields_wrap">
						    <button class="btn btn-success btn-block my-2 add_field_button">Add step</button>
						    <label for="">Step : </label>
						    <input type="text" class="my-1" name="steps[]" placeholder="Enter name of step">
						</div>

						
					</div>	
				</div>
			</div>
			
		</div>
		<button class="btn btn-primary btn-block" type="submit">Save</button>
    </div>

    </form>
</div>

@endsection

@section('script')
	
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=3p4k7yt02rru583b2zs2gd9mrdx7q3rizyx03r9wsywt3qy7"></script>

  	<script>tinymce.init({ selector:'input[type="textarea"]' });</script>

	<script>
		$(document).ready(function() {
			var max_fields      = 20; //maximum input boxes allowed
			var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
			var add_button      = $(".add_field_button"); //Add button ID
			
			var x = 1; //initlal text box count
			$(add_button).click(function(e){ //on add input button click
				e.preventDefault();
				if(x < max_fields){ //max input box allowed
					x++; //text box increment
					$(wrapper).append('<div><label for="">Step : </label><input type="text" class="my-1" name="steps[]" placeholder="Enter name of step"><a href="#" class="remove_field mr-auto">Remove</a></div>'); //add input box
				}
			});
			
			$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
				e.preventDefault(); $(this).parent('div').remove(); x--;
			})
		});

	</script>
  	

@endsection