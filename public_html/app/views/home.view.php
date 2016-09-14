[include]app/views/header.view.php[/include]

<? /* page content */ ?>
<!-- body -->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default my-panel">
				<div class="panel-heading my-panel-heading"><b>Gallery</b></div>
				<div class="panel-body" id="myGallery" style="margin: 0 auto;">
					<?
						foreach($subs as $sub){
							$title = $sub['title'];
							$sid = $sub['sid'];
							$userName = $sub['name'];
							echo"
							<a href='/sub/u/{$userName}/s/{$sid}/'>
							<img src='/{$sub['thumb_location']}'  class='img-thumbnail' alt='{$title}' title='{$title}'>
							</a>";
						}
					?>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="panel panel-default my-panel">
				<div class="panel-heading my-panel-heading"><b> Most popular</b></div>
				<div class="panel-body text-center">
					<?
						$title = $pop['title'];
						$sid = $pop['sid'];
						$userName = $pop['name'];
						echo"
						<a href='/sub/u/{$userName}/s/{$sid}/'>
						<img src='/{$pop['thumb_location']}'  class='img-thumbnail' style='width: 100%' alt='{$title}' title='{$title}'>
						</a>";
						echo"<br>
							<b>{$pop['title']}</b>
						<hr>
						<div class='pull-left'>
							{$pop['sdesc']}
						</div>";
					?>
				</div>
			</div>
		</div>		
	</div>
</div><!-- body container-fluid -->

[include]app/views/footer.view.php[/include]		