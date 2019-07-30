<?php
include  "connection.php";

if(isset($_GET["isbn"]))
{
    $id=$_GET["isbn"];
    mysqli_query($link,"delete from add_books where ISBN='$id'");
?>
<script type="text/javascript">
    window.location="display_books.php"
</script>
<?php
}
else
{
    ?>
    <script type="text/javascript">
        window.location="display_books.php"
    </script>
<?php
}
