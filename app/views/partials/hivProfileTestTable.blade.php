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
			<td>{{ HTML::boolToYesNo(HTML::deepVal($facility, ['hivAidsServices','rapidtest'])) }}</td>
			<td>{{ HTML::boolToYesNo(HTML::deepVal($facility, ['hivAidsServices','westernblot'])) }}</td>
			<td>{{ HTML::boolToYesNo(HTML::deepVal($facility, ['hivAidsServices','elisa'])) }}</td>
			<td>{{ HTML::boolToYesNo(HTML::deepVal($facility, ['hivAidsServices','blooddraw'])) }}</td>
			<td>{{ HTML::deepVal($facility, 'facilityname') }}</td>
			<td>{{ HTML::deepVal($facility, 'facilityaddress') }}</td>
			<td>{{ HTML::deepVal($facility, ['facilityInformation','facilitytype']) }}</td>
			<td>{{ HTML::deepVal($facility, ['proprietorInformation','fullname']) }}</td>
			<td>{{ HTML::deepVal($facility, ['proprietorInformation','title']) }}</td>
			<td>{{ HTML::formatPhone(HTML::deepVal($facility, ['proprietorInformation','telephone'])) }}</td>
			<td>{{ HTML::deepVal($facility, ['proprietorInformation','email']) }}</td>
		</tr>
		@endforeach

	</tbody>
</table>
