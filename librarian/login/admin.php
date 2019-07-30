<?php include("includes/header.php") ?>

	<?php include("includes/nav.php") ?>
	<div class="jumbotron">
		<h1 class="text-center">
			<?php
			if(logged_in()){
				echo "Logged in";

				redirect("../admin2.php");

}
			else{
				redirect("login.php");
			}
			?>
		</h1>
	</div>





<?php include("includes/footer.php") ?>
