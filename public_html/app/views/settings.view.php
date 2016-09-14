[include]app/views/header.view.php[/include]
<div class="container-fluid">
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default my-panel">
					<div class="panel-heading my-panel-heading">User Profile Settings</div>
					<div class="panel-body">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-4">
									<b>Profile picture:</b><br>
									<img src="{{thumb}}" class="img-responsive"><br>
									<form action="/editPicture/" method="post" enctype="multipart/form-data">
										<div class="form-group">
										    <input type="file" class="form-control" name="profilePicture" id="profilePicture">
										</div>
										<button type="submit" class="btn btn-default">Change picture</button>
									</form>
								</div>

								<div class="col-md-8">
									<b>Wall Picture:</b><br>
									<img src="{{thumbW}}" class="img-responsive"><br>
									<form action="/editWall/" method="post" enctype="multipart/form-data" class="text-center">
										<div class="form-group">
										    <input type="file" class="form-control" name="profilePicture" id="profilePicture">
										</div>
										<button type="submit" class="btn btn-default">Change wall</button>
									</form>
								</div>


							</div>
							<div class="row">
								<div class="col-md-4">
									<br>
									<form action="/editUser/" method="post" class="col-md-8">
										  <div class="form-group">
										    <label for="email">Email address:</label>
										    <input type="email" class="form-control" name="email" id="email" value="{{email}}">
										  </div>

										  <div class="form-group">
										    <label for="age">Age:</label>
										    <input type="number" class="form-control" name="age" id="age" min="1" max="130"value="{{age}}">
										  </div>

										<div class="form-group">
										    <label for="sex">Sex:</label>
										    <select class="form-control" name="sex" id="sex">
										    	<option value="{{sex}}">{{sex}}</option>
										    	<option value="Male">Male</option>
										    	<option value="Female">Female</option>
										    	<option value="Shemale">Shemale</option>
										    	<option value="Not-Disclosed">Not-Disclosed</option>
										    	<option value="Pablo Van Gough">Pablo Van Gough</option>
										    	<option value="Gender Fluid">Gender Fluid</option>
										    	<option value="What ever you pay me to be">What ever you pay me to be</option>
										    </select>
										</div>
										<button type="submit" class="btn btn-default">Edit Account</button>
									</form>
								</div><!-- col-md-6 -->

								<div class="col-md-8">
									<br>
								 	<div class="panel panel-default">
										<div class="panel-heading my-panel-heading">DESCRIPTION</div>
										<div class="panel-body">
										<form action="/editDescription/" method="post">
											<div class="form-group">
											  <textarea class="form-control" rows="5" name="journal" id="journal" maxlength="5000">{{description}}</textarea>
											</div>
											<button type="submit" class="btn btn-default">Edit Description</button>
										</form>
										</div>
									</div>
								</div> <!-- col-md-6 -->

							</div><!-- row -->
						</div> <!-- container-fluid -->
					</div> <!-- panel-body -->
				</div><!-- panel-default -->
			</div> <!-- col-md-8 -->

		</div> <!-- row -->


</div>		
[include]app/views/footer.view.php[/include]				