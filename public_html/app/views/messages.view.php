[include]app/views/header.view.php[/include]
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default my-panel">
				<div class="panel-heading my-panel-heading">MESSAGES</div>
				<div class="panel-body">

				</div>
			</div>			
		</div> <!-- col-md-8 -->


		<div class='col-md-4'>
			<div class="panel panel-default">
				<div class="panel-heading">CONVERSATIONS &nbsp; <a href='/newMessage/u/{{username}}/'><span class='label label-default'>Compose new</span></a></div>
				<div class="panel-body">
					<div class='row'>
						<div class='col-md-4'>
							<b>NAME</b>
						</div>
						<div class='col-md-4'>
							<b>DATE</b>
						</div>
						<div class='col-md-2'>
							&nbsp;
						</div>
					</div>
					<?
						foreach ($msgs as $msg) {
							$gname = $msg["group_name"];
							if($msg['unread'] == 1){
								$gname = "<b>{$gname}</b>";
							}
							echo"
								<div class='row'>
									<div class='col-md-4'>
										{$gname}
									</div>
									<div class='col-md-4'>
										{$msg['created']}
									</div>
									<div class='col-md-1'>
										<a href='/conversation/u/{$username}/c/{$msg['Conversations_id']}/'>Open</a>
									</div>
									<div class='col-md-1'>
										<a href='/messageHistory/u/{$username}/c/{$msg['Conversations_id']}/'>History</a>
									</div>
								</div>
							";
						}

					?>
				</div>
			</div>
		</div> <!-- col-md-4 -->
	</div>
</div>		
[include]app/views/footer.view.php[/include]				