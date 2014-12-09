@extends('layouts.default')

@section('content')

<h3>Already Resolved</h3>

This issue was already resolved on {{ HTML::date_formal($error->resolved_on) }} by {{ $resolved_by->fullName() }}.

@stop