<?php
include "connection.php";
$id=$_GET["id"];
$a=date("d/m/y");
$res=mysqli_query($link,"update issue_books set books_return_date='$a' where id=$id");
$book_title="";
$res=mysqli_query($link,"select * from issue_books where id=$id");
echo $id;
while($row=mysqli_fetch_array($res))
{
    $book_title=$row["books_name"];
}
mysqli_query($link,"update add_books set available_quantity=available_quantity+1 where book_title='$book_title'");
echo "return successful";
?>
<a href="return_book.php">go back</a>
<?php
?>

<script type="text/javascript">
    window.location="return_book.php";
</script>
