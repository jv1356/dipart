[include]app/views/header.view.php[/include]
<?
/* info for header */
if(!isset($_GET['u']))
{
	$userName = getUsername();
}
else{
	$userName = $_GET['u'];
}
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading my-panel-heading"><b>Commissions</b></div>
					<div class="panel-body my-panel">
						<div class="container-fluid">
							<?
							if(sizeof($coms) == 0){
								echo"<br><br>This user has no commissions!<br><br><br>";
							}
								foreach($coms as $sid => $auctions){
									$title = $titles[$sid];
									$thumb = $thumbs[$sid];
									$desc = $descs[$sid];
									echo"<div class='row'>";
										echo"
											<div class='col-md-3'>
												<a href='/sub/u/{$userName}/s/{$sid}/'>
												<img src='{$thumb}' class='thumbnail img-responsive preview' data-image-url='{$thumb}' rel='popover';object-fit:none;object-position:center;'>
												</a>
											</div>

											<div class='col-md-9'>
												<div class='container-fluid'>
													<div class='row'>
														<div class='col-md-5'>
															<h5>{$title}</h5>
															<i>{$desc}</i>
														</div>

														<div class='col-md-7'>
															<div style='overflow: auto; max-height:250px; overflow-x: hidden;'>";
																foreach ($auctions as $a) {
																	$tleft = Time::secondsToTimeString($a['aend']-time());
																	echo"
																		<div class='row'>
																			<div class='col-md-5'>
																				<b>{$a['aname']}</b>
																			</div>
																			<div class='col-md-6'>
																				<i>{$tleft} left</i>
																			</div>
																			<div class='col-md-5'>
																				Price
																			</div>
																			<div class='col-md-6'>
																				{$a['abuy']}
																			</div>
																			<div class='col-md-5'>
																				Quantity:
																			</div>
																			<div class='col-md-6'>
																				{$a['aqty']}
																			</div>
																			<div class='col-md-5'>
																				Buy now:
																			</div>
																			<div class='col-md-6'>
																				<a href='/buynow/u/{$u}/a/{$a['aid']}/'><button class='btn btn-default'>Buy Now</button></a>
																			</div>
																		</div>
																		<div class='row'>&nbsp;</div>
																	";
																}
															echo"</div>
														</div><!-- col-md-7-->
													</div><!-- row -->
												</div>
											</div><!-- col-md-10 -->
										";
										
									echo" </div><!-- row --> <div class='row'> <hr></div>";
								}
							?>
						</div><!-- container-fluid -->
					</div><!-- panel body -->
			</div><!-- panel panel-default -->
		</div> <!-- col-md-8 -->

		<div class="col-md-4">
			<div class="panel panel-default my-panel">
				<div class="panel-heading my-panel-heading"><b>User TOS</b></div>
				<div class="panel-body" style='line-height:1;'>
					<p>My personal Terms of service&nbsp;</p>
					<p>&nbsp;</p>
					<p>If you commission me you must first agree to my TOS!</p>
					<p>The buyer of must always pay everything upfront!&nbsp;</p>
					<p>I do accept credit cards, bank transfer, Western Union and Paypal.&nbsp;</p>
					<p>After the payment is made I will only refund 50% of the ammount,</p>
					<p>but only before I start working on your commission,&nbsp;</p>
					<p>so be sure that you really want to commission me!</p>
					<p>After I start working on your commiission I won't give refunds!&nbsp;</p>
					<p>Do not delete your bid! Bidders who will delete their bid&nbsp;</p>
					<p>will get a negative feedback!</p>
					<p>&nbsp;</p>
					<p>I will draw:&nbsp;</p>
					<ul>
					<li>dragons</li>
					<li>minotaurs&nbsp;</li>
					<li>egyptian art</li>
					<li>pony fan art</li>
					<li>mysticaal creatures</li>
					<li>centaurs</li>
					<li>animals</li>
					</ul>
					<p>I won't draw:&nbsp;</p>
					<ul>
					<li>humans&nbsp;</li>
					<li>copyrighted material&nbsp;</li>
					<li>nudity&nbsp;</li>
					</ul>
					<p>&nbsp;</p>
					<p>I also make sculpture commissions.&nbsp;</p>
					<p>The shipping prices depend on your country,&nbsp;</p>
					<p>so ask before commissioning!&nbsp;</p>
					<p>&nbsp;</p>
					<p>I am open for commissions there are open commissions</p>
					<p>in my commission tab.&nbsp;</p>
					<p>Please DO NOT message me about commissions</p>
					<p>when there are no active commissions in my commission tab!!!&nbsp;</p>
					<p>&nbsp;</p>
				</div>
			</div>
		</div>
	</div> <!-- row -->
</div><!-- container-fluid -->

[include]app/views/footer.view.php[/include]