@extends('admin.layouts.admin')

@section('content')
	<div class="row mt-3">
	    <div class="col-12">
	        <div class="card">
	            <div class="card-header">
	                <h3 class="card-title">Courses</h3>
	            </div>
	            <!-- /.card-header -->
	            <div class="card-body table-responsive p-0">
	                <table class="table table-hover text-nowrap">
	                    <thead>
	                        <tr>
	                            <th>ID</th>
	                            <th>Name</th>
	                            <th>Email</th>
	                            <th>Teacher ID</th>
	                            <th>Role</th>
	                            <th>Created At</th>
	                            <th>Updated At</th>
	                            <th>Action</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    @if(sizeof($teachers) != 0)
	                    @foreach( $teachers as $teacher )
	                        <tr>
	                            <td>{{ $teacher->id }}</td>
	                            <td>{{ $teacher->name }}</td>
	                            <td>{{ $teacher->email }}</td>
	                            <td>{{ $teacher->teacher_id }}</td>
	                            <td>{{ $teacher->role }}</td>
	                            <td>{{ $teacher->created_at->diffForHumans() }}</td>
	                            <td>{{ $teacher->updated_at->diffForHumans() }}</td>
	                            <td class="text-center">
	                                Delete
	                            </td>
	                        </tr>
	                    @endforeach
	                    @else
	                        <tr>
	                            <td colspan="8" class="text-center">No Data to show</td>
	                        </tr>
	                    @endif
	                    </tbody>
	                </table>
	            </div>
	            <!-- /.card-body -->
	        </div>
	        <!-- /.card -->
	    </div>
	</div>

@endsection