<? if(!isset($_SESSION['loggedin'])){ ?>
[include]app/views/headerLogin.view.php[/include]
<? } else { ?>
[include]app/views/header.view.php[/include]
<? } ?>

<? /* page content */ ?>
<!-- body -->
<div class="container-fluid">
	<div class="col-md-8">
		<div class="panel panel-default my-panel">
			<div class="panel-heading my-panel-heading">INFORMATION</div>
			<div class="panel-body text-center">
				<div class="container-fluid">
					<div class="col-md-4"> &nbsp; </div>

					<div class="col-md-4 text-center">
						<div class="alert alert-info">
						  <strong>INFO!</strong><br> {{message}}
						</div>
						<br>
						<br>
						<input type="button" value="Back" onclick="window.history.back()" /> 
					</div>

					<div class="col-md-4"> &nbsp; </div>

				</div>
			</div>
		</div><!-- panel -->
	</div> <!-- col-md-8 -->

	<div class="col-md-4">
		<div class="panel panel-default my-panel">
			<div class="panel-heading my-panel-heading"> &nbsp; </div>
			<div class="panel-body text-center">
				<br>
				<br>
				<br>
			</div>
		</div>
	</div>
</div>

<div><!-- body container-fluid -->

[include]app/views/footer.view.php[/include]		