<?php
include '../include/db.php';
if (isset($_REQUEST['btnRegStud'])) {

	$fname = mysqli_escape_string($con, $_REQUEST['fname']);
	$mname = mysqli_escape_string($con, $_REQUEST['mname']);
	$lname = mysqli_escape_string($con, $_REQUEST['lname']);
	$course_id = mysqli_escape_string($con, $_REQUEST['course_id']);
	$section_id = mysqli_escape_string($con, $_REQUEST['section_id']);
	$email = mysqli_escape_string($con, $_REQUEST['email']);
	$contact_number = mysqli_escape_string($con, $_REQUEST['contact_number']);
	$username = mysqli_escape_string($con, $_REQUEST['username']);
	$password = mysqli_escape_string($con, $_REQUEST['password']);
	$confirm_password = mysqli_escape_string($con, $_REQUEST['confirm_password']);
	$group_id = $_REQUEST['group_id'];
	$group_role = $_REQUEST['group_role'];
	$date_now = date('Y-m-d');

	$year_level = $_REQUEST['year_level'];
	$school_year = $_REQUEST['school_year'];

	if ($password == $confirm_password) {
		
		if ($fname != '' &&  $mname != '' &&  $lname != '' &&  $course_id != '' &&  $section_id != '' &&  $email != '' &&  $contact_number != '' &&  $username != '' &&  $password != '' &&  $confirm_password != '' && $year_level != '' && $school_year != '') {
		
			$resExEmail = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM members_tbl WHERE email = '$email'"));

			if ($resExEmail['email'] != $email) {
				
				$resCont = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM members_tbl WHERE contact_number = '$contact_number'"));

				if ($resCont['contact_number'] != $contact_number) {
					
					$resUname = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM members_tbl WHERE username = '$username'"));

					if ($resUname['username'] != $username) {

						if ($group_role == '1') {
							$resRole = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM members_tbl WHERE group_id = '$group_id' AND group_role = '$group_role' AND school_batch = '$school_year'"));

							if ($resRole['group_role'] != $group_role && $resRole['school_batch'] != $school_year && $resRole['group_id'] != $group_id) {

								$url = "http://localhost/archive_system/profile_images/empty.jpg";


								$query = mysqli_query($con, "INSERT INTO members_tbl (fname, mname, lname, course_id, section_id, email, contact_number, username, password, group_id, group_role, school_batch, account_created, account_status, profile_image, year_level) VALUES ('$fname', '$mname', '$lname', '$course_id', '$section_id', '$email', '$contact_number', '$username', '$password', '$group_id', '$group_role', '$school_year', '$date_now', '0', '$url', '$year_level')");

								if ($query) {

									$resMem = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM members_tbl WHERE username = '$username'"));

									//Edit lang ni galing
									
									if ($resMem['group_role'] == '1') {
										$querySelected = mysqli_query($con, "INSERT INTO selected_group_tbl (group_id, member_id, teacher_id, batch_year) VALUES ('$group_id', '{$resMem['member_id']}', '0', '$school_year')");

										if ($querySelected) {
											?>
											<div class="alert alert-success background-success">
												<strong>Success: </strong> Your account will be verified by admin. <u><a href="login_view.php">Back</a></u>
											</div>
											<?php
										}

									}else{
										?>
										<div class="alert alert-success background-success">
											<strong>Success: </strong> Your account will be verified by admin. <u><a href="login_view.php">Back</a></u>
										</div>
										<?php
									}

								}
							
								
							}else{
								?>
								<div class="alert alert-warning background-warning">
									<strong>Warning: </strong> Role Already Exists.
								</div>
								<?php
							}

						}else{


							$url = "http://localhost/archive_system/profile_images/empty.jpg";


								$query = mysqli_query($con, "INSERT INTO members_tbl (fname, mname, lname, course_id, section_id, email, contact_number, username, password, group_id, group_role, school_batch, account_created, account_status, profile_image, year_level) VALUES ('$fname', '$mname', '$lname', '$course_id', '$section_id', '$email', '$contact_number', '$username', '$password', '$group_id', '$group_role', '$school_year', '$date_now', '0', '$url', '$year_level')");

								if ($query) {

									$resMem = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM members_tbl WHERE username = '$username'"));

									//Edit lang ni galing
									
									if ($resMem['group_role'] == '1') {
										$querySelected = mysqli_query($con, "INSERT INTO selected_group_tbl (group_id, member_id, teacher_id, batch_year) VALUES ('$group_id', '{$resMem['member_id']}', '0', '$school_year')");

										if ($querySelected) {
											?>
											<div class="alert alert-success background-success">
												<strong>Success: </strong> Your account will be verified by admin. <u><a href="login_view.php">Back</a></u>
											</div>
											<?php
										}

									}else{
										?>
										<div class="alert alert-success background-success">
											<strong>Success: </strong> Your account will be verified by admin. <u><a href="login_view.php">Back</a></u>
										</div>
										<?php
									}

								}


						}

					}else{
						?>
						<div class="alert alert-warning background-warning">
							<strong>Warning: </strong> Username Already Exists.
						</div>
						<?php
					}

				}else{
					?>
					<div class="alert alert-warning background-warning">
						<strong>Warning: </strong> Contact Number Already Exists.
					</div>
					<?php
				}

			}else{
				?>
				<div class="alert alert-warning background-warning">
					<strong>Warning: </strong> Email Already Exists.
				</div>
				<?php
			}

		}else{
			?>
			<div class="alert alert-warning background-warning">
				<strong>Warning: </strong> Please Fill in empty fields.
			</div>
			<?php
		}

	}else{
		?>
		<div class="alert alert-warning background-warning">
			<strong>Warning: </strong> Password don't match.
		</div>
		<?php
	}

}elseif (isset($_REQUEST['btnRegFac'])) {
	$fname = mysqli_escape_string($con, $_REQUEST['fname']);
	$mname = mysqli_escape_string($con, $_REQUEST['mname']);
	$lname = mysqli_escape_string($con, $_REQUEST['lname']);
	$school_id = mysqli_escape_string($con, $_REQUEST['school_id']);
	$department_id = mysqli_escape_string($con, $_REQUEST['department_id']);
	$email = mysqli_escape_string($con, $_REQUEST['email']);
	$contact_number = mysqli_escape_string($con, $_REQUEST['contact_number']);
	$username = mysqli_escape_string($con, $_REQUEST['username']);
	$password = mysqli_escape_string($con, $_REQUEST['password']);
	$confirm_password = mysqli_escape_string($con, $_REQUEST['confirm_password']);
	$date_now = date('Y-m-d');

	if ($password == $confirm_password) {
		
		if ($fname != '' &&  $mname != '' &&  $lname != '' &&  $school_id != '' &&  $department_id != '' &&  $email != '' &&  $contact_number != '' &&  $username != '' &&  $password != '' &&  $confirm_password != '') {
		
			$resExEmail = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM teachers_tbl WHERE email = '$email'"));

			if ($resExEmail['email'] != $email) {
				
				$resCont = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM teachers_tbl WHERE contact_number = '$contact_number'"));

				if ($resCont['contact_number'] != $contact_number) {
					
					$resUname = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM teachers_tbl WHERE username = '$username'"));

					if ($resUname['username'] != $username) {

						$url = "http://localhost/archive_system/profile_images/empty.jpg";


						$query = mysqli_query($con, "INSERT INTO teachers_tbl (fname, mname, lname, school_id, department_id, email, contact_number, username, password, account_created, account_status, profile_image) VALUES ('$fname', '$mname', '$lname', '$school_id', '$department_id', '$email', '$contact_number', '$username', '$password', '$date_now', '0', '$url')");

						if ($query) {

							?>
							<div class="alert alert-success background-success">
								<strong>Success: </strong> Your account will be verified by admin. <u><a href="login_view.php">Back</a></u>
							</div>
							<?php

						}

					}else{
						?>
						<div class="alert alert-warning background-warning">
							<strong>Warning: </strong> Username Already Exists.
						</div>
						<?php
					}

				}else{
					?>
					<div class="alert alert-warning background-warning">
						<strong>Warning: </strong> Contact Number Already Exists.
					</div>
					<?php
				}

			}else{
				?>
				<div class="alert alert-warning background-warning">
					<strong>Warning: </strong> Email Already Exists.
				</div>
				<?php
			}

		}else{
			?>
			<div class="alert alert-warning background-warning">
				<strong>Warning: </strong> Please Fill in empty fields.
			</div>
			<?php
		}

	}else{
		?>
		<div class="alert alert-warning background-warning">
			<strong>Warning: </strong> Password don't match.
		</div>
		<?php
	}
}
?>