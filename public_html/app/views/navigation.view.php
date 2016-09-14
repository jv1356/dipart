<?
if(!isset($_GET['u']))
{
	$userName = getUsername();
}
else{
	$userName = $_GET['u'];
}
?>

<!-- mainGallery -->
				<div class="container-fluid">
					<div class="row">
						<nav class="navbar navbar-default my-nav">
						  <div class="container-fluid">
							<ul class="nav navbar-nav">
							<!--  class="active" -->
							  <li>
							  	<? echo"<a href='/profile/u/{$userName}/' class='forceLightWhiteFont'><b>{$userName}</b></a>"; ?>
							  </li>
							  <li <? if($_GET['page'] == "userGallery"){echo" class='active'";} ?>>
							  	<? echo"<a href='/userGallery/u/{$userName}/' class='forceLightWhiteFont'>Gallery</a>"; ?>
							  </li>
							  <li <? if($_GET['page'] == "commissions"){echo" class='active'";} ?> >
							  	<? echo"<a href='/commissions/u/{$userName}/' class='forceLightWhiteFont'>Commissions</a>"; ?>
							  </li> 
							  <li <? if($_GET['page'] == "journals"){echo" class='active'";} ?> >
							  	<? echo"<a href='/journals/u/{$userName}/' class='forceLightWhiteFont'>Journals</a>"; ?>
							  </li> 
							  <li <? if($_GET['page'] == "feedback"){echo" class='active'";} ?> >
							  	<? echo"<a href='/feedback/u/{$userName}/' class='forceLightWhiteFont'>Feedback</a>"; ?>
							  </li> 
							  <li role="presentation" class="dropdown">
							  	<a class="dropdown-toggle forceLightWhiteFont" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
							  	Streaming <span class="caret"></span>
							    </a>
							    <ul class="dropdown-menu">
							    <div class="input-group">
							      <li>
								  <input type="text" class="form-control" aria-label="...">
								  <div class="input-group-btn">
								    <!-- Buttons -->
								  </div>
								</li>
								</div>
           						      <li><a href="#">Another action</a></li>
							    </ul>
							  </li>
							  <li>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</li>
							</ul>
					  		<!-- search -->
						 	<form action=<? echo"'/search/u/{$userName}/'"; ?> class="form-inline" method="post" style='padding-top:0.5%;'>
								<div class="form-group pull-right">
									<input type='hidden' name='searchUserGallery' value=<? echo"'{$userName}'"; ?>/>
									<input type="text" class="form-control" name="search" id="search" placeholder="Search user's gallery">
									<button type="submit" class="btn btn-default">Search</button>
								</div>
						 	</form>							
						  </div>
						</nav>
					</div> <!-- row -->
				</div><!-- mainGallery -->