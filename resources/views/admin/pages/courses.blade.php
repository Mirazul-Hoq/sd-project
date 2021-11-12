@extends('admin.layouts.admin')

@section('content')

	<div class="row">
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#courseAdd">
		Create Course
		</button>
		<!-- Modal -->
		<div class="modal fade" id="courseAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Create Course</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="{{ URL::to('courses') }}" method="post" id="createCourse">
							@csrf
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="name">Course Name</label>
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
										<label for="course_code">Course Code</label>
										<input type="text" class="form-control" name="course_code" id="course_code">
										@error('course_code')
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
						<button type="submit" form="createCourse" class="btn btn-primary">Create</button>
					</div>
				</div>
			</div>
		</div>
	</div>

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
	                            <th>Course Code</th>
	                            <th>Status</th>
	                            <th>Created At</th>
	                            <th>Updated At</th>
	                            <th colspan="2" class="text-center">Action</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    @if(sizeof($courses) != 0)
	                    @foreach( $courses as $course )
	                        <tr>
	                            <td>{{ $course->id }}</td>
	                            <td>{{ $course->name }}</td>
	                            <td>{{ $course->course_code }}</td>
	                            <td>{{ $course->status }}</td>
	                            <td>{{ $course->created_at->diffForHumans() }}</td>
	                            <td>{{ $course->updated_at->diffForHumans() }}</td>
	                            <td class="text-center">
	                                <!-- Button trigger modal -->
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-{{ $course->id }}">
									Edit
									</button>
									<!-- Modal -->
									<div class="modal fade" id="edit-{{ $course->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Edit Course</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form action="{{ URL::to('/courses/update/'.$course->id) }}" method="post" id="updateCourse">
														@csrf
														@method('PATCH')
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<label for="name">Course Name</label>
																	<input type="text" class="form-control" name="name" id="name" value="{{ $course->name }}">
																	@error('name')
							                                            <div class="alert alert-danger mt-2">
							                                            	<span class="text-small">{{ $message }}</span>
							                                            </div>
							                                        @enderror
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<label for="course_code">Course Code</label>
																	<input type="text" class="form-control" name="course_code" id="course_code" value="{{ $course->course_code }}">
																	@error('course_code')
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
																		<option value="1" @if($course->status == 1) selected @endif>Active</option>
																		<option value="0" @if($course->status == 0) selected @endif>Deactive</option>
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
													<button type="submit" form="updateCourse" class="btn btn-primary">Create</button>
												</div>
											</div>
										</div>
									</div>
	                            </td>
	                            <td class="text-center">
	                                <!-- Button trigger modal -->
									<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-{{ $course->id }}">
									Delete
									</button>
									<!-- Modal -->
									<div class="modal fade" id="delete-{{ $course->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Delete</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													Are you sure you want to delete {{ $course->name }} ?
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													<form action="{{ URL::to('/courses/delete/'.$course->id) }}" method="post">
														@csrf
														@method('DELETE')
														<button type="submit" cursor="pointer" class="btn btn-danger">Delete</button>
													</form>
												</div>
											</div>
										</div>
									</div>
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