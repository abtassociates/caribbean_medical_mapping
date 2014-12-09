<div class="prev-next">
	@if($prev_id=$facility->prevId())
	<a class="btn" href='{{ URL::to("facilities/{$prev_id}/edit") }}'>
		<i class="icon-double-angle-left"></i> Previous Record
	</a>
	@endif

	<a class="btn" href='{{ URL::to("facilities") }}'>
		List
	</a>

	@if($next_id=$facility->nextId())
	<a class="btn" href='{{ URL::to("facilities/{$next_id}/edit") }}'>
		Next Record <i class="icon-double-angle-right"></i> 
	</a>
	@endif
</div>