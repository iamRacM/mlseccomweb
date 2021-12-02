<?php
  session_start();

  if ($_SESSION['emp_id'] != "admin" && $_SESSION['logged'] == 1) {
    $_SESSION['err_msg'] = "<strong>Access Denied!</strong> Please login or contact the administrator.";
    header("location: index.php");
  }
  if (!isset($_SESSION['logged'])) {
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

  </head>

  <body  style="background:#eee;">

    <div class="se-pre-con"></div> <!-- LOADER SCREEN -->

    <div class="header">
      <div class="row">
        <div class="col-lg-6">
          <span class="logo">ML SECCOM<img src="image/seccom.png" style="width: 11%; position: absolute;"></span></div>
          <?php
          include_once 'dbConnection.php';
          echo '<span class="pull-right top title1" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> <span class="log log1" style="color: white">' . $_SESSION["firstname"] . '</span>&nbsp;|&nbsp;<a href="logout.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Logout</a></span>';
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
                  echo '><a href="dash.php?q=1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users</a></li>';
                }?>

                <?php if ($_SESSION['account_type'] == 2) { //ADMIN FOR EXAMINATION
                  echo '<li';
                  if(@$_GET['q']==2) { echo ' class="active"'; }
                  echo '><a href="dash.php?q=2"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Examination</a></li>';
                  echo '<li';
                  if(@$_GET['q']==3) { echo ' class="active"'; }
                  echo '><a href="dash.php?q=3"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> Archives</a></li>';
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
      <?php
      if (isset($_SESSION['alert_msg'])) {
        if ($_SESSION['alert_msg'] == 'SUCCESS') {
           echo $_SESSION['alert_msg'];
        } else {
          echo $_SESSION['alert_msg'];
        }

        unset($_SESSION['alert_msg']);
      } ?>

              <!--home start-->

              <?php if(@$_GET['q']==0) {
                 echo '<div class="panel"><img src="image/maintenance.png" style="margin-left: 25%;"></div>';
              } ?>

            <!-- USERS STARTS -->
              <?php if(@$_GET['q']==1) {

                  $exam_code = @$_GET['eid'];

                  if ($_SESSION['account_type'] == 1 || $_SESSION['account_type'] == 3) {

                    $result = $con->query("SELECT * FROM tbl_users") or die('Error');
                    echo  '<div class="panel"><table class="table table-striped title1">
                    <div style="float: right"><a href="#" data-toggle="modal" data-target="#addUser" style="text-decoration: none"><b><span class="glyphicon glyphicon-plus" style="color:green;" aria-hidden="true"></span> Add User</b></a><br><br>
                    </div>
                    <tr><td><b>Employee ID</b></td><td><b>Name</b></td><td><b>Branch</b></td><td><b>Position</b></td><td><b>Action</b></td></tr>';
                    while($row = mysqli_fetch_array($result)) {
                      $emp_id = $row['emp_id'];
                      $fullname = $row['first_name'] . " " . $row['last_name'];
                      $branch = $row['branch'];
                      $emp_position = $row['emp_position'];

                      echo
                      '<tr><td>' . $emp_id . '</td>
                       <td>' . $fullname .'</td>
                       <td>' . $branch . '</td>
                       <td>' . $emp_position . '</td>
                       <td><a title="Delete User" href="process.php?action=delU&empid=' . $emp_id .'"><b><span class="glyphicon glyphicon-trash" style="color:red;" aria-hidden="true"></span></b></a></td></tr>';
                    }
                    echo '</table></div>';
                  } else {
                    $_SESSION['err_msg'] = "<strong>Access Denied!</strong> Please login or contact the administrator.";
                    header("location: dash.php");
                  }
                }?>
            <!-- END OF USERS -->

            <!-- START OF EXAMINATION PAGE -->
              <?php if(@$_GET['q']== 2) 
              {
                if ($_SESSION['account_type'] == 2 || $_SESSION['account_type'] == 3) {

                  $result = $con->query("SELECT * FROM tbl_exams") or die('Error');
                  echo '<div class="panel">
                  <div style="float: right"><a href="#" data-toggle="modal" data-target="#addExam" style="text-decoration: none"><b><span class="glyphicon glyphicon-plus" style="color:green;" aria-hidden="true"></span> Add Exam</b></a><br><br>
                  </div>
                  <table class="table table-striped title1">
                  <tr><td><b>Exam Code</b></td><td><b>Title</b></td><td><b>Schedule</b></td><td><b>Status</b></td><td><b>Action</b></td></tr>';
                  while($row = mysqli_fetch_array($result)) {
                    $exam_code = $row['exam_code'];
                    $title = $row['exam_title'];
                    $schedule = $row['exam_schedule'];
                    if ($row['exam_status'] == 1) {
                      $status = '<emp style="color: red">Locked</emp>';
                    } else {
                      $status = '<emp style="color: green">Unlocked</emp>';
                    }


                    echo
                    '<tr>
                      <td>' . $exam_code . '</td>
                      <td>' . $title .'</td>
                      <td>' . date("M. j, Y", strtotime($schedule)) . '</td>
                      <td>' . $status . '</td>
                      <td>
                       <a title="Delete Exam" href="process.php?action=del&examID=' . $exam_code . '"> <b><span class="glyphicon glyphicon-trash" style="color:red;" aria-hidden="true"></span></b></a>
                       <a title="View Exam" href="view_exam.php?q=2&eid=' . $exam_code . '"> <b><span class="glyphicon glyphicon-list-alt" style="color:gray;" aria-hidden="true"></span></b></a>
                       <a title="Participants" href="participants.php?q=2&eid=' . $exam_code . '"><b><span class="glyphicon glyphicon-user" style="color:black;" aria-hidden="true"></span></b></a>
                       <a title="Participants" href="process.php?eid=' . $exam_code . '&action=examStat"><b><span class="glyphicon glyphicon-lock" style="color:maroon;" aria-hidden="true"></span></b></a>
                      </td>
                      </td>
                    </tr>';
                  }
                  echo '</table></div>';
                } else {
                  $_SESSION['err_msg'] = "<strong>Access Denied!</strong> Please login or contact the administrator.";
                  header("location: dash.php");
                }
              }
              ?>
            <!-- END OF EXAMINATION PAGE -->

            <!-- START OF REPORT PAGE -->
            <?php if(@$_GET['q']==3) {
                 echo '<div class="panel"><img src="image/maintenance.png" style="margin-left: 25%;"></div>';
              } ?>
            <!-- END OF REPORT PAGE -->

        </div><!--container closed-->
      </div>

<!-- ADD EXAMINATION MODAL -->
<div class="modal fade title1" id="addExam">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" style="font-family:'typo' "><span style="color:orange">Add Examination</span></h4>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Exam Code</div>
          <div class="col-md-8">
            <input type="text" id="examCode" value="<?php echo getECode(); ?>" class="form-control" readonly>
          </div>
        </div><br>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Title</div>
          <div class="col-md-8">
            <input type="text" id="examTitle" class="form-control">
          </div>
        </div><br>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Schedule</div>
          <div class="col-md-8">
            <input type="date" id="examSchedule" class="form-control">
          </div>
        </div><br>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Duration</div>
          <div class="col-md-8">
            <input type="number" id="examDuration" class="form-control" min="0" placeholder="Enter duration in minutes">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="submit_exam">Submit</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END OF ADD EXAMINATION MODAL -->

<!-- ADD USER MODAL -->
<div class="modal fade title1" id="addUser">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" style="font-family:'typo' "><span style="color:orange">Add User</span></h4>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Employee ID</div>
          <div class="col-md-8">
            <input type="text" id="user_empID" class="form-control">
          </div>
        </div><br>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">First Name</div>
          <div class="col-md-8">
            <input type="text" id="user_firstname" class="form-control">
          </div>
        </div><br>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Last Name</div>
          <div class="col-md-8">
            <input type="text" id="user_lastname" class="form-control">
          </div>
        </div><br>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Branch</div>
          <div class="col-md-8">
            <input type="text" id="user_branch" class="form-control">
          </div>
        </div><br>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Position</div>
          <div class="col-md-8">
            <input type="text" id="user_position" class="form-control">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="submit_user">Submit</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END OF ADD USER MODAL -->

  </body>
</html>

<script>
  $(document).ready(function() {
     $(".se-pre-con").delay(1300).fadeOut("fast");
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {

    $("#submit_exam").click(function() {
      var action = "Add Exam";
      var exam_code = $("#examCode").val();
      var exam_title = $("#examTitle").val();
      var exam_schedule = $("#examSchedule").val();
      var exam_duration = $("#examDuration").val();
      if ($("#examTitle").val() == "" || $("#examSchedule").val() == "" || $("#examDuration").val() == "") {
        alert("All field should not be left empty!");
      } else {
        $.ajax({
          url : "process.php",
          method : "POST",
          data : {action : action,
            exam_code : exam_code,
            exam_title : exam_title,
            exam_schedule : exam_schedule,
            exam_duration : exam_duration
          },
          success : function (response) {
            location.reload(5000);
          }
        });
      }
    });

    $("#submit_user").click(function() {
      var action = "Add User";
      var user_empID = $("#user_empID").val();
      var user_firstname = $("#user_firstname").val();
      var user_lastname = $("#user_lastname").val();
      var user_birthday = $("#user_birthday").val();
      var user_branch = $("#user_branch").val();
      var user_position = $("#user_position").val();
      if ($("#user_empID").val() == "" || $("#user_firstname").val() == "" || $("#user_lastname").val() == "" || $("#user_branch").val() == "" || $("#user_position").val() == "") {
        alert("All field should not be left empty!");
      } else {
        $.ajax({
          url : "process.php",
          method : "POST",
          data : {action : action,
            user_empID : user_empID,
            user_firstname : user_firstname,
            user_lastname : user_lastname,
            user_birthday : user_birthday,
            user_branch : user_branch,
            user_position : user_position
          },
          success : function (response) {
            location.reload(5000);
          }
        });
      }
    });

  });
</script>

<?php
  function getECode(){
    include 'dbConnection.php';

    $result = $con->query("SELECT * FROM tbl_exams ORDER BY exam_code DESC LIMIT 1");

    if ($result->num_rows == 0) {
      return "MLE" . date("Y") . "000";
    } else {
      $row = $result->fetch_assoc();
      return "MLE" . (int)filter_var($row['exam_code'], FILTER_SANITIZE_NUMBER_INT) + 1;
    }
  }
?>