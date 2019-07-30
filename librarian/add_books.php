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
    <div class="right_col" role="main" xmlns="http://www.w3.org/1999/html">
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
                            <h2>Add Book Information</h2>


                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <form name="form1" action="" method="post" class="col-lg-6" enctype="multipart/form-data">
                                <table class="table table-bordered">
                                    <tr>
                                         <td>
                                             <input type="text"class="form-control" placeholder="Book's Name" name="booksname" required="" >
                                         </td>
                                    </tr>

                                    <tr>
                                         <td>
                                             <input type="text"class="form-control" placeholder="Book's ISBN" name="isbn" required="" >
                                         </td>
                                    </tr>
                                    <!--<div class="clearfix"></div>-->
                                    <tr>
                                        <td>
                                            Book's Image
                                            <input type="file" name="f1" required="" >
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>

                                            <input type="text"class="form-control" placeholder="Book's Author Name" name="bauthorname" required="" >
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>

                                            <input type="text"class="form-control" placeholder="Book's Publication Name" name="pname" required="" >
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>

                                            <input type="text"class="form-control" placeholder="Book's Purchase Date" name="bpurchasedt" required="" >
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>

                                            <input type="text"class="form-control" placeholder="Book's Price" name="bprice" required="" >
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>

                                            <input type="text"class="form-control" placeholder="Book's Total Quantity" name="bqty" required="" >
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>

                                            <input type="text"class="form-control" placeholder="Book's Available Quantity" name="aqty" required="" >
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>

                                            <input type="submit" name="submit1" class="btn btn-default submit" value="Insert Book's Details" style="background-color:blue; color :white">
                                        </td>
                                    </tr>

                                </table>
                             </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
<?php
if(isset($_POST["submit1"]))
{
    $tm=md5(time());
    $fnm=$_FILES["f1"]["name"];
    $dst="./books_image/".$tm.$fnm;
    $dst1="./books_image/".$tm.$fnm;

    move_uploaded_file($_FILES["f1"]["tmp_name"],$dst);

    $lib_usernm_sql = mysqli_query($link,"select * from librarians where email='$_SESSION[librarian]'order by id desc");
    $pr = mysqli_fetch_array($lib_usernm_sql);
    $lib_usernm = $pr["username"];

    mysqli_query($link,"insert into add_books values('$_POST[isbn]','$_POST[booksname]','$dst1','$_POST[bauthorname]','$_POST[pname]','$_POST[bpurchasedt]','$_POST[bprice]','$_POST[bqty]','$_POST[aqty]','$lib_usernm')");

    ?>
    <script type="text/javascript">
        alert("Book Inserted Successfully");

    </script>
    <?php

}
?>

<?php
include "footer.php";
?>
