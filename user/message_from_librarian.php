<?php
session_start();
if(!isset($_SESSION["student_username"]))
{
    ?>
    <script type="text/javascript">

        window.location="login/login.php";

    </script>
<?php
}
include "header.php";
include "connection.php";
mysqli_query($link,"update messages set student_read='y' where student_email='$_SESSION[student_username]'");
$fullname=null;
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
                            <h2>Message from Librarian</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Full Name</th>
                                    <th> title</th>
                                    <th>message</th>
                                </tr>

                                <?php

                          //      echo "$_SESSION[student_username]";
                                $stu_usernm_sql = mysqli_query($link,"select * from users where email='$_SESSION[student_username]'order by id desc");
                                $pr = mysqli_fetch_array($stu_usernm_sql);
                                $stu_usernm = $pr["username"];
                        //        echo $stu_usernm;
                                //print_r($stu_usernm);


                                $res=mysqli_query($link,"select * from messages where student_username='$_SESSION[stu_usernm]'order by id desc");
                                while($row=mysqli_fetch_array($res))
                                {

                                  $lib_usernm_sql = mysqli_query($link,"select * from librarians where username='$row[librarian_username]'order by id desc");
                                  $pr2 = mysqli_fetch_array($lib_usernm_sql);
                                  $lib_usernm = $pr2["username"];
                            //      echo "   $row[librarian_username]";

                                    $res1=mysqli_query($link,"select * from librarians where username='$lib_usernm'");
                                    while($row1=mysqli_fetch_array($res1)) {

                                        $fullname=$row1["first_name"]." ".$row1["last_name"];

                                    }
                                    echo"<tr>";
                                    echo "<td>";echo $fullname; echo "</td>";
                                    echo "<td>";echo $row["title"]; echo "</td>";
                                    echo "<td>";echo $row["message"]; echo "</td>";
                                    echo "</tr>";

                                }

                                ?>

                            </table>
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
