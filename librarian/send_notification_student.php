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
                            <h2>Message to Student</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <form name="form1" action="" method="post" class="col-lg-6" enctype="multipart/form-data">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>

                                            <select class="form-control" name="dusername">
                                                <?php
                                                $res=mysqli_query($link,"select * from users");
                                                while ($row=mysqli_fetch_array($res))
                                                {
                                                    ?><option value="<?php echo $row["username"]?>">
                                                    <?php echo $row["username"]."(". $row["enroll_no"].")"; ?>
                                                </option><?php
                                                }
                                                ?>

                                            </select>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td><input type="text" class="form-control" name="title" placeholder="Enter Title"> </td>

                                    </tr>

                                    <tr>
                                        <td>
                                            Message <br>
                                            <textarea name="msg" class="form-control">

                                            </textarea>
                                        </td>

                                    </tr>

                                    <tr>

                                        <td><input type="submit" name="submit1" value="Send Message"></td>

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

  $lib_usernm_sql = mysqli_query($link,"select * from librarians where email='$_SESSION[librarian]'order by id desc");
  $pr = mysqli_fetch_array($lib_usernm_sql);
  $lib_usernm = $pr["username"];

    mysqli_query($link,"insert into messages values('','$lib_usernm','$_POST[dusername]','$_POST[title]','$_POST[msg]','n')") or die(mysqli_error($link));

    ?>
    <script type="text/javascript">
        alert("Message sent successfully");
    </script>
    <?php
}
?>

<?php
include "footer.php";
?>
