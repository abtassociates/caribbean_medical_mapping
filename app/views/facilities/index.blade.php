@extends('layouts.default')

@section('meta_description')
<meta name="description" content="{{ $instance->meta_description }}">
@stop

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="row" id="filters">

      {{ Form::model($input, array('method'=>'get')) }}

        <div class="col-xs-11  col-md-2">
          <div class="form-group filterFormGroup">
            {{ Form::label('proprietor', 'Proprietor') }}
            {{ Form::select('proprietor', $proprietors, null, array('class'=>'chosen filterSelect')) }}
          </div>
        </div>

        <div class="col-xs-11  col-md-2">
          <div class="form-group filterFormGroup">
            {{ Form::label('specialty', 'Specialty') }}
            {{ Form::select('specialty', $specialties, null, array('class'=>'chosen filterSelect')) }}
          </div>
        </div>

       <div class="col-xs-11  col-md-2">
          <div class="form-group filterFormGroup">
            {{ Form::label('services', 'Services') }}
            {{ Form::select('services[]', $services, null, array('multiple'=>true, 'class'=>'chosen filterSelect')) }}
          </div>
        </div>

       <div class="col-xs-11  col-md-2">
          <div class="form-group filterFormGroup">
            {{ Form::label('equipment', 'Equipment') }}
            {{ Form::select('equipment[]', $equipment, null, array('multiple'=>true, 'class'=>'chosen filterSelect')) }}
          </div>
        </div>

        <div class="col-xs-11  col-md-4">
          <div class="form-group filterFormGroup apply-filter">
            <input type="submit" id="submit" class="btn btn-custom-blue pull-right" value="Apply Filters">
            <a class="btn btn-custom-blue pull-right" id="reset-button"  href="/" >Reset </a>
          </div>
        </div>

      {{ Form::close() }}

    </div>
  </div>
</div>

<?php if ( Session::get('message') ): ?>
<div class="alert alert-success">{{ Session::get('message'); }}</div>
<?php endif; ?>

<div class="row">
  <div class="col-xs-12">
    <div class="tabbable">

      <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
        <li class="active">
          <a data-toggle="tab" href="#list-tab">List</a>
        </li>
        <li>
          <a data-toggle="tab" id="map-button" href="#map-tab">Map</a>
        </li>
      </ul>

      <div class="tab-content">
        <div id="list-tab" class="tab-pane in active">
          <div id="clinics_list">
        		<table id="facilities-table" class="table table-responsive table-striped table-bordered table-hover">
        			<thead>
        				<tr>
        					<th>{{ ucfirst($instance->facility_term) }}</th>
        					<th class="hidden-480">Address</th>

                  @if(Session::get('currentPosition'))
                  <th>
                    Distance
                  </th>
                  @endif

        		      <th class="center">Status</th>

                  @if(Auth::check() && Auth::user()->can('insert_facilities'))
                  <th><a href="facilities/create">Create</th>
                  @endif

        				</tr>
        			</thead>
        			<tbody>
        				@foreach ($facilities as $facility)
        				<tr>
        		  <td class="facility-name">
                    <a href="facilities/{{$facility->id}}">{{{ $facility->facilityname }}}</a>
                  </td>

        		  <td class="hidden-480 facility-address">
                    {{{ HTML::nl2comma($facility->facilityaddress) }}}
                  </td>

                  @if($currentPosition = Session::get('currentPosition'))
                    <td>
                    @if($distance = $facility->getDistance($currentPosition))
                      {{ $distance }}
                    @else
                      unknown
                    @endif
                    </td>
                  @endif

                  <td class="facility-status center">
                    @if($facility->status == "Open")
                      <span class="label label-sm label-success">Open</span>
                    @elseif($facility->status == "On Call")
                      <span class="label label-sm label-warning">On Call</span>
                    @else
                      <span class="label label-sm label-danger">Closed</span>
                    @endif
        		  </td>

                  @if(Auth::check())
                    @if(Auth::user()->canEditFacility($facility))
                      <td
                        @if($number_issues =  count($facility->errors))
                          title="{{ "{$number_issues} unresolved issues" }}"
                        @endif
                      >
                        <a href="facilities/{{$facility->id}}/edit">
                          Edit
                          @if($number_issues)
                          <i class="icon-flag red"></i>
                          @endif
                        </a>
                      </td>
                    @else
                      <td
                        class="disabled"
                        title="You do not have permission to edit this {{ $instance->facility_term }}"
                      >
                        Edit
                      </td>
                    @endif
                  @endif

        				</tr>
        				@endforeach
        			</tbody>
            </table>
          </div>
        </div>
  	
        <div id="map-tab" class="tab-pane">
          <div id="multi-map-canvas" style="width: 100%; height: 500px"></div>
          @include('partials.mapLegend')
          <br>
        </div>
      </div>

    </div>
  </div>
</div>
@stop

@section('scripts')

  <!-- page specific plugins -->
  <script src="assets/js/jquery.dataTables.min.js"></script>
  <script src="assets/js/jquery.dataTables.bootstrap.js"></script>

  <!-- page specific script -->
  <script>

    var allowedToAlter = {{ Auth::check() ? 'true' : 'false' }};

    // server data
    var facilities = {{ json_encode($facilities->toArray()) }};

    // ---------------------------------------- //
    //                    table                 //
    // ---------------------------------------- //

    // if we have currentPosition set, then assume one extra sortable column
    var aoColumns = currentPosition ?
                    [null, null, null, null] :
                    [null, null, null] ;

    if(allowedToAlter){
      aoColumns.push({ "bSortable": false });
    }

    var oTable1 = $('#facilities-table').dataTable({
      "aoColumns": aoColumns,
      "bFilter" : false,            
      "bLengthChange": false
    });
  
    $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
    function tooltip_placement(context, source) {
      var $source = $(source);
      var $parent = $source.closest('table')
      var off1 = $parent.offset();
      var w1 = $parent.width();

      var off2 = $source.offset();
      var w2 = $source.width();

      if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
      return 'left';
    }

    // ---------------------------------------- //
    //                    map                   //
    // ---------------------------------------- //

    var map = null;

    $("#map-button").click(function(){

      setTimeout(function(){
        if(!map){
          map = map_helper.buildStandardMap($("#multi-map-canvas"));
        }

        var infowindow = new google.maps.InfoWindow();

        $(facilities).each(function(){
          if(this.lat && this.lng){
            map_helper.addFacilityMarker(map, this);
          }
        });

      }, 1);
    });

  </script>

@stop

@section('styles')

  {{ HTML::style('/assets/css/custom/facility/index.css') }}

@stop
