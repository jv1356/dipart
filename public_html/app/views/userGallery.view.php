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
			<div class="panel panel-default my-panel">
				<div class="panel-heading my-panel-heading"><b>Gallery</b></div>
				<div class="panel-body text center" id="myGallery" style="margin: 0 auto; width:100%;">
						<?
							foreach($subs as $sub){
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
		</div><!-- col-md-8 -->

		<div class="col-md-4">
			<div class="container-fluid">
				<div class="row">
					<div class="panel panel-default my-panel">
						<div class="panel-heading my-panel-heading"><b>Most popular</b></div>
							<div class="panel-body text-center">
								<a href='/sub/u/{{userName}}/s/{{popular['id']}}/'>
								<img src='/{{popular['thumb_location']}}' class='img-thumbnail img-responsive' Style='width: 100%' alt='{{popular['title']}}' title='{{popular['title']}}'>
								</a><br>
									<b>{{popular['title']}}</b>
								<hr>
								<div class='pull-left'>
									{{popular['description']}}
								</div>
							</div>
					</div>
				</div>

			</div>
		</div> <!-- col-md-4 -->
	
	</div> <!-- row -->
</div><!-- body container-fluid -->

[include]app/views/footer.view.php[/include]