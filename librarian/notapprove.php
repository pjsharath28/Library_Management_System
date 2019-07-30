<?php
include "connection.php";
$id=$_GET["id"];
mysqli_query($link,"update users set librarian_approval='no' where id=$id");
?>

<script type="text/javascript">
    window.location="display_student_info.php";


</script>
