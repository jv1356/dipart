[include]app/views/header.view.php[/include]
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default my-panel">
				<!-- <div class="panel-heading my-panel-heading">Compose Message</div> -->
				<div class="panel-body removeShadow">
					<form action="/newMessage/" class="" method="post">
						<div class="form-group">
							<input type='hidden' name='u' value='{{u}}' />
						</div>
						<div class="form-group">
							<input type='text' name='group_name' placeholder='Chat Name' class="form-control"><br>
							<input type='text' name='receiver' placeholder='Receiver' class="form-control"><br>
							<textarea class="form-control" rows="4" name="message" id="message" maxlength="500" placeholder="Message..."></textarea>
						</div>
						<button type="submit" class="btn btn-default">Compose Message</button>
					</form>
				</div>
			</div>			
		</div> <!-- col-md-8 -->
	</div>
</div>		
[include]app/views/footer.view.php[/include]				