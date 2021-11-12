@extends('admin.layouts.admin')

@section('content')

	<div class="row">
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sessionAdd">
		Create Session
		</button>
		<!-- Modal -->
		<div class="modal fade" id="sessionAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Create Session</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="{{ URL::to('session') }}" method="post" id="createSession">
							@csrf
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="name">Session Name</label>
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
						<button type="submit" form="createSession" class="btn btn-primary">Create</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row mt-3">
	    <div class="col-12">
	        <div class="card">
	            <div class="card-header">
	                <h3 class="card-title">Sessions</h3>
	            </div>
	            <!-- /.card-header -->
	            <div class="card-body table-responsive p-0">
	                <table class="table table-hover text-nowrap">
	                    <thead>
	                        <tr>
	                            <th>ID</th>
	                            <th>Name</th>
	                            <th>Status</th>
	                            <th>Created At</th>
	                            <th>Updated At</th>
	                            <th colspan="2" class="text-center">Action</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    @if(sizeof($sessions) != 0)
	                    @foreach( $sessions as $session )
	                        <tr>
	                            <td>{{ $session->id }}</td>
	                            <td>{{ $session->name }}</td>
	                            <td>{{ $session->status }}</td>
	                            <td>{{ $session->created_at->diffForHumans() }}</td>
	                            <td>{{ $session->updated_at->diffForHumans() }}</td>
	                            <td class="text-center">
	                                <!-- Button trigger modal -->
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-{{ $session->id }}">
									Edit
									</button>
									<!-- Modal -->
									<div class="modal fade" id="edit-{{ $session->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Edit Session</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form action="{{ URL::to('/sessions/update/'.$session->id) }}" method="post" id="updateSession">
														@csrf
														@method('PATCH')
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<label for="name">Session Name</label>
																	<input type="text" class="form-control" name="name" id="name" value="{{ $session->name }}">
																	@error('name')
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
																		<option value="1" @if($session->status == 1) selected @endif>Active</option>
																		<option value="0" @if($session->status == 0) selected @endif>Deactive</option>
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
													<button type="submit" form="updateSession" class="btn btn-primary">Update</button>
												</div>
											</div>
										</div>
									</div>
	                            </td>
	                            <td class="text-center">
	                                <!-- Button trigger modal -->
									<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-{{ $session->id }}">
									Delete
									</button>
									<!-- Modal -->
									<div class="modal fade" id="delete-{{ $session->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Delete</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													Are you sure you want to delete {{ $session->name }} ?
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													<form action="{{ URL::to('/sessions/delete/'.$session->id) }}" method="post">
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