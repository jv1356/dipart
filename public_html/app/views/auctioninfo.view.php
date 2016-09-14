		<div class="col-md-8 pull-left">
			<div class="container-fluid">
				<div class="row">
					<div class="panel panel-default my-panel">
						<div class="panel-heading my-panel-heading">
							<b>Auctions</b>
						</div>
						<div class="panel-body">
							<div class="container-fluid">
							<?
								if(sizeOf($auctions) == 0 && is_null($auctions[0]['name'])){
									echo"No auction info!";
								} else { 
									foreach ($auctions as $a) {
										$stillOpen = false;
										$stillOpen = time() < $a['end_date'] && $a['open'] == 1;
										echo"
										<div class='col-md-6 clearfix pull-left'>
										<br>
										<div class='container-fluid'>
											<div class='row'>
												<div class='col-md-5 text-right'>
													Name:
												</div>
												<div class='col-md-6 text-left'>
													<i>{$a['name']}</i>
												</div>

												<div class='col-md-5 text-right'>
													Quantity:
												</div>
												<div class='col-md-6 text-left'>
													<i>{$a['quantity']}</i>
												</div>

												<div class='col-md-5 text-right'>
													Price:
												</div>
												<div class='col-md-6 text-left'>
													<i>{$a['price']} USD</i>
												</div>

												<div class='col-md-5 text-right'>
													Min. increment:
												</div>
												<div class='col-md-6 text-left'>
													<i>{$a['increase']}</i>
												</div>

												<div class='col-md-5 text-right'>
													Autobuy:
												</div>
												<div class='col-md-6 text-left'>
													<i>";

													if($a["autobuy"] > 0){
														echo"{$a['autobuy']} USD";
													} else {
														echo'Not available';
													}

												echo"</i>
												</div>";

												echo"
												<div class='col-md-5 text-right'>
													End:
												</div>
												<div class='col-md-6 text-left'>";
													if($stillOpen){
														$a['aend'] = Time::secondsToTimeString($a['end_date']-time());
														echo"<i>{$a['aend']} left</i>";
													}else{
														echo"-";
													}
												echo"</div>";


												if($stillOpen){
													$aid = $a['auction_id'];
													$minBid = $currBids[$aid]+$a['increase'];
													echo"
													<div class='col-md-5 text-right'>
														Your bid:
													</div>
													<div class='col-md-6 text-left'>
														<form action='/bidSub/u/{$u}/' method='post' class='form-inline'>
															<input type='hidden' name='auctionID' value='{$aid}'>
															<input type='number' name='yourBid' value='{$minBid}' min='{$minBid}' max='100000'>
															&nbsp;
															<input type='submit' name='submit' value='Bid'>
														</form>
													</div>";													
												}else{
													echo"
													<div class='col-md-5 text-right'>
														Time's up.
													</div>
													<div class='col-md-6 text-left'>
														<i>Auction is closed.</i>
													</div>";													
												}

												echo"
											</div>

										</div>
										<br>
										</div>
										";
									}
								}
							?>
						</div><!-- panel body -->
					</div><!-- panel panel-default -->
				</div>
			</div>
		</div>	
	</div>
