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
include "header.php";
include "connection.php";
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
                            <h2>Issue Books</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <form name="form1" action="" method="post">
                                <table>
                                    <tr>
                                        <td>

                                            <select name ="enr"class="form-control selectpicker">
                                                <?php
                                                $res=mysqli_query($link,"select enroll_no from users");
                                                while ($row=mysqli_fetch_array($res))
                                                {
                                                    echo"<option>";
                                                    echo $row["enroll_no"];
                                                    echo"</option>";
                                                }

                                                ?>

                                            </select>
                                        </td>
                                        <td>

                                            <input type="submit" value="Search" name="submit1"
                                                   class="form-control btn btn-default"style="margin-top: 5px">
                                        </td>
                                    </tr>
                                </table>

                            <?php
                            if(isset($_POST["submit1"]))
                            {
                                $res5=mysqli_query($link,"select * from users where enroll_no='$_POST[enr]'");
                                while($row5=mysqli_fetch_array($res5))
                                {
                                    $firstname=$row5["first_name"];
                                    $lastname=$row5["last_name"];
                                    $username=$row5["username"];
                                    $enroll_no=$row5["enroll_no"];
                                    $_SESSION["enroll_no"]=$enroll_no;
                                    $_SESSION["susername"]=$username;
                                }
                                ?>
                                <table class="table table-bordered">
                                    <tr>
                                        <td>
                                            <input type="text"class="form-control" placeholder="enrollmentno"
                                                   name="enrollmentno"value="<?php echo $enroll_no;?>" disabled>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="text"class="form-control" placeholder="studentname" name="studentname"value="<?php echo $firstname.' '.$lastname;?>"required="">
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <select name="booksname" class="form-contol selectpicker">
                                                <?php
                                                $res=mysqli_query($link,"select book_title from add_books");
                                                while($row=mysqli_fetch_array($res))
                                                {
                                                    echo "<option>";

                                                    echo $row["book_title"];

                                                    echo"</option>";
                                                }
                                                ?>



                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="text"class="form-control" placeholder="booksissuedate" name="booksissuedate"value="<?php echo date("d/m/y");?>"required="">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="text"class="form-control" placeholder="studentusername" name="studentusername"value="<?php echo $username;?>"disabled>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="submit"value="Issue Book" name="submit2"class="form-control btn btn-default" style="background-color: blue;color:white">
                                        </td>
                                    </tr>

                                </table>

                                <?php

                                $sql = mysqli_query($link,"CALL`countIssuedBooks`('$_SESSION[susername]');");
                                $no = mysqli_num_rows($sql);
                                $_SESSION['quantity'] = $no;
                            }
                            ?>
                            </form>
                            <?php
                            if(isset($_POST["submit2"]))
                            {
                                $qty=0;
                                $res=mysqli_query($link,"select * from add_books where book_title='$_POST[booksname]'");
                                while($row=mysqli_fetch_array($res))
                                {
                                    $qty=$row["available_quantity"];
                                }

                                if($qty==0)
                                {
                                    ?>
                                    <div class="alert alert-danger col-lg-6 col-lg-push-3">
                                        <strong style="color:white">This book is not available in stock</strong>
                                    </div>
                                <?php
                                }
                                else
                                {

                            //      $sql = mysqli_query($link,"CALL`countIssuedBooks`('$_SESSION[susername]');");
                            //      $no = mysqli_num_rows($sql);
                                  $no1 = $_SESSION['quantity'];
                                  if($no1==2)
                                  {
                                    ?>
                                    <script type="text/javascript">
                                        alert("Maximun only 2 books can be issued");
                                        window.location.href=window.location.href;
                                    </script>
                                    <?php
                                  }
                                  else
                                  {
                                    mysqli_query($link,"insert into issue_books values('','$_SESSION[enroll_no]','$_POST[studentname]','$_POST[booksname]','$_POST[booksissuedate]','N','$_SESSION[susername]')");
                        //          mysqli_query($link,"update add_books set available_quantity=available_quantity-1 where book_title='$_POST[booksname]'");
                                    ?>
                                    <script type="text/javascript">
                                        alert("books issued successfully");
                                        window.location.href=window.location.href;
                                    </script>
                                    <?php                                  }

                                }


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
