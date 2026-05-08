<?php include 'header.php'; ?>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css">
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<div class="col-lg-12">
	<div class="white_card card_height_100 mb_30">
		<div class="white_card_header">
			<div class="box_header m-0">
				<div class="main-title">
					<h3 class="m-0">Basic Table</h3>
				</div>
			</div>
		</div>
		<div class="white_card_body">
			<!-- <h6 class="card-subtitle mb_20">Just add the base class <code>.table</code> and <code>&lt;table&gt;</code>.</h6> -->
			<div class="table-responsive">
				<table class="table" id="myTable">
					<thead>
						<tr>
							<th>First Name</th>
							<th>Middle Name</th>
							<th>Last Name</th>
							<th>Course & Section</th>
							<th>Group</th>
							<th>Role</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>ASD</td>
							<td>ASD</td>
							<td>ASD</td>
							<td>ASD</td>
							<td>ASD</td>
							<td>ASD</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready( function () {
		$('#myTable').DataTable();
	});
</script>
<?php include 'footer.php'; ?>