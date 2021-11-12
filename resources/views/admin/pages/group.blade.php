@extends('admin.layouts.admin')

@section('content')

	<div class="row">
		@if(session('msg'))
		<div class="alert alert-danger col-12">
			{{ session('msg') }}
		</div>
		@endif
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#groupAdd">
		Create Group
		</button>
		<!-- Modal -->
		<div class="modal fade" id="groupAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Create Group</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="{{ URL::to('/student/group') }}" method="post" id="createGroup">
							@csrf
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="name">Group Name</label>
										<input type="text" class="form-control" name="name" id="name">
										@error('name')
                                            <div class="alert alert-danger mt-2">
                                            	<span class="text-small">{{ $message }}</span>
                                            </div>
                                        @enderror
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="">Course</label>
										<select name="course_id" class="form-control">
											<option disabled selected>Select Course</option>
											@foreach($courses as $course)
											<option value="{{ $course->id }}">{{ $course->name }}</option>
											@endforeach
										</select>
										@error('course_id')
                                            <div class="alert alert-danger mt-2">
                                            	<span class="text-small">{{ $message }}</span>
                                            </div>
                                        @enderror
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="member_no">Member No</label>
										<input type="number" class="form-control" name="member_no" id="member_no">
										@error('member_no')
                                            <div class="alert alert-danger mt-2">
                                            	<span class="text-small">{{ $message }}</span>
                                            </div>
                                        @enderror
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" form="createGroup" class="btn btn-primary">Create</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row mt-3">
	    <div class="col-12">
	        <div class="card">
	            <div class="card-header">
	                <h3 class="card-title">Groups</h3>
	            </div>
	            <!-- /.card-header -->
	            <div class="card-body table-responsive p-0">
	                <table class="table table-hover text-nowrap">
	                    <thead>
	                        <tr>
	                            <th>ID</th>
	                            <th>Group Name</th>
	                            <th>Course Name</th>
	                            <th>Member No</th>
	                            <th>Created At</th>
	                            <th>Updated At</th>
	                            <th>Action</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    @if(sizeof($groups) != 0)
	                    @foreach( $groups as $group )
	                        <tr>
	                            <td>{{ $group->id }}</td>
	                            <td>{{ $group->name }}</td>
	                            <td>{{ $group->course->name }}</td>
	                            <td>{{ $group->member_no }}</td>
	                            <td>{{ $group->created_at->diffForHumans() }}</td>
	                            <td>{{ $group->updated_at->diffForHumans() }}</td>
	                            <td><a href="{{ URL::to('student/group/member/'.$group->id) }}" class="btn btn-info">Group member</a></td>
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


