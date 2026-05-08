<?php include 'header.php'; ?>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css">
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<div class="col-lg-12">
	<div class="white_card card_height_100 mb_30">
		<div class="white_card_header">
			<div class="box_header m-0">
				<div class="main-title">
					<h3 class="m-0">My Members</h3>
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
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($con, "SELECT * FROM members_tbl WHERE account_status = '0'");
						while ($row = mysqli_fetch_assoc($query)) {
							$rC = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM course_tbl WHERE course_id = '{$row['course_id']}'"));
							$rS = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM section_tbl WHERE section_id = '{$row['section_id']}'"));
							$rG = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM groups_tbl WHERE group_id = '{$row['group_id']}'"));
							?>
							<tr>
								<td><?php echo $row['fname']; ?></td>
								<td><?php echo $row['mname']; ?></td>
								<td><?php echo $row['lname']; ?></td>
								<td><?php echo $rC['course_name'].' '.$rS['section_name']; ?></td>
								<td><?php echo $rG['group_name']; ?></td>
								<td>
									<?php
									if ($row['group_role'] == '1') {
										echo "Leader";
									}elseif ($row['group_role'] == '2') {
										echo "Member";
									}
									?>
								</td>
								<td><a href="#">Approve</a> | <a href="#">Disapprove</a></td>
							</tr>
							<?php
						}
						?>
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