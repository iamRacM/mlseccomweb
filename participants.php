<?php
  session_start();
  if (!isset($_SESSION['logged'])) {
    $_SESSION['err_msg'] = "<strong>Access Denied!</strong> Please login or contact the administrator.";
    header("location: index.php");
  }

  if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 2 || $_SESSION['account_type'] == 3) {
    
  } else {
    $_SESSION['err_msg'] = "<strong>Access Denied!</strong> Please login or contact the administrator.";
    header("location: index.php");
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>DASHBOARD </title>
  <link  rel="stylesheet" href="css/bootstrap.min.css"/>
  <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
  <link rel="stylesheet" href="css/main.css">
  <link  rel="stylesheet" href="css/font.css">
  <script src="js/jquery.js" type="text/javascript"></script>

  <script src="js/bootstrap.min.js"  type="text/javascript"></script>
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
  <script src="resources/jQuery3.6.0/jQuery3.6.0.js" type="text/javascript"></script>

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

  <body  style="background:#eee;">
    <div class="header">
      <div class="row">
        <div class="col-lg-6">
          <span class="logo">ML SECCOM<img src="image/seccom.png" style="width: 11%; position: absolute;"></span></div>
          <?php
          include_once 'dbConnection.php';
          echo '<span class="pull-right top title1" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> <a href="#" class="log log1">' . $_SESSION['firstname'] . '</a>&nbsp;|&nbsp;<a href="logout.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Logout</a></span>';
          ?>

        </div></div>
        <!-- admin start-->

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
              <a class="navbar-brand" href="dash.php?q=0"><b>Dashboard</b></a>
            </div>
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li <?php if(@$_GET['q']==0) echo'class="active"'; ?>><a href="dash.php?q=0"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home<span class="sr-only">(current)</span></a></li>

               <?php if ($_SESSION['account_type'] == 1) { //ADMIN FOR USERS
                  echo '<li';
                    if(@$_GET['q']==1) { echo ' class="active"'; }
                  echo '><a href="dash.php?q=1">Users</a></li>';
                }?>

                <?php if ($_SESSION['account_type'] == 2) { //ADMIN FOR EXAMINATION
                  echo '<li';
                  if(@$_GET['q']==2 || @$_GET['q']==5) { echo ' class="active"'; }
                  echo '><a href="dash.php?q=2">Examination</a></li>';
                }?>

                <?php if ($_SESSION['account_type'] == 3) {  //ADMIN FOR ALL ?>
                  <li <?php if(@$_GET['q']==1) echo'class="active"'; ?>><a href="dash.php?q=1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users</a></li>
                  <li <?php if(@$_GET['q']==2) echo'class="active"'; ?>><a href="dash.php?q=2"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Examination</a></li>
                  <li <?php if(@$_GET['q']==3) echo'class="active"'; ?>><a href="dash.php?q=3"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> Archive</a></li>
                <?php }?>                
                <!-- 
                <li <?php if(@$_GET['q']==1) echo'class="active"'; ?>><a href="dash.php?q=1">Users</a></li>
                <li <?php if(@$_GET['q']==3) echo'class="active"'; ?>><a href="dash.php?q=3">Reports</a></li>
                -->

              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        <!--navigation menu closed-->
        <div class="container"><!--container start-->
          <div class="row">
            <!-- VIEW OF PARTICIPANTS STARTS -->
              <?php if(@$_GET['q']==2) {
                  $exam_code = $_GET['eid'];
                  $result = $con->query("SELECT * FROM tbl_exams WHERE exam_code = '$exam_code'") or die('Error');
                  $row = $result->fetch_assoc();
                  echo '<div class="panel">
                  <div style="float: right"><a href="#" data-toggle="modal" data-target="#addParticipants" style="text-decoration: none"><b><span class="glyphicon glyphicon-plus" style="color:green;" aria-hidden="true"></span> Participants</b></a><br><br>
                  </div>
                  <table class="table table-striped title1 alert alert-success" style="width: 100%">
                  <tr><th style="padding: 0"><td class="bg-success"><b>Title:</b></td><td class="bg-success">' . $row['exam_title'] . '</td><td class="bg-success"><b>Date of Exam:</b></td><td class="bg-success">' . date("M. j, Y", strtotime($row['exam_schedule'])) . '</td><td class="bg-success"><b>Duration:</b></td><td class="bg-success">' . $row['exam_duration'] . '</td></tr>';
                  echo '</table></div>';

                  $query = "SELECT
                    tbl_exams.exam_code,
                    tbl_examlogs.log_empID,
                    tbl_examlogs.log_examCode,
                    tbl_users.emp_id,
                    tbl_users.first_name,
                    tbl_users.last_name,
                    tbl_users.branch,
                    tbl_users.emp_position
                    FROM
                      tbl_exams,
                      tbl_examlogs,
                      tbl_users
                    WHERE tbl_examlogs.log_examCode = '$exam_code' AND tbl_examlogs.log_empID = tbl_users.emp_id GROUP BY tbl_users.emp_id";
                $result = $con->query($query) or die('Error');
                echo '<div class="panel" style="margin-top: -3%"><table class="table table-striped title1">
                <tr><td><b>Employee ID</b></td><td><b>Full Name</b></td><td><b>Branch</b></td><td><b>Position</b></td><td></td><td><b>Action</b></td></tr>';
                while($row = $result->fetch_assoc()) {
                   echo '<tr><td>' . $row['emp_id'] . '</td><td><a href="participants.php?q=5&eid=' . $exam_code . '&empID=' . $row['emp_id'] . '" style="text-decoration: none">' . $row['first_name'] . ' ' . $row['last_name'] . '</a></td><td>' . $row['branch'] . '</td><td>' . $row['emp_position'] . '</td><td></td><td><a title="Remove Participant" href="process.php?action=remUser&eid=' . $exam_code . '&remID=' . $row['emp_id'] . '"><b><span class="glyphicon glyphicon-trash" style="color:red;" aria-hidden="true"></span></b></a></td></tr>';
                 }
                echo '</table></div>';
              }?>
            <!-- END OF VIEW OF PARTICIPANTS -->

              <!-- VIEW EXAM OF PARTICIPANTS STARTS -->
            <?php if(@$_GET['q']==5) {
                $exam_code = $_GET['eid'];
                $emp_id = @$_GET['empID'];

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
              tbl_examlogs.log_empID = '$emp_id' AND tbl_examlogs.log_examCode = tbl_exams.exam_code AND tbl_examlogs.log_examStatus = 0 AND tbl_examlogs.log_examCode = '$exam_code'";
              $result = $con->query($query) or die('Error');
              if ($result->num_rows != 0) {
                echo  '<div class="panel"><table class="table table-striped title1 alert alert-danger">
                <tr><td style="width: 50%"><b>Title</b></td><td><b>Date Taken</b></td><td><b>Total Items</b></td><td><b>Score</b></td></tr>';
                while($row = $result->fetch_assoc()) {
                  $exam_code = $row['exam_code'];
                  $items_r = $con->query("SELECT * FROM tbl_questions WHERE exam_code = '$exam_code'");
                  $total_items = $items_r->num_rows;
                  echo '<tr><td>' . $row['exam_title'] .'</td><td>' . date("M. j, Y", strtotime($row['log_dateTaken'])) . '</td><td>' . $total_items . '</td><td>' . $row['log_score'] .'</td></tr>';
                }
                echo '</table></div>';
              } else {
                 echo '<div class="panel"><div class="alert alert-danger" style="text-align: center"><strong> *** NO RECORDS FOUND ****</strong></div></div>';
              }

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

              $result = $con->query("SELECT * FROM tbl_exams WHERE exam_code = '$exam_code'") or die("ERROR");
              $row = $result->fetch_assoc();

              $result = $con->query($qry) or die("ERROR");
              echo  '<div class="panel" style="margin-top: -3%">';
              echo '<table class="table table-striped title1" style="width: 100%; margin-top: -2%">
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
          <!-- END OF VIEW EXAM OF PARTICIPANTS -->    

        </div><!--container closed-->
    </div>

<!-- ADD PARTICIPANTS MODAL -->
<input id="examCode" type="hidden" value="<?php echo $_GET['eid']; ?>">
<div class="modal fade title1" id="addParticipants">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" style="font-family:'typo' "><span style="color:orange">Add Participants</span></h4>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold"></div>
          <div class="col-md-7">
            <input type="text" id="empID_search"class="form-control" placeholder="Enter Employee ID No.">
          </div>
          <div class="col-md-2" style="margin-left: -25px">
            <button type="button" class="btn btn-primary" id="idSearchBtn"><span class="glyphicon glyphicon-search" style="font-size: 19px;" aria-hidden="true"></span></button>
          </div>
        </div><hr>

        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Employee ID</div>
          <div class="col-md-8">
            <input id="empID" class="form-control" readonly>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">First Name</div>
          <div class="col-md-8">
            <input id="empFName" class="form-control" readonly>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Last Name</div>
          <div class="col-md-8">
            <input id="empLName" class="form-control" readonly>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Branch</div>
          <div class="col-md-8">
            <input id="empBranch" class="form-control" readonly>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Position</div>
          <div class="col-md-8">
            <input id="empPosition" class="form-control" readonly>
          </div>
        </div><br>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="submitParticipants">Submit</button>
      </div></div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END OF ADD PARTICIPANTS MODAL -->

  </body>
</html>

<script type="text/javascript">
  $(document).ready(function() {

    $("#idSearchBtn").click(function() {
      var action = "Search Employee";
      var empID = $("#empID_search").val();
      $.ajax({
        url : "process.php",
        type : "POST",
        dataType: "json",
        data : {action : action, empID : empID},
        success : function (data) {
          if (data.error == "") {
            $("#empID").val(data.users.emp_id);
            $("#empFName").val(data.users.first_name);
            $("#empLName").val(data.users.last_name);
            $("#empBranch").val(data.users.branch);
            $("#empPosition").val(data.users.emp_position);
          } else {
            alert(data.error);
          }          
        }
      });
    });

    $("#submitParticipants").click(function() {
      var action = "Add Participant";
      var empID = $("#empID").val();
      var exam_code = $("#examCode").val();
      $.ajax({
        url : "process.php",
        type : "POST",
        data : {action : action, empID : empID, exam_code : exam_code},
        success : function (response) {
          alert(response);
          location.reload();        
        }
      });
    });

  });
</script>