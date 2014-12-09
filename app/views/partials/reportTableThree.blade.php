<table class='table table-striped table-bordered table-condensed'>
	<thead>
		<tr>
			@foreach($headers as $header)
			<th>{{ $header }}</th>
			@endforeach
		</tr>
	</thead>

	<tbody>
	@foreach ($rows as $key => $row)
				<tr>
				@foreach ($row as $val)
					<td>{{$key}}</td>
					@foreach ($fields as $field)
					<td>{{ $val->{$field} }}</td>
					@endforeach
				</tr>
				@endforeach
		@endforeach
	</tbody>
</table>