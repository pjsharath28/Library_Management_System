

<?php

/*
session_start();
unset($_SESSION["librarian"]);
?>
<script type="text/javascript">

    window.location="login.php";

</script>

*\


<?php
*/
    include("login/functions/init.php");

    session_destroy();

    if(isset($_COOKIE['email'])){
        unset($_COOKIE['email']);
        setcookie('email', '', time() - 1200);
    }

    redirect("login/login.php");
?>
