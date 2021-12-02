<?php
session_start();

if (!$_SESSION['emp_id']) {
  $_SESSION['err_msg'] = "<strong>Access Denied!</strong> Please login or contact the administrator.";
  header("location: index.php");
}

if (isset($_SESSION['account_type']) AND $_SESSION['account_type'] != 0) {
  $_SESSION['err_msg'] = "<strong>Access Denied!</strong> Please login or contact the administrator.";
  header("location: dash.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>MLSECCOM | Account</title>
  <link rel="stylesheet" href="css/bootstrap.min.css"/>
  <link rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/font.css">
  <script src="js/jquery.js" type="text/javascript"></script>


  <script src="js/bootstrap.min.js"  type="text/javascript"></script>
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>

  <style type="text/css">
    .no-js #loader { display: none;  }
    .js #loader { display: block; position: absolute; left: 100px; top: 0; }
    .se-pre-con {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      min-height: 100%;
      z-index: 9999;
      background: url(resources/loader/loader2/64x64/Preloader_10.gif) center no-repeat #fff;
    }
  </style>

  <script>
    $(function () {
      $(document).on( 'scroll', function(){
        console.log('scroll top : ' + $(window).scrollTop());
        if($(window).scrollTop()>=$(".logo").height())
        {
          $(".navbar").addClass("navbar-fixed-top");
        }

        if($(window).scrollTop()<$(".logo").height())
        {
          $(".navbar").removeClass("navbar-fixed-top");
        }
      });
    });
  </script>

</head>
<?php
include_once 'dbConnection.php';
?>
<body>
  <div class="header">
    <div class="row">

      <div class="se-pre-con"></div> <!-- LOADER SCREEN -->

      <div class="col-lg-6">
        <span class="logo">ML SECCOM</span></div>
        <div class="col-md-4 col-md-offset-2">
          <span class="pull-right top title1" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> <span class="log log1" style="color: white"><?php echo $_SESSION['firstname']; ?></span>&nbsp;|&nbsp;<a href="logout.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Logout</a></span>
        </div>
      </div></div>
      <div class="bg">

        <!--navigation menu-->
        <nav class="navbar navbar-default title1">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="account.php?q=0"><b>Dashboard</b></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li <?php if(@$_GET['q']==0) echo'class="active"'; ?> ><a href="account.php?q=0"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home<span class="sr-only">(current)</span></a></li>
                <li <?php if(@$_GET['q']==1) echo'class="active"'; ?> ><a href="account.php?q=1"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;Examination<span class="sr-only">(current)</span></a></li>
                <li <?php if(@$_GET['q']==2 || @$_GET['q']==3) echo'class="active"'; ?> ><a href="account.php?q=2"><span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span>&nbsp;History<span class="sr-only">(current)</span></a></li>
                <?php
                echo '<li';
                if(@$_GET['q']==4 || @$_GET['q']==5) { echo' class="active dropdown"'; } 
                echo '><a href="#" class="dropdown-toggle" id="dropdownmenu1" data-toggle="dropdown" role="button"  aria-haspopup="true" aria-expanded="false" dropright><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Trainings</a>
                  <ul class="dropdown-menu" role="menu">
                    <li style="font-size: 15px; padding-bottom: 6px"><a href="?q=4"><span class="glyphicon glyphicon-facetime-video" aria-hidden="true" style="color: gray"></span> &nbsp;Videos</a>
                    </li>
                    <li style="font-size: 15px; padding-bottom: 6px"><a href="?q=5"><span class="glyphicon glyphicon-book" aria-hidden="true" style="color: gray"></span> &nbsp;Manuals</a>
                    </li>
                  </ul>
                </li>';
                ?>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav><!--navigation menu closed-->
        <div class="container"><!--container start-->
          <div class="row">

            <!-- START OF HOME PAGE -->
            <?php if(@$_GET['q']==0) {
              echo '<div class="panel"><img src="image/maintenance.png" style="margin-left: 25%;"></div>';
            } ?>
            <!-- END OF HOME PAGE -->

            <!-- EXAMINATION PAGE START -->
            <?php if(@$_GET['q']==1) {
              include_once 'dbConnection.php';
              $emp_id = $_SESSION['emp_id'];
              echo "<h3 class='text-center'>Available Examination</h3>";

              $query = "SELECT
              tbl_examlogs.log_empID,
              tbl_examlogs.log_examCode,
              tbl_examlogs.log_examStatus,
              tbl_exams.exam_code,
              tbl_exams.exam_title,
              tbl_exams.exam_schedule,
              tbl_exams.exam_duration,
              tbl_exams.exam_status
              FROM
              tbl_examlogs,
              tbl_exams
              WHERE
              tbl_examlogs.log_empID = '$emp_id' && tbl_examlogs.log_examCode = tbl_exams.exam_code AND tbl_examlogs.log_examStatus = 1";
              $result = $con->query($query) or die('Error');
              if ($result->num_rows != 0) {
                echo  '<div class="panel"><table class="table table-striped title1">
                <tr><td><b>Exam Code</b></td><td><b>Title</b></td><td><b>Examination Date</b></td><td><b>Time limit</b></td><td></td><td><b>Action</b></td></tr>';
                while($row = $result->fetch_assoc()) {
                  echo '<tr><td>' . $row['exam_code'] . '</td><td>' . $row['exam_title'] .'</td><td>' . date("M. j, Y", strtotime($row['exam_schedule'])) . '</td><td>' . $row['exam_duration'] . '</td><td></td><td>';
                  if ($row['exam_status'] == 0) {
                    echo '<button name="startBtn" type="button" class="btn btn-success btn-sm" value="' . $row['exam_code'] . '" style="margin-top: -5px; border-radius: 50px" data-toggle="modal" data-target="#confirmModal">Start</button></td></tr>';
                  } else {
                    echo '<b><span class="glyphicon glyphicon-lock" style="color:maroon;" aria-hidden="true"></span></b>';
                  }
                }
                echo '</table></div>';
              } else {
                echo '<div class="panel"><div class="alert alert-danger" style="text-align: center"><strong> *** NO RECORDS FOUND ***</strong></div></div>';
              }
            }?>
            <!-- END OF EXAMINATION PAGE -->

            <!-- START OF HISTORY PAGE -->
            <?php if(@$_GET['q']==2) {
              include_once 'dbConnection.php';
              $emp_id = $_SESSION['emp_id'];
              echo "<h3 class='text-center'>History</h3>";

              $query = "SELECT
              tbl_examlogs.log_empID,
              tbl_examlogs.log_examCode,
              tbl_examlogs.log_dateTaken,
              tbl_examlogs.log_score,
              tbl_examlogs.log_examStatus,
              tbl_exams.exam_code,
              tbl_exams.exam_title,
              tbl_exams.exam_schedule,
              tbl_exams.exam_duration
              FROM
              tbl_examlogs,
              tbl_exams
              WHERE
              tbl_examlogs.log_empID = '$emp_id' AND tbl_examlogs.log_examCode = tbl_exams.exam_code AND tbl_examlogs.log_examStatus = 0";
              $result = $con->query($query) or die('Error');
              if ($result->num_rows != 0) {
                echo  '<div class="panel"><table class="table table-striped title1 alert alert-danger">
                <tr><td style="width: 50%"><b>Title</b></td><td><b>Date Taken</b></td><td><b>Total Items</b></td><td><b>Score</b></td></tr>';
                while($row = $result->fetch_assoc()) {
                  $exam_code = $row['exam_code'];
                  $items_r = $con->query("SELECT * FROM tbl_questions WHERE exam_code = '$exam_code'");
                  $total_items = $items_r->num_rows;
                  echo '<tr><td><a href="?q=3&eid=' . $row['exam_code'] . '" style="text-decoration: none">' . $row['exam_title'] .'</a></td><td>' . date("M. j, Y", strtotime($row['log_dateTaken'])) . '</td><td>' . $total_items . '</td><td>' . $row['log_score'] .'</td></tr>';
                }
                echo '</table></div>';
              } else {
                echo '<div class="panel"><div class="alert alert-danger" style="text-align: center"><strong> *** NO RECORDS FOUND ***</strong></div></div>';
              }
            }?>
            <!-- END OF HISTORY PAGE -->

            <!-- START OF HISTORY RESULT PAGE -->
            <?php if(@$_GET['q']==3) {
              include_once 'dbConnection.php';
              $emp_id = $_SESSION['emp_id'];
              $exam_code = @$_GET['eid'];
              echo "<h3 class='text-center'>History</h3>";

              $query = "SELECT /*HEADER TABLE*/
              tbl_examlogs.log_empID,
              tbl_examlogs.log_examCode,
              tbl_examlogs.log_dateTaken,
              tbl_examlogs.log_score,
              tbl_examlogs.log_examStatus,
              tbl_exams.exam_code,
              tbl_exams.exam_title,
              tbl_exams.exam_schedule,
              tbl_exams.exam_duration
              FROM 
              tbl_examlogs,
              tbl_exams
              WHERE
              tbl_examlogs.log_empID = '$emp_id' AND tbl_examlogs.log_examCode = tbl_exams.exam_code AND tbl_examlogs.log_examStatus = 0 AND tbl_examlogs.log_examCode = '$exam_code'";

              $items_r = $con->query("SELECT * FROM tbl_questions WHERE exam_code = '$exam_code'"); /*TOTAL ITEMS*/

              $qry = "SELECT
              tbl_examlogs.log_empID,
              tbl_examlogs.log_examCode,
              tbl_examlogs.log_score,
              tbl_examlogs.log_examStatus,
              tbl_answers.ans_empID,
              tbl_answers.ans_examCode,
              tbl_answers.ans_qid,
              tbl_answers.ans_selected,
              tbl_answers.ans_remark,
              tbl_questions.q_id,
              tbl_questions.question
              FROM
              tbl_examlogs,
              tbl_answers,
              tbl_questions       
              WHERE
              tbl_examlogs.log_empID = tbl_answers.ans_empID AND tbl_examlogs.log_examCode = tbl_answers.ans_examCode AND tbl_answers.ans_qid = tbl_questions.q_id AND tbl_answers.ans_empID = '$emp_id' AND tbl_examlogs.log_examCode = '$exam_code'";

              $result = $con->query($query) or die("ERROR");
              $row = $result->fetch_assoc();

              echo  '<div class="panel"><table class="table table-striped title1 alert alert-danger">
              <tr><td style="width: 50%"><b>Title</b></td><td><b>Date Taken</b></td><td><b>Total Items</b></td><td><b>Score</b></td></tr>';
              echo '<tr><td>' . $row['exam_title'] .'</td><td>' . date("M. j, Y", strtotime($row['log_dateTaken'])) . '</td><td>' . $items_r->num_rows . '</td><td>' . $row['log_score'] .'</td></tr>';
              echo '</table></div>';

              $result = $con->query($qry) or die("ERROR");
              echo  '<div class="panel" style="margin-top: -3%">';
              echo '<table class="table table-striped title1" style="width: 100%">
              <tr><td style="text-align: center"><b>Question</b></td><td style="text-align: center"><b>Remarks</b></td></tr>';              
              while ($row = $result->fetch_assoc()) {
                echo '<tr><td>' . $row['question'] . '</td>';
                if($row['ans_remark'] == 1) {
                  echo '<td style="text-align: center"><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color: green"></span></td></tr>';
                } else {
                  echo '<td style="text-align: center"><span class="glyphicon glyphicon-remove" aria-hidden="true" style="color: red"></span></td></tr>';
                }
              }
              echo '</table></div>';
            }?>
            <!-- END OF HISTORY RESULT PAGE -->

            <!-- START OF TRAINING PAGE -->
            <?php if(@$_GET['q']==4) {
              include_once 'dbConnection.php';
              $emp_id = $_SESSION['emp_id'];
              $exam_code = @$_GET['eid'];

              echo "<h3 class='text-center'>Training Videos</h3>";

              echo '<div class="panel">';
              echo '<div class="row">
              <div class="col col-md-6">
              <video width="509px" height="300px" controls style="border: 5px solid maroon">
              <source src="resources/uploads/videos/sample.mp4">
              </video><br>
              <div class="form-group alert alert-secondary" style="margin-top: 5px; background-color: rgb(232, 230, 230)">
              <strong>Title: </strong> TITLE HERE....<br>
              <strong>Description: </strong> This will be the description of the uploaded videos.
              </div>
              </div>
              <div class="col col-md-6">
              <video width="500px" height="300px" controls style="border: 5px solid maroon">
              <source src="resources/uploads/videos/sample.mp4">
              </video><br>
              <div class="form-group alert alert-secondary" style="margin-top: 5px; background-color: rgb(232, 230, 230)">
              <strong>Title: </strong> TITLE HERE....<br>
              <strong>Description: </strong> This will be the description of the uploaded videos.
              </div>
              </div>
              </div>
              <div class="row">
              <div class="col col-md-6">
              <video width="509px" height="300px" controls style="border: 5px solid maroon">
              <source src="resources/uploads/videos/sample.mp4">
              </video><br>
              <div class="form-group alert alert-secondary" style="margin-top: 5px; background-color: rgb(232, 230, 230)">
              <strong>Title: </strong> TITLE HERE....<br>
              <strong>Description: </strong> This will be the description of the uploaded videos.
              </div>
              </div>
              <div class="col col-md-6">
              <video width="500px" height="300px" controls style="border: 5px solid maroon">
              <source src="resources/uploads/videos/sample.mp4">
              </video><br>
              <div class="form-group alert alert-secondary" style="margin-top: 5px; background-color: rgb(232, 230, 230)">
              <strong>Title: </strong> TITLE HERE....<br>
              <strong>Description: </strong> This will be the description of the uploaded videos.
              </div>
              </div>
              </div>';
              echo '</div>';

            }?>
            <!-- END OF TRAINING PAGE -->

            <!-- START OF TRAINING PAGE MANUALS -->
            <?php if(@$_GET['q']== 5) 
            {
              include_once 'dbConnection.php';
              echo "<h3 class='text-center'>Training Manuals</h3>";
              echo '<div class="panel">
              <div class="alert alert-warning" style="text-align: center"><strong> *** NO FILES FOUND ***</strong>
              </div>'; 
            }
            ?>
            <!-- ---------------------- -->


            <!-- CONFIRMATION MODAL -->
            <div class="modal fade title1" id="confirmModal">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" style="font-family:'typo'; color: orange; "><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="color: red; font-weight: normal;"></span> Warning </h4>
                  </div>

                  <div class="modal-body" style="text-align: center;">
                    Before proceeding!<br>Please check your internet connection. By clicking confirm, the timer will automatically start and the examination cannot be retaken.
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cnfrmBtn" style="border: 1px solid #ccc"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true" style="color: green"></span> Confirm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border: 1px solid #ccc"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true" style="color: red"></span> Cancel</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- END OF CONFIRMATION MODAL -->

          </div>
        </div>
      </div>
    </body>
    </html>

    <script type="text/javascript">

      $(document).ready(function() {

        $(".se-pre-con").delay(1300).fadeOut("fast");

        var exam_code = "";

        $("button[name=startBtn]").click(function() {
          exam_code = $(this).val();
          $("#confirmation").modal("show");
        });

        $("#cnfrmBtn").click(function() {
          var action = "get question";
          $.ajax({
            url : "process.php",
            method : "POST",
            data : {action : action, exam_code : exam_code},
            success : function (response) {
              window.location.replace("exam.php?q=1");
            }
          });
        });

      })

    </script>