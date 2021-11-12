@extends('admin.layouts.admin')

@section('content')

	<div class="row">
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#courseAssign">
		Assign Course Teacher
		</button>
		<!-- Modal -->
		<div class="modal fade" id="courseAssign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Assign Course Teacher</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="{{ URL::to('/assign/course/teacher') }}" method="post" id="assignCourse">
							@csrf
							<div class="row">
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
										<label for="">Session</label>
										<select name="session_id" class="form-control">
											<option disabled selected>Select Session</option>
											@foreach($sessions as $session)
											<option value="{{ $session->id }}">{{ $session->name }}</option>
											@endforeach
										</select>
										@error('session_id')
                                            <div class="alert alert-danger mt-2">
                                            	<span class="text-small">{{ $message }}</span>
                                            </div>
                                        @enderror
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="">Teacher</label>
										<select name="user_id" class="form-control">
											<option disabled selected>Select Teacher</option>
											@foreach($teachers as $teacher)
											<option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
											@endforeach
										</select>
										@error('user_id')
                                            <div class="alert alert-danger mt-2">
                                            	<span class="text-small">{{ $message }}</span>
                                            </div>
                                        @enderror
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="">Status</label>
										<select name="status" class="form-control">
											<option disabled selected>Select Status</option>
											<option value="1">Active</option>
											<option value="0">Deactive</option>
										</select>
										@error('status')
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
						<button type="submit" form="assignCourse" class="btn btn-primary">Create</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row mt-3">
	    <div class="col-12">
	        <div class="card">
	            <div class="card-header">
	                <h3 class="card-title">Course Assigned</h3>
	            </div>
	            <!-- /.card-header -->
	            <div class="card-body table-responsive p-0">
	                <table class="table table-hover text-nowrap">
	                    <thead>
	                        <tr>
	                            <th>ID</th>
	                            <th>Course</th>
	                            <th>Session</th>
	                            <th>Teacher</th>
	                            <th>Status</th>
	                            <th>Created At</th>
	                            <th>Updated At</th>
	                            <th colspan="2" class="text-center">Action</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    @if(sizeof($assigncourses) != 0)
	                    @foreach( $assigncourses as $assigncourse )
	                        <tr>
	                            <td>{{ $assigncourse->id }}</td>
	                            <td>{{ $assigncourse->course->name }}</td>
	                            <td>{{ $assigncourse->session->name }}</td>
	                            <td>{{ $assigncourse->user->name }}</td>
	                            <td>{{ $assigncourse->status }}</td>
	                            <td>{{ $assigncourse->created_at->diffForHumans() }}</td>
	                            <td>{{ $assigncourse->updated_at->diffForHumans() }}</td>
	                            <td class="text-center">
	                                Edit
	                            </td>
	                            <td class="text-center">
	                                <!-- Button trigger modal -->
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