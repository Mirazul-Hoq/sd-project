@extends('admin.layouts.admin')

@section('content')

<div class="alert alert-success">
	Dashboard
	{{ auth()->user()->role }}
</div>

@endsection