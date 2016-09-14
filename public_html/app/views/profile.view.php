[include]app/views/header.view.php[/include]
<div class="container-fluid">
	<div class='row'>
		<div class="col-md-4 pull-right">
			<div class="panel panel-default my-panel">
				<div class="panel-heading my-panel-heading"><b>Latest Submissions</b></div>
				<div class="panel-body">
					<div class="container-fluid">
						<div class="text-center">
							<?
								foreach($subs as $sub){
									$title = $sub['title'];
									$sid = $sub['id'];
									echo"
									<a href='/sub/u/{$userName}/s/{$sid}/'>
									<img src='/{$sub['thumb_location']}' class='img-thumbnail img-responsive' alt='{$title}' title='{$title}' style='width:160px;height:160px;object-fit:none;object-position:center;'>
									</a>";
								}
							?>
						 </div>
					</div>
				</div>
			</div>
		</div>

			
		<div class="col-md-8 pull-left">
			<div class="panel panel-default my-panel">
				<div class="panel-heading my-panel-heading"><b>User Profile Page<b></div>
				<div class="panel-body">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-4">
								<h4>Profile picture 
									<? if($uid == $_SESSION['userid']) { ?>
										&nbsp; <a href='/settings/u/{{username}}/'><span class="glyphicon glyphicon-pencil"></span></a>
									<? } ?>
								</h4>
								<a href='{{avatar}}' target='_blank'><img src="{{thumb}}" class="img-responsive"></a>
							</div>

							<div class="col-md-8">
								<a href='{{wall}}' target='_blank'><img src="{{thumbW}}" class="img-responsive" style='max-width:600px;max-height:250px;object-fit:none;object-position:center;'></a>																		
							</div><!-- col-md-8 -->
						</div><!-- row -->

						<div class="row">
							<div class="col-md-4">
								<div class="container-fluid">
									<div class="row">
										<div class="col-md-8"><h4>Profile info
										<? if($uid == $_SESSION['userid']) { ?>
										 &nbsp; <a href='/settings/u/{{username}}/'><span class="glyphicon glyphicon-pencil"></span></a></h4>
										 <? } ?>
										 </div>
									</div>
									<div class="row">
										<div class="col-md-4"><b>Username:</b></div>
										<div class="col-md-4">{{username}}</div>
									</div>
									<div class="row">
										<div class="col-md-4"><b>Email:</b></div>
										<div class="col-md-4">{{email}}</div>
									</div>
									<div class="row">
										<div class="col-md-4"><b>Sex:</b></div>
										<div class="col-md-4">{{sex}}</div>
									</div>
									<div class="row">
										<div class="col-md-4"><b>Age:</b></div>
										<div class="col-md-4">{{age}}</div>
									</div>
									<div class="row">
										<div class="col-md-4"><b>Grade:</b></div>
										<div class="col-md-4">{{age}}/100</div>
									</div>										
								</div>
							</div><!-- col-md-6 -->

							<div class="col-md-8">
								<div class="panel panel-default my-panel">
									<div class="panel-heading my-panel-heading">Description
										<? if($uid == $_SESSION['userid']) { ?>
										 &nbsp; <a href='/settings/u/{{username}}/'><span class="glyphicon glyphicon-pencil"></span></a></h4>
										 <? } ?>
									</div>
									<div class="panel-body" style="overflow:auto;">
										{{description}}
									</div>
								</div><!-- col-md-6 -->
							</div><!-- row -->							
						</div> <!-- container-fluid -->
					</div> <!-- panel-body -->
				</div><!-- panel-default -->
			</div> <!-- col-md-8 -->
		</div>


		<!-- gallery, favs and submissions -->
			<!-- gallery and favs -->
			<div class="col-md-8 pull-left">
				<div class="container-fluid">
					<div class="row">
						<div class="panel panel-default my-panel">
							<div class="panel-heading my-panel-heading"><b>Favorites<b></div>
							<div class="panel-body">
							<div class="container-fluid text-center">
								<?
									foreach ($favs as $fav) {
										$userName = $fav['name'];
										$thumb = "/".$fav['thumb_location'];
										$sid = $fav['Submissions_id'];
										echo"
										<a href='/sub/u/{$userName}/s/{$sid}/'>
											<img src='{$thumb}' class='img-thumbnail img-responsive preview' data-image-url='{$thumb}' rel='popover' style='width:160px;height:160px;object-fit:none;object-position:center;'>
										</a>
										";
									}

								?>
							</div>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>		
	</div>	
</div>	
[include]app/views/footer.view.php[/include]