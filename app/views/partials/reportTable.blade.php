<table class='table table-striped table-bordered table-condensed'>

	<thead>
		<tr>
			@foreach($headers as $header)
			<th>{{ $header }}</th>
			@endforeach
		</tr>
	</thead>
	<tbody>
		@foreach ($rows as $row)
		<tr>
			@foreach ($fields as $field)
			<td>{{ $row->{$field} }}</td>
			@endforeach
		</tr>
		@endforeach
	</tbody>
</table>