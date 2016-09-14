[include]app/views/headerLogin.view.php[/include]

<? /* page content */ ?>
<!-- body -->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default my-panel">
				<div class="panel-heading my-panel-heading"><b>Welcome</b></div>
				<div class="panel-body text-center">
					<h2>Get IN</h2>
					<br>
					<div class="container-fluid">
						<div class="col-md-4"> &nbsp; </div>

						<div class="col-md-4 text-center">
							<form method="post" action="/login/" class="text-center">
							  <div class="form-group">
							    <label for="username">Username:</label>
							    <input type="text" class="form-control" name="username" id="username" required>
							  </div>
							  <div class="form-group">
							    <label for="pwd">Password:</label>
							    <input type="password" class="form-control" name="pwd" id="pwd" required>
							  </div>

							  <button type="submit" class="btn btn-default" name="login">Login</button>
							  &nbsp;&nbsp;&nbsp;
							  <button type="button" class="btn btn-default" name="signup" data-toggle="collapse" data-target="#register">Sign Up</button>

							  	<div id="register" class="collapse">
							  		<br>
							  		<div class="form-group">
										<label for="repwd">Retype password:</label>
							    		<input type="password" class="form-control" name="repwd" id="repwd">
									</div>

									<div class="form-group">
									    <label for="email">Email:</label>
									    <input type="email" class="form-control" name="email" id="email">
									</div>

									<button type="submit" class="btn btn-default" name="register">Agree and Register</button>
									<br><br>

							  	</div>

							</form>
						</div>

						<div class="col-md-4"> &nbsp; </div>

					</div>
				</div>
			</div><!-- panel -->
		</div> <!-- col-md-8 -->

		<div class="col-md-4">
			<div class="panel panel-default my-panel">
				<div class="panel-heading my-panel-heading"><b>About</b></div>
				<div class="panel-body text-center">
									<p>WELCOME TO THE DIPART WEBSITE. DIPART WILL ALLOW USE OF THIS WEBSITE PURSUANT TO THE TERMS AND CONDITIONS ("Terms") LISTED BELOW. USE OF THIS WEBSITE SHALL CONSTITUTE YOUR COMPLETE AGREEMENT TO THESE Terms. IF YOU DO NOT AGREE TO THE Terms LISTED BELOW PLEASE DO NOT USE THIS WEBSITE.<br /><br><b>Limited License</b></p>
<p>All contents on the dipart website are protected by copyright. dipart hereby authorizes you to view and copy information ("Materials") on the public portions of the dipart website ("Site") to a personal computer solely for non-commercial, personal and informational use associated with your interaction with the Site. Any material or information taken from the Site shall retain all copyright and other proprietary notices in the same form and manner as on the original. Except as stated hereunder, you have no right to copy, download, perform, reproduce, display, distribute, modify, edit, alter or enhance any of the Materials. This limited license terminates automatically, without notice to you, if you breach any of these terms. Upon termination you agree to destroy any downloaded or copied materials. You agree to abide by all additional restrictions displayed on the Site as it may be updated from time to time. This Site, including all Materials, is copyrighted and protected by worldwide copyright laws and treaty provisions.</p>
<p><b>General Restrictions</b></p>
<p>If dipart becomes aware of inappropriate use of the Site or Materials dipart reserves the right to, at its sole discretion, respond in a manner that is seemingly appropriate.</p>
				</div>
			</div>
		</div>
	</div> <!-- row -->
</div>


[include]app/views/footer.view.php[/include]		