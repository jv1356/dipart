[include]app/views/header.view.php[/include]

<? /* page content */ ?>
<!-- body -->
<div class="container-fluid">
	<div class='row'>
			<div class="col-md-8 pull-left">
				<div class="panel panel-default my-panel">

					<div class="panel-heading my-panel-heading">
								<b>{{title}}</b>
					</div>

					<div class="panel-body">
						<div class="container-fluid">
							<div class="row text-center">
								<a href='/{{floc}}' target='_blank'>
									<img src='/{{tloc}}' height='400px' width='auto'>
								</a>
							</div>

							<div class="row text-center">
								<b>{{title}}</b>
							</div>

							<div class="row">
								<hr>
							</div>					

							<div class="row">
								<div class="col-md-12 text-center">
									<div class="col-md-5 pull-left"> </div>
									<div class="col-md-2 pull-left">
									<div class="text-center">
									<span class='bigger'>&#x1f44d;</span>
									&nbsp;
									<span class='bigger'>&#x1f44e;</span>
									</div>
									</div>
									<div class="col-md-2 pull-right"> {{favourite}} </div>
				
								</div>
							</div>

							<div class="row">
								<hr>
							</div>					

							<div class="row">
								<div class="col-md-12 text-left">
									<b>Description</b><br><br>
									{{desc}}
								</div>
							</div>							

							<div class="row">
								<hr>
							</div>	

							<div class="row">
								<div class="col-md-12">
									<b>Tags:</b>&nbsp;
									<?
										$tgs = "";
										foreach($tags as $tag){
											$tgs .= $tag.", ";
										}
										$tgs = trim($tgs, ", ");
										echo($tgs);
									?>
								</div>
							</div>
						</div><!-- container-fluid -->
					</div><!-- panel-body -->
				</div><!-- panel panel-default -->
			</div><!-- col-md-8 -->

			<div class="col-md-4 pull-right">
				<div class="panel panel-default my-panel">
					<div class="panel-heading my-panel-heading"><b>More</b></div>
					<div class="panel-body">
						<div class="row">
							<div class='col-md-12'>
								<h4>By {{op}}</h4>
									<?
										foreach ($rs as $sub) {
											$title = $sub['title'];
											$sid = $sub['id'];
											echo"
											<a href='/sub/u/{$op}/s/{$sid}/'>
											<img src='/{$sub['thumb_location']}' class='img-thumbnail img-responsive' alt='{$title}' title='{$title}' style='width:160px;height:160px;object-fit:none;object-position:center;'>
											</a>";
										}
									?>
							</div>
						</div>
						<div class="row">&nbsp;</div>
						<div class="row">
							<div class='col-md-12'>
								<h4>You may like</H4>
									<?
										foreach ($srs as $sub) {
											$title = $sub['title'];
											$sid = $sub['id'];
											echo"
											<a href='/sub/u/{$op}/s/{$sid}/'>
											<img src='/{$sub['thumb_location']}' class='img-thumbnail img-responsive' alt='{$title}' title='{$title}' style='width:160px;height:160px;object-fit:none;object-position:center;'>
											</a>";
										}
									?>
							</div>
						</div>

						<div class="row"><hr></div>
						<div class="row">
							<div class='col-md-12'>
								<h4>Details</h4>

								<div class='row'>
									<div class='col-md-3'>
										&nbsp;Submitted on:
									</div>
									<div class='col-md-4'>
										&nbsp;{{created}}
									</div>
								</div>
								<div class='row'>
									<div class='col-md-3'>
										&nbsp;Image size:
									</div>
									<div class='col-md-3'>
										&nbsp;{{size}} {{units}}
									</div>
								</div>
								<div class='row'>
									<div class='col-md-3'>
										&nbsp;Resolution
									</div>
									<div class='col-md-3'>
										&nbsp;{{width}} x {{height}}
									</div>							
								</div>
								<div class='row'>
									<div class='col-md-3'>
										&nbsp;Views
									</div>
									<div class='col-md-3'>
										&nbsp;{{numViews}}
									</div>							
								</div>
							</div>					
						</div>					
					</div><!-- panel-body -->
				</div><!-- panel panel-default -->

			</div><!-- col-md-4  -->
		<? 
		if(sizeOf($auctions) != 0 && !is_null($auctions[0]['name'])){
			require_once("app/views/auctioninfo.view.php");
		}

	?>

	<? $sid = $_GET['s']; ?>
			<div class="col-md-8 pull-left">
			<div class="container-fluid">
				<div class="row">
					<div class="panel panel-default my-panel">
						<div class="panel-heading my-panel-heading"><b>Comments</b></div>
						<div class="panel-body">
							<div class="container-fluid">
								<div class="row">
									<form action="/postComment/" method="post">
										<div class="form-group">
											<input type='hidden' name='sid' value='{{sid}}' />
											<input type='hidden' name='u' value='{{u}}' />
										</div>
										<div class="form-group">
										  <textarea class="form-control" rows="4" name="comment" id="comment" maxlength="250" placeholder="Write your comment..."></textarea>
										</div>
										<button type="submit" class="btn btn-default">Post Comment</button>
									</form>
								</div>

								<div class="row"><hr><hr></div>

								<?
									foreach ($comments as $comment) {
										if(empty($comment['avatar'])){
											$comment['avatar'] = "https://placeholdit.imgix.net/~text?txtsize=8&txt=ProfilePic2&w=150&h=150";
										}
										else{
											$comment['avatar'] = "/".$comment['avatar'];
										}
										$ex = explode(" ", $comment['created']);
										$comment['created'] = implode("<br>", $ex);
										echo"
										<div class='row'>
											<div class='col-md-2'>
												<a href='/profile/u/{$comment['name']}/'>
												<b>{$comment['name']}</b><br>
												<img src='{$comment['avatar']}' width='100px' height='100px' />
												</a>
												<br>
												<font class='small'>{$comment['created']}</font>
											</div>
											<div class='col-md-10'>
												{$comment['text']}
											</div>

										</div>

										<div class='row'><hr></div>

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
</div><!-- body container-fluid -->

[include]app/views/footer.view.php[/include]