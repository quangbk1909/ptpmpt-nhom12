<li>
	<span>
		@if ($mainTask->checkStepHasTask($step->step))
			<i class="fas fa-minus"></i>
		@endif	
		{{$step->content}}
	</span>
	@if ($mainTask->checkStepHasTask($step->step))
		<ul>
			@foreach($mainTask->getTaskByStep($step->step) as $task)
				<li>{{$task->name}}</li>
			@endforeach
		{{-- @foreach ($category->currentChild() as $category)
			@include('category.treeview', $category)
		@endforeach --}}
		</ul>
	@endif
	
</li>