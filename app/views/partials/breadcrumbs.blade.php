<ul class="breadcrumb">

	@if(!isset($breadcrumbs) || !count($breadcrumbs))

		<li>
			<i class="icon-home home-icon"></i>
			<span class="active">Home</span>
		</li>

	@else

		<li>
			<i class="icon-home home-icon"></i>
			<a href="/">Home</a>
		</li>

		@foreach($breadcrumbs as $breadcrumb)

			@if($breadcrumb == end($breadcrumbs))
			<li class="active">
				{{ $breadcrumb['name'] }}
			</li>
			@else
			<li>
				<a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
			</li>
			@endif

		@endforeach

	@endif

</ul><!-- .breadcrumb -->