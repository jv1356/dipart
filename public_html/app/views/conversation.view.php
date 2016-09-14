[include]app/views/header.view.php[/include]
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default my-panel">
				<div class="panel-heading my-panel-heading"><h4>{{chats[0]['group_name']}}</h4></div>
				<div class="panel-body">
					<div class='container-fluid' id='listOfMessages'  style='max-height:500px;overflow:auto;overflow-x: hidden; '>
						<div style='margin-right:1%;margin-left:1%;'>
							<?
								foreach ($chats as $msg) {
									if(empty($msg['avatar'])){
										$msg['avatar'] = "https://placeholdit.imgix.net/~text?txtsize=8&txt=ProfilePic2&w=140&h=140";
	 								}
	 								else{
	 									$msg['avatar'] = "/".$msg['avatar'];
	 								}
									echo"<div class='row'>";
										if(!($_SESSION['userid'] == $msg['Messages_Users_id'])){
											echo"
												<div class='col-md-8 panel panel-success padding-1'>

													<div class='pull-left col-md-2'>
															<div style='padding:1%;'>
																<a href='/profile/u/{$msg['name']}/'>
																<img src='{$msg['avatar']}' style='width: 70px; height: 70px;' class='img-circle'>
																</a><br>
																{$msg['created']}
															</div>
													</div>

													<div class='col-md-10 pull-right vcenter'>
														<div class='container-fluid'>
															<div class='row'>&nbsp;</div>

															<div class='row text-left bg-success padding-2'>
																{$msg['text']}
															</div>

															<div class='row'>&nbsp;</div>
														</div>
													</div>

												</div>

												<div class='col-md-4'> &nbsp; </div>
											";
										}
										else{

											echo"

												<div class='col-md-4'> &nbsp; </div>

												<div class='col-md-8 panel panel-info padding-1'>

													<div class='pull-right col-md-2'>
															<div style='padding:1%;'>
																<a href='/profile/u/{$msg['name']}/'>
																<img src='{$msg['avatar']}' style='width: 70px; height: 70px;' class='img-circle'>
																</a><br>
																{$msg['created']}
															</div>
													</div>

													<div class='col-md-10 pull-right vcenter'>
														<div class='container-fluid'>
															<div class='row'>&nbsp;</div>

															<div class='row text-left bg-info padding-2 my-panel'>
																{$msg['text']}
															</div>

															<div class='row'>&nbsp;</div>
														</div>
													</div>

												</div>
											";
										}
									echo"</div>";
								}
							?>
						</div>
					</div>
				</div>
			</div>			
		</div> <!-- col-md-8 -->

		<div class='col-md-4'>
			<div class="panel panel-default my-panel">
				<div class="panel-heading my-panel-heading">CONVERSATIONS &nbsp; <a href='/newMessage/u/{{username}}/'><span class='label label-default'>Compose new</span></a></div>
				<div class="panel-body">
					<div class='row'>
						<div class='col-md-4'>
							<b>NAME</b>
						</div>
						<div class='col-md-4'>
							<b>DATE</b>
						</div>
						<div class='col-md-2'>
							&nbsp;
						</div>
					</div>
					<?
						foreach ($msgs as $msg) {
							$gname = $msg["group_name"];
							if($msg['unread'] == 1){
								$gname = "<b>{$gname}</b>";
							}
							echo"
								<div class='row'>
									<div class='col-md-4'>
										{$gname}
									</div>
									<div class='col-md-4'>
										{$msg['created']}
									</div>
									<div class='col-md-1'>
										<a href='/conversation/u/{$username}/c/{$msg['Conversations_id']}/'>Open</a>
									</div>
									<div class='col-md-1'>
										<a href='/messageHistory/u/{$username}/c/{$msg['Conversations_id']}/'>History</a>
									</div>
								</div>
							";
						}

					?>
				</div>
			</div>
		</div> <!-- col-md-4 -->
	</div>

	<div class="row">
		<div class='col-md-8'>
			<div class="panel panel-default my-panel">
				<div class="panel-heading my-panel-heading">Post Message</div>
				<div class="panel-body">
					<form action="/postMessage/" method="post">
						<div class="form-group">
							<input type='hidden' name='cid' value='{{cid}}' />
							<input type='hidden' name='u' value='{{username}}' />
						</div>
						<div class="form-group">
						  <textarea class="form-control" rows="4" name="message" id="message" maxlength="500" placeholder="Message..."></textarea>
						</div>
						<button type="submit" class="btn btn-default">Post Message</button>
					</form>
				</div>
			</div>				
		</div><!-- col-md-8 -->
	</div><!-- row -->	
</div>		
[include]app/views/footer.view.php[/include]				