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
<!-- body -->
<div class="container-fluid">
	<div class='row'>
		<div class="col-md-8">
			<div class="panel panel-default my-panel">
				<div class="panel-heading my-panel-heading"><b>Search</b></div>
				<div class="panel-body" id="myGallery">
					<?
						if(sizeOf($subs) == 0){
							echo"<br><br><br>&nbsp; Search has not yielded any results.<br><br><br>";
						}
						foreach($subs as $sub){
							$title = $sub['title'];
							$sid = $sub['id'];
							echo"
							<a href='/sub/u/{$userName}/s/{$sid}/'>
							<img src='/{$sub['thumb_location']}' class='img-thumbnail img-responsive' alt='{$title}' title='{$title}'>
							</a>";
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>


[include]app/views/footer.view.php[/include]