@extends('admin.layouts.admin')

@section('content')
	@if(sizeof($m) == 0)
	<div class="row">
		<div class="col-12">
			<h1>Add Group Member</h1>
			<form action="{{ URL::to('student/group/member') }}" method="post" class="mt-3">
				@csrf
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" class="form-control" name="name[]" id="name" value="{{$user->name}}" readonly>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" name="email[]" id="email" value="{{$user->email}}" readonly>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="student_id">Student Id</label>
							<input type="text" class="form-control" name="student_id[]" id="student_id" value="{{$user->student_id}}" readonly>
						</div>
					</div>
					@for($i = 1; $i < $g->member_no; $i++)
					<div class="col-md-4">
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" class="form-control" name="name[]" id="name">
							@error('name')
	                            <div class="alert alert-danger mt-2">
	                            	<span class="text-small">{{ $message }}</span>
	                            </div>
	                        @enderror
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" name="email[]" id="email">
							@error('email')
	                            <div class="alert alert-danger mt-2">
	                            	<span class="text-small">{{ $message }}</span>
	                            </div>
	                        @enderror
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="student_id">Student Id</label>
							<input type="text" class="form-control" name="student_id[]" id="student_id">
							@error('student_id')
	                            <div class="alert alert-danger mt-2">
	                            	<span class="text-small">{{ $message }}</span>
	                            </div>
	                        @enderror
						</div>
					</div>
					@endfor
					<input type="hidden" value="{{ $g->member_no }}" name="member_no">
					<input type="hidden" value="{{ $g->id }}" name="group_id">
					<div class="col-12">
						<div class="form-group">
							<button type="submit" class="btn btn-dark">Register Group Member</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	@else
	<div class="row mt-3">
	    <div class="col-12">
	        <div class="card">
	            <div class="card-header">
	                <h3 class="card-title">Members</h3>
	            </div>
	            <!-- /.card-header -->
	            <div class="card-body table-responsive p-0">
	                <table class="table table-hover text-nowrap">
	                    <thead>
	                        <tr>
	                            <th>ID</th>
	                            <th>Name</th>
	                            <th>Email</th>
	                            <th>Student ID</th>
	                            <th>Created At</th>
	                            <th>Updated At</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    @if(sizeof($m) != 0)
	                    @foreach( $m as $member )
	                        <tr>
	                            <td>{{ $member->id }}</td>
	                            <td>{{ $member->name }}</td>
	                            <td>{{ $member->email }}</td>
	                            <td>{{ $member->student_id }}</td>
	                            <td>{{ $member->created_at->diffForHumans() }}</td>
	                            <td>{{ $member->updated_at->diffForHumans() }}</td>
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
	@endif
@endsection