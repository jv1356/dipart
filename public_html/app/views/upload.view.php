[include]app/views/header.view.php[/include]
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default my-panel">
				<div class="panel-heading my-panel-heading">Upload</div>
				<div class="panel-body">

					<div class="container-fluid">
						<form action="/upload/" method="post" enctype="multipart/form-data">
							<div class="row"><div class="col-md-4"></div><div class="col-md-4"><div class="form-group"><img id="image" style="max-width:200px; max-height:200px;"><br><br>  <input name="picture" class="form-control" id="picture" type="file">   
							<span id="fsize"></span> Max file size: 50MB</div>
							</div><div class="col-md-4"></div></div><!-- row -->

							<div class="row">
								<div class="col-md-4"></div>
								<div class="col-md-4">
									<div class="form-group">
							    		<input type="text" class="form-control" name="title" id="title" placeholder="Title" required>
									</div>
									<div class="form-group">
							    		<textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
									</div>
									<div class="form-group">
							    		<input type="text" class="form-control" name="tags" id="tags" placeholder="Tags (seperated with comma ',')">
									</div>

								</div>
								<div class="col-md-4"></div>
							</div>

							<div class="row">
								<div class="col-md-4"></div>
									<div class="col-md-2">
										<div class="form-group">
											<select name="type">
												<option value="" selected disabled>Type</option>
												<option value="Nature">Nature</option>
												<option value="Anthro">Anthro</option>
											</select>	
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<select name="category">
												<option value="" selected disabled>Category</option>
												<option value="Digital Art">Digital Art</option>
												<option value="Photography">Photography</option>
											</select>
										</div>
									</div>
								<div class="col-md-4"></div>			
							</div>

							<div class="row">
								<div class="col-md-4"></div>
									<div class="col-md-4">
										<div class="form-group">
											<input type='checkbox' name='nsfw' value='1' id="nfsw"/>
											<label for="nsfw"> &nbsp; NSFW</label>											
										</div>
									</div>
								<div class="col-md-4"></div>			
							</div>

							<div class="row">
								<div class="col-md-4"></div>
									<div class="col-md-4">
										<div class="form-group">
											<button type="submit" class="btn btn-default" id="submit">Upload Picture</button>
										</div>
									</div>
								<div class="col-md-4"></div>			
							</div>


							<div class="row">
								<div class="col-md-4"></div>
									<div class="col-md-4">
										<a data-toggle="collapse" href="#more" id='moreAuctionInfo'>More info (auction, commission,...)</a>
									</div>
								<div class="col-md-4"></div>			
							</div>


							<div class="row">
								<div class="col-md-4"></div>
									<div class="col-md-4">
										<div id="more" class="collapse">
											<div class="container-fluid">
												<br>
												<div class="row">
													<div class="form-group">
														<div class="container-fluid">
															<b>Auction type</b> <a href='#removeAuctionTypes' id='removeAuctionTypes'>Un-select</a><br><br>
															<input type='radio' name='auctionType' value='buy_now' id='buynowradio'/>
															<label> &nbsp; Buy Now</label>
															<br>
															<div class='row'>
																<div class='col-md-6'>
																	&nbsp; Quantity:
																</div>

																<div class='col-md-5'>
																	<input type='number' name='quantity' value='1' min='1' max='99' style='width:150px;'>
																</div>
															</div>

															<div class='row'>
		                                                        <div class='col-md-6'>
																	&nbsp; Price [USD]:
																</div>

																<div class='col-md-5'>
																	<input type='number' name='price' min='0.5' max='99' step='0.50' id='buynowprice' style='width:150px;'>
																</div>
															</div>
	                                                        <br>
															<br>
															<input type='radio' name='auctionType' value='auction' id='auctionradio'/>
															<label> &nbsp; Auction</label>
														</div>
													</div>
												</div>

												<!-- auction fields -->
												<div id="auctionInfo">
													<div class="row">
														<div class="form-group">
															<div class="container-fluid">
																<div class='row'>
																	<div class='col-md-6'>
																		&nbsp; <b>Slot 1</b>
																	</div>
																</div>
																<div class='row'>
																	<div class='col-md-6'>
																		&nbsp; Slot name:
																	</div>
																	<div class='col-md-5'>
																		<input type='text' name='slotName1' id='slotName1' onKeyUp='checkNames()' value="" style='width:150px;'><span id='checkSlot1'></span>
																	</div>
																</div>
																<div class='row'>
																	<div class='col-md-6'>
																		&nbsp; Start price [USD]:
																	</div>
																	<div class='col-md-5'>
																		<input type='number' name='startPrice1' min='0.5' max='10000' step='0.5' id='startPrice1' style='width:150px;'>
																	</div>
																</div>
																<div class='row'>
																	<div class='col-md-6'>
																		&nbsp; Minimum increment:
																	</div>
																	<div class='col-md-5'>
																		<input type='number' name='minimumIncrement1' min='0.5' max='100' step='0.5' style='width:150px;'>
																	</div>
																</div>
																<div class='row'>
																	<div class='col-md-6'>
																		&nbsp; Autobuy (0: not set):
																	</div>
																	<div class='col-md-5'>
																		<input type="number" name="autobuy1" min="0" max="10000" step="0.5" value="0" style='width:150px;'>
																	</div>
																</div>	
																<div class='row'>
																	<div class='col-md-6'>
																		&nbsp; Duration [days]:
																	</div>
																	<div class='col-md-5'>
																		<input type="number" name="duration1" min="1" max="30" step="1" value="7" style='width:150px;'>
																	</div>
																</div>																
															</div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class='col-md-6'>
														&nbsp; <a href='#addMoreFields' id='addMoreFields'>Add more fields</a>
													</div>
												</div>


												<!-- / auction fields -->


												<div class="row">
													<br>
													<div class="form-group">
														<button type="submit" class="btn btn-default" id="submit">Upload Picture</button>
													</div>	
												</div>

											</div>
										</div><!-- shown field after collapse clicked -->
									</div>
								<div class="col-md-4"></div>	
								<!-- place for something to fill out the blank -->		
							</div>						



						</form>
					</div><!-- container-fluid -->

				</div> <!-- panel-body -->
			</div> <!-- panel-default -->
		</div> <!-- col-md-8 -->

		<div class="col-md-4">
			<div class="panel panel-default my-panel">
				<div class="panel-heading my-panel-heading">Your latest submissions</div>
				<div class="panel-body" style="overflow:auto;" id="myGallery">
					<?
						foreach($latestSubmissions as $sub){
							$title = $sub['title'];
							$sid = $sub['id'];
							echo"
							<a href='/sub/u/{$userName}/s/{$sid}/'>
							<img src='/{$sub['thumb_location']}'  class='img-thumbnail' alt='{$title}' title='{$title}'>
							</a>";
						}
					?>
				</div>
			</div>
		</div>
	</div> <!-- row -->
</div><!-- container-fluid -->
[include]app/views/footer.view.php[/include]				