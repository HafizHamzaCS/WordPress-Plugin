<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<div class="container">
	<div class="row">
		<div class="col-md-9 pt-5">
			<form method="post">
				<div class="form-group" style="display: flex;align-items: center">
					<label style="float:left;">
						Invite Prescriber:
					</label>
					<input type="email" required="" placeholder="Invite Prescriber via Email" name="prescriber_data[partner_email]" class="form-control" id="partner_email">
					<button class="prescriber_button" type="submit" name="submit_email" id="submit_email">Submit</button>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<p><strong>Outgoing Invites</strong></p>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Email</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td>hafizhamza810@gmail.com</td>
					<td style="text-transform: capitalize">accepted</td>
				<form method="post"></form>
				<input type="hidden" name="hide_remove_id" value="">
				<td>
					<button type="submit" name="remove_partner" class="remove_partner" style="background: #1E446E; border-radius: 10px !important; padding:10px !important;color:#fff;">
					REMOVE
					</button>
				</td>
				
			</tr>
		</tbody>
	</table>
	</div>
	<div class="row">
		<p><strong>Incoming Invites</strong></p>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Email</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>
		</table>
	</div>
</div>