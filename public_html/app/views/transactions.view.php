[include]app/views/header.view.php[/include]
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default my-panel">
				<div class="panel-heading my-panel-heading">TRANSACTIONS - SOLD</div>
				<div class="panel-body" stlye='max-height:600px; overflow:auto; overflow-x:hidden;'>
					
					<?
						if(sizeOf($trans) == 0){
							echo"<div class='row'>&nbsp; You haven't made any auctions yet.</div>";
						}
						foreach ($trans as $aid => $info) {
							$thumb = "/".$info['thumb'];
							$userName = $info['user'];
							$sid = $info['sid'];
							echo"<div class='row'>
									<div class='col-md-6'>
										Auction ID: {$aid}
									</div>
								</div>";
							echo"<div class='row'>";
								echo"
								<div class='col-md-4'>
									{$info['name']}<br>
									<a href='/sub/u/{$username}/s/{$sid}/'>
										<img src='{$thumb}' class='img-thumbnail img-responsive preview' data-image-url='{$thumb}' rel='popover' style='width:160px;height:160px;object-fit:none;object-position:center;'>
									</a>
								</div>";
								
								echo"
								<div class='col-md-4'>
									Bought by {$info['user']} for {$info['amount']} USD <br><br>
									<a href='/archiveAuction/u/{$username}/a/{$aid}/'><button class='btn btn-default'>Archive</button></a>
								</div>";

								echo"
								<div class='col-md-4'>
									<form action='/newMessage/u/{$u}/' method='post'>
										<div class='form-group'>
											<input type='hidden' name='u' value='{$u}' />
										</div>
										<div class='form-group'>
											<input type='hidden' name='group_name' value='Auction_ID_{$aid}_Slot_{$info['name']}'><br>
											<input type='hidden' name='receiver' value='{$info['user']}'><br>
											<textarea class='form-control' rows='4' name='message' id='message' maxlength='500' placeholder='Message...'></textarea>
										</div>
										<button type='submit' class='btn btn-default'>Send Message to Buyer</button>
									</form>
								</div>";

							echo"</div>";
							echo"<div class='row'>&nbsp;</div>";
						}
					?>
				</div>
			</div>			
		</div> <!-- col-md-8 -->


		<div class='col-md-4'>
			<div class="panel panel-default my-panel">
				<div class="panel-heading my-panel-heading">BLANK</div>
				<div class="panel-body">
					This space was intentionally left blank.
				</div>
			</div>
		</div> <!-- col-md-4 -->
	</div>

	<div class="row ">
		<div class="col-md-8">
			<div class="panel panel-default my-panel">
				<div class="panel-heading my-panel-heading">TRANSACTIONS - BOUGHT</div>
				<div class="panel-body" stlye='max-height:600px; overflow:auto; overflow-x:hidden;'>
					
					<?
						if(sizeOf($transB) == 0){
							echo"<div class='row'>&nbsp; You haven't bought anything on auctions yet.</div>";
						}
						foreach ($transB as $aid => $info) {
							$thumb = "/".$info['thumb'];
							$userName = $info['user'];
							$sid = $info['sid'];
							echo"<div class='row'>
									<div class='col-md-6'>
										Auction ID: {$aid}
									</div>
								</div>";
							echo"<div class='row'>";
								echo"
								<div class='col-md-4'>
									{$info['name']}<br>
									<a href='/sub/u/{$userName}/s/{$sid}/'>
										<img src='{$thumb}' class='img-thumbnail img-responsive preview' data-image-url='{$thumb}' rel='popover' style='width:160px;height:160px;object-fit:none;object-position:center;'>
									</a>
								</div>";
								
								echo"
								<div class='col-md-4'>
									Bought from {$info['user']} for {$info['amount']} USD
								</div>";

								echo"
								<div class='col-md-4'>
									<form action='/newMessage/u/{$u}/' method='post'>
										<div class='form-group'>
											<input type='hidden' name='u' value='{$u}' />
										</div>
										<div class='form-group'>
											<input type='hidden' name='group_name' value='Auction_ID_{$aid}_Slot_{$info['name']}'><br>
											<input type='hidden' name='receiver' value='{$info['user']}'><br>
											<textarea class='form-control' rows='4' name='message' id='message' maxlength='500' placeholder='Message...'></textarea>
										</div>
										<button type='submit' class='btn btn-default'>Contact seller</button>
									</form>
								</div>";

							echo"</div>";
							echo"<div class='row'>&nbsp;</div>";
						}
					?>
				</div>
			</div>			
		</div> <!-- col-md-8 -->
	</div>	
</div>		
[include]app/views/footer.view.php[/include]				