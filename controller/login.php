<?php
include '../include/db.php';
if (isset($_REQUEST['btnStudLogin'])) {
	
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];

	if ($username != '' && $password != '') {
		
		$resU = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM members_tbl WHERE username = '$username'"));
		$res = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM members_tbl WHERE username = '$username' AND password = '$password'"));

		if (!empty($resU['username'])) {
			
			if ($res['username'] == $username && $res['password'] == $password) {
			
				if ($res['account_status'] == '1') {
					session_start();
					$_SESSION['username'] = $res['username'];
					$_SESSION['uid'] = $res['member_id'];

					header('location: our_research_view.php');
				}else{
					?>
					<div class="alert alert-danger background-danger">
			          <strong>Access Denied:</strong> Account not Activated 
			        </div>
					<?php
				}

			}else{
				?>
				<div class="alert alert-danger background-danger">
		          <strong>Error:</strong> Username or Password is Incorrect 
		        </div>
				<?php
			}

		}else{
			?>
			<div class="alert alert-danger background-danger">
	          <strong>Error:</strong> No Account Found 
	        </div>
			<?php
		}

	}else{
		?>
		<div class="alert alert-warning background-warning">
          <strong>Warning:</strong> Please fill in empty fields 
        </div>
		<?php
	}

}elseif (isset($_REQUEST['btnFacLogin'])) {
	
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];

	if ($username != '' && $password != '') {
		
		$resU = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM teachers_tbl WHERE username = '$username'"));
		$res = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM teachers_tbl WHERE username = '$username' AND password = '$password'"));

		if (!empty($resU['username'])) {
			
			if ($res['username'] == $username && $res['password'] == $password) {
			
				if ($res['account_status'] == '1') {
					session_start();
					$_SESSION['username'] = $res['username'];
					$_SESSION['uid'] = $res['teacher_id'];

					header('location: index.php');
				}else{
					?>
					<div class="alert alert-danger background-danger">
			          <strong>Access Denied:</strong> Account not Activated 
			        </div>
					<?php
				}

			}else{
				?>
				<div class="alert alert-danger background-danger">
		          <strong>Error:</strong> Username or Password is Incorrect 
		        </div>
				<?php
			}

		}else{
			?>
			<div class="alert alert-danger background-danger">
	          <strong>Error:</strong> No Account Found 
	        </div>
			<?php
		}

	}else{
		?>
		<div class="alert alert-warning background-warning">
          <strong>Warning:</strong> Please fill in empty fields 
        </div>
		<?php
	}

}elseif (isset($_REQUEST['btnAdminLogin'])) {
	
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];

	if ($username != '' && $password != '') {
		
		$resU = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM admin_tbl WHERE username = '$username'"));
		$res = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM admin_tbl WHERE username = '$username' AND password = '$password'"));

		if (!empty($resU['username'])) {
			
			if ($res['username'] == $username && $res['password'] == $password) {
			
				
				session_start();
				$_SESSION['username'] = $res['username'];
				$_SESSION['uid'] = $res['admin_id'];

				header('location: ../admin');
				

			}else{
				?>
				<script type="text/javascript">
					alert('Username or Password is Incorrect');
					history.back();
				</script>
				<?php
			}

		}else{
			?>
			<script type="text/javascript">
				alert('No Account Found ');
				history.back();
			</script>
			<?php
		}

	}else{
		?>
		<script type="text/javascript">
				alert('Please fill in empty fields ');
				history.back();
			</script>
		<?php
	}

}
?>