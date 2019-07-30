<a href="login/logout.php">Logout</a>

<?php session_start();?>


	<div class="jumbotron">
		<h1 class="text-center">
			<?php
			if(isset($_SESSION['email']) || isset($_COOKIE['email'])){
				echo $_SESSION['email'];
				echo " logged in";
				$_SESSION['librarian'] = $_SESSION['email'];
				return header("Location: display_student_info.php");
			}
			else{
				return header("Location: login/login.php");
			}

			?>
		</h1>
	</div>
