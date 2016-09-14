[include]app/views/header.view.php[/include]

<!-- body -->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
		<div class="panel panel-default my-panel">
			<div class="panel-heading my-panel-heading">New Journal</div>
			<div class="panel-body">
				<form action='/newJournal/u/{{user}}/' method='post'>
					<input type='text' name='title' placeholder="Title" class="form-control">
					<br>
					<textarea class="form-control" rows="20" name="journal" id="journal" maxlength="50000" placeholder="Your journal..."></textarea>
					<br>
					<input type='submit' value='Submit' name='submit' class="btn btn-default">
				</form>
			</div>
		</div>
	</div>
</div>

<div><!-- body container-fluid -->

[include]app/views/footer.view.php[/include]