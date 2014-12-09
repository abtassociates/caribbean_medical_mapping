<table class='table table-striped table-bordered table-condensed'>
	<thead>
		<tr>
			@foreach($headers as $header)
			<th>{{ $header }}</th>
			@endforeach
		</tr>
	</thead>

	<tbody>

	@foreach ($facilities as $facility)
				<tr>
					@foreach ($fields as $field)
  	 			<td>{{ HTML::formatPhone(HTML::deepVal($facility, $field)) }}</td>
					@endforeach
				</tr>
		@endforeach
	</tbody>
</table>