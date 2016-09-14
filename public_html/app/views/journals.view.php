[include]app/views/header.view.php[/include]
<div class="container-fluid">
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default my-panel">
					<div class="panel-heading my-panel-heading">JOURNAL</div>
					<div class="panel-body">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-6">
									<b>{{latest['title']}}</b>
								</div>
								<div class="col-md-6 text-right">
									<b>{{latest['created']}}</b>
								</div>
							</div>
							<div class="drow"><hr></div>
							<div class="row">
								<div class="col-md-12 text-center">
									{{ltext}}
								</div>
							</div>
						</div>
					</div> <!-- panel-body -->
				</div><!-- panel-default -->
			</div> <!-- col-md-8 -->

			<div class="col-md-4">
				<div class="panel panel-default my-panel">
					<div class="panel-heading my-panel-heading">JOURNALS HISTORY
						<? if($uid == $_SESSION['userid']){ ?>
							&nbsp; &nbsp; &nbsp; &nbsp; <a href='/newJournal/u/{{user}}/'><span class="label label-default">New Journal</span></a></h4>
						<? } ?>
					</div>
					<div class="panel-body">
						<div class="container-fluid">
						<?
							if(sizeOf($journals) == 0){
								echo"No journal history!";
							}
							$cnt = 0;
							foreach ($journals as $j) {
								echo"<div class='row'>
									<div class='col-md-4'>
										<a href='/journals/u/{$user}/j/{$j['id']}/'>{$j['title']}</a>
									</div>
									<div class='col-md-4 text-right'>
										{$j['created']}
									</div>
									";
									if($uid == $_SESSION['userid']){ 
										echo"
										<div class='col-md-2 text-center'>
											<a href='/editJournal/u/{$user}/j/{$j['id']}/'><span class='label label-default'>Edit</span></a>
										</div>
										<div class='col-md-2 text-right'>
											<a href='#' onClick='deleteConfirm(\"delete{$cnt}\")' id='delete{$cnt}' data-value='{$user}-{$j['id']}'><span class='label label-default'>Delete</span></a>
										</div>";
									};
								echo"</div>";

								$cnt += 1;
							}
						?>
					</div>
					</div> <!-- panel-body -->
				</div><!-- panel-default -->
			</div> <!-- col-md-4 -->

		</div> <!-- row -->


		<? if($numJournals > 0) { ?>
			<!-- comments -->
			<div class="row">
				<div class="col-md-8">
					<div class="container-fluid">
						<div class="row">
							<div class="panel panel-default">
								<div class="panel-heading">COMMENTS</div>
								<div class="panel-body">
									<div class="container-fluid">
										<div class="row">
											<form action="/postComment/" method="post">
												<div class="form-group">
													<input type='hidden' name='jid' value='{{latest['id']}}' />
													<input type='hidden' name='u' value='{{user}}' />
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
														<img src='{$comment['avatar']}' width='50px' height='50px' />
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
		<? } ?>
</div>		
[include]app/views/footer.view.php[/include]				