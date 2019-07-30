<?php
session_start();
if(!isset($_SESSION["librarian"]))
{
    ?>
    <script type="text/javascript">

        window.location="login/login.php";

    </script>
    <?php
}
include "connection.php";
include "header.php";
?>

    <!-- page content area main -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3></h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="row" style="min-height:500px">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Display Books</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <form name="form1" action="" method="post">
                                <input type="text" name="t1" class="form-control" placeholder="Enter Book Name">
                                <input type="submit" name="submit1" value="Search Book" class="btn btn-default">

                            </form>

                            <?php

                            if(isset($_POST["submit1"]))
                            {
                                $res = mysqli_query($link, "select * from add_books where book_title like('$_POST[t1]%')");
                                echo "<table class='table table-bordered'>";
                                echo "<tr>";
                                echo "<th>";
                                echo "Book's ISBN";
                                echo "</th>";
                                echo "<th>";
                                echo "Book's Image";
                                echo "</th>";
                                echo "<th>";
                                echo "Book's Name";
                                echo "</th>";

                                echo "<th>";
                                echo "Book's Author Name";
                                echo "</th>";
                                echo "<th>";
                                echo "Book's Publication Name";
                                echo "</th>";
                                echo "<th>";
                                echo "Book's Purchase Date";
                                echo "</th>";
                                echo "<th>";
                                echo "Book's Price";
                                echo "</th>";
                                echo "<th>";
                                echo "Book's Total Quantity";
                                echo "</th>";
                                echo "<th>";
                                echo "Book's Available Quantity";
                                echo "</th>";

                                echo "<th>";
                                echo "Delete Book";
                                echo "</th>";

                                echo "</tr>";
                                while ($row = mysqli_fetch_array($res)) {

                                  echo "<tr>";

                                  echo "<td>";
                                  echo $row["ISBN"];
                                  echo "</td>";
                                    echo "<td>"; ?><img src="<?php echo $row["book_image"]; ?>" height="50"
                                                        width="50"><?php
                                    echo "<td>";
                                    echo $row["book_title"];
                                    echo "</td>";

                                    echo "<td>";
                                    echo $row["book_author_name"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["book_publication_name"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["book_purchase_date"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["book_price"];
                                    echo "</td>";

                                    echo "<td>";
                                    echo $row["book_quantity"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["available_quantity"];
                                    echo "</td>";

                                    echo "<td>";
                                    ?> <a href="delete_books.php?isbn=<?php echo $row["ISBN"];?>">Delete Books</a> <?php
                                    echo "</td>";

                                    echo "</tr>";
                                }
                                echo "</table>";
                            }
                            else {


                                $res = mysqli_query($link, "select * from add_books");

                                echo "<table class='table table-bordered'>";
                                echo "<tr>";
                                echo "<th>";
                                echo "Book's ISBN";
                                echo "</th>";
                                echo "<th>";
                                echo "Book's Image";
                                echo "</th>";
                                echo "<th>";
                                echo "Book's Name";
                                echo "</th>";

                                echo "<th>";
                                echo "Book's Author Name";
                                echo "</th>";
                                echo "<th>";
                                echo "Book's Publication Name";
                                echo "</th>";
                                echo "<th>";
                                echo "Book's Purchase Date";
                                echo "</th>";
                                echo "<th>";
                                echo "Book's Price";
                                echo "</th>";
                                echo "<th>";
                                echo "Book's Total Quantity";
                                echo "</th>";
                                echo "<th>";
                                echo "Book's Available Quantity";
                                echo "</th>";

                                echo "<th>";
                                echo "Delete Book";
                                echo "</th>";

                                echo "</tr>";
                                while ($row = mysqli_fetch_array($res)) {
                                  echo "<tr>";

                                  echo "<td>";
                                  echo $row["ISBN"];
                                  echo "</td>";
                                    echo "<td>"; ?><img src="<?php echo $row["book_image"]; ?>" height="50"
                                                        width="50"><?php
                                    echo "<td>";
                                    echo $row["book_title"];
                                    echo "</td>";

                                    echo "<td>";
                                    echo $row["book_author_name"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["book_publication_name"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["book_purchase_date"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["book_price"];
                                    echo "</td>";

                                    echo "<td>";
                                    echo $row["book_quantity"];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row["available_quantity"];
                                    echo "</td>";

                                    echo "<td>";
                                    ?> <a href="delete_books.php?isbn=<?php echo $row["ISBN"];?>">Delete Books</a> <?php
                                    echo "</td>";

                                    echo "</tr>";
                                }
                                echo "</table>";
                            }
                            ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->


<?php
include "footer.php";
?>
