<li>
	<span>
		@if ($category->hasChildren())
			<i class="fas fa-minus"></i>
		@endif	
		{{$category->name}}
	</span>
	@if ($category->hasChildren())
		<ul>
		@foreach ($category->currentChild() as $category)
			@include('category.treeview', $category)
		@endforeach
	</ul>
	@endif
	
</li>