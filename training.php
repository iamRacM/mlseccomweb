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

  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>MLSECCOM | Training </title>
  <link  rel="stylesheet" href="css/bootstrap.min.css"/>
  <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
  <link rel="stylesheet" href="css/main.css">
  <link  rel="stylesheet" href="css/font.css">
  <script src="js/jquery.js" type="text/javascript"></script>

  <script src="js/bootstrap.min.js"  type="text/javascript"></script>
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
  <script src="resources/jQuery3.6.0/jQuery3.6.0.js" type="text/javascript"></script>
  <script src="js/modernizr.js" type="text/javascript"></script>

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

<body style="background:#eee;">

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
            <a class="navbar-brand" href="?q=0"><b>Dashboard</b></a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li <?php if(@$_GET['q']==0) echo'class="active"'; ?>><a href="?q=0"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home<span class="sr-only">(current)</span></a></li>

<?php if ($_SESSION['account_type'] == 4) { //ADMIN FOR TRAININGS
  echo '<li';
  if(@$_GET['q']==1 || @$_GET['q']==2 || @$_GET['q']==3 || @$_GET['q']==4) { echo ' class="active"'; }
  echo ' class="dropdown"><a href="#" class="dropdown-toggle" id="dropdownmenu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Trainings</a>
  <ul class="dropdown-menu" role="menu">
  <li style="font-size: 15px; padding-bottom: 6px"><a href="?q=1"><span class="glyphicon glyphicon-calendar" aria-hidden="true" style="color: gray"></span> &nbsp;Schedules</a></li>
  <li style="font-size: 15px; padding-bottom: 6px"><a href="?q=2"><span class="glyphicon glyphicon-facetime-video" aria-hidden="true" style="color: gray"></span> &nbsp;Videos</a></li>
  <li style="font-size: 15px"><a href="?q=3"><span class="glyphicon glyphicon-book" aria-hidden="true" style="color: gray"></span> &nbsp;Manuals</a></li>
  </ul>
  </li>';
  echo '<li';
  if(@$_GET['q']==5) { echo' class="active"'; } 
  echo ' class="dropdown"><a href="#" class="dropdown-toggle" id="dropdownmenu1" data-toggle="dropdown" role="button"  aria-haspopup="true" aria-expanded="false" dropright><span class="glyphicon glyphicon-file" aria-hidden="true"></span> Archives</a>
  <ul class="dropdown-menu" role="menu">
  <li style="font-size: 15px; padding-bottom: 6px"><a href="?q=1"><span class="glyphicon glyphicon-bullhorn" aria-hidden="true" style="color: gray"></span> &nbsp;Trainings</a></li>
  </ul></li>';
}?>

<?php if ($_SESSION['account_type'] == 3) {  //ADMIN FOR ALL ?>
  <li <?php if(@$_GET['q']==1) echo'class="active"'; ?>><a href="dash.php?q=1">Users</a></li>
  <li <?php if(@$_GET['q']==2) echo'class="active"'; ?>><a href="dash.php?q=2">Examination</a></li>
  <li <?php if(@$_GET['q']==3) echo'class="active"'; ?>><a href="dash.php?q=3"><span class="glyphicon glyphicon-bar" aria-hidden="true"></span> Reports</a></li>
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

    <!--home start-->

    <?php if(@$_GET['q']==0) {
      echo '<div class="panel"><img src="image/maintenance.png" style="margin-left: 25%; width: 40%" class="a1"></div>';
    } ?>

    <!-- TRAINING STARTS -->
<?php if(@$_GET['q']==1) { //TRAINING SCHEDULES
  include_once 'dbConnection.php';
  echo "<h3 class='text-center'>Training Schedules</h3>";

  if (isset($_SESSION['alert_msg'])) {
    echo $_SESSION['alert_msg'];
    unset($_SESSION['alert_msg']);
  }

  $result = $con->query("SELECT * FROM tbl_trainings ORDER BY trn_schedule");

  echo '<div class="panel">';
  echo '<div style="float: right"><a href="#" data-toggle="modal" data-target="#scheduleTraining" data-backdrop="static" data-keyboard="false" style="text-decoration: none"><b><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Schedule A Training</b></a><br><br>
  </div>';
//<div class="alert alert-info" style="text-align: center"><strong> *** NO FILES FOUND ***</strong>//
  echo '<table class="table table-striped title1 alert alert-info">
  <tr><td><b>Training Schedule</b></td><td><b>Training Title</b></td><td><b>Training Status</b></td><td><b>Action</b></td></tr>';
  while ($row = $result->fetch_assoc()) {
    echo '<tr><td>' . date("M. d, Y", strtotime($row['trn_schedule'])) . '
    </td><td>' . $row['trn_title'] . '</td>';
    if ($row['trn_status'] == 1) {
      echo '<td style="color: green">Pending</td>';
    } else {
      echo '<td style="color: red">Finished</td>';
    }
    echo '<td style="width: 20%">
    <a href="training_process.php?q=delete&trnid=' . $row['trn_id'] . '" title="Delete">
    <span class="glyphicon glyphicon-trash" style="color: maroon" aria-hidden="true"></span>
    </a>&nbsp;
    <a href="?q=4&trnid=' . $row['trn_id'] . '" title="Participants">
    <span class="glyphicon glyphicon-user" style="color: maroon" aria-hidden="true"></span>
    </a>
    <button type="button" name="updateBtn" title="Update" value="' . $row['trn_id'] . '" style="border: 0; background: none">
      <span class="glyphicon glyphicon-pencil" style="color: orange" aria-hidden="true"></span>
    </button>
    </td></tr>';
  }
  echo '</table>';
}
?>

<?php if(@$_GET['q']==2) {
  include_once 'dbConnection.php';
  echo "<h3 class='text-center'>Training Videos</h3>";
  echo '<div class="panel">';
  echo '<div style="float: right"><a href="#" data-toggle="modal" data-target="#uploadVid" data-backdrop="static" data-keyboard="false" style="text-decoration: none"><b><span class="glyphicon glyphicon-open" aria-hidden="true"></span> Upload Video</b></a><br><br>
  </div>';
//<div class="alert alert-info" style="text-align: center"><strong> *** NO FILES FOUND ***</strong>//
  echo '<table class="table table-striped title1 alert alert-warning">
  <tr><td><b>Thumbnail</b></td><td><b>Description</b></td><td><b>Date Uploaded</b></td><td><b>Action</b></td></tr>';
  echo '<tr><td><video width="100px" height="100px">
  <source src="resources/uploads/videos/sample.mp4">
  </video>
  </td><td>This is a sample video description</td>
  <td>Nov. 5, 2021</td>
  <td>View</td>
  <tr><td><video width="100px" height="100px">
  <source src="resources/uploads/videos/sample.mp4">
  </video>
  </td><td>This is a sample video description</td>
  <td>Nov. 5, 2021</td>
  <td>View</td>
  <tr><td><video width="100px" height="100px">
  <source src="resources/uploads/videos/sample.mp4">
  </video>
  </td><td>This is a sample video description</td>
  <td>Nov. 5, 2021</td>
  <td>View</td>
  <tr><td><video width="100px" height="100px">
  <source src="resources/uploads/videos/sample.mp4">
  </video>
  </td><td>This is a sample video description</td>
  <td>Nov. 5, 2021</td>
  <td>View</td>
  </tr></table>
  </div>';
}?>
<!-- END OF TRAININGS -->

<!-- START OF EXAMINATION PAGE -->
<?php if(@$_GET['q']== 3) 
{
  include_once 'dbConnection.php';
  echo "<h3 class='text-center'>Training Manuals</h3>";
  echo '<div class="panel">
  <div class="alert alert-warning" style="text-align: center"><strong> *** NO FILES FOUND ***</strong>
  </div>'; 
}
?>
<!-- END OF EXAMINATION PAGE -->

<!-- START OF USER PARTICIPANTS PAGE -->
<?php if(@$_GET['q']== 4) 
{
  $trn_id = @$_GET['trnid'];
  include_once 'dbConnection.php';
  $result = $con->query("SELECT * FROM tbl_trainings WHERE trn_id = '$trn_id'") or die('Error');
  $row = $result->fetch_assoc();
  echo '<div class="panel">
  <div style="float: right"><a href="#" data-toggle="modal" data-target="#addParticipants" style="text-decoration: none"><b><span class="glyphicon glyphicon-plus" style="color:green;" aria-hidden="true"></span> Participants</b></a><br><br>
  </div>
  <table class="table table-striped title1 alert alert-success" style="width: 100%">
  <tr><th style="padding: 0"><td class="bg-success"><b>Title:</b></td><td class="bg-success">' . $row['trn_title'] . '</td><td class="bg-success"><b>Schedule:</b></td><td class="bg-success">' . date("M. j, Y", strtotime($row['trn_schedule'])) . '</td></tr>';
  echo '</table></div>';
  $query = "SELECT
  tbl_trainings.trn_id,
  tbl_trainings.trn_schedule,
  tbl_trainings.trn_title,
  tbl_trainings.trn_status,
  tbl_trnlogs.log_empID,
  tbl_trnlogs.log_trnID,
  tbl_users.emp_id,
  tbl_users.first_name,
  tbl_users.last_name,
  tbl_users.branch,
  tbl_users.emp_position
  FROM
  tbl_trainings,
  tbl_trnlogs,
  tbl_users
  WHERE tbl_trainings.trn_id = tbl_trnlogs.log_trnID AND tbl_trnlogs.log_empID = tbl_users.emp_id AND tbl_trnlogs.log_trnID = '$trn_id'";
  $result = $con->query($query) or die('Error');
  echo '<div class="panel" style="margin-top: -3%"><table class="table table-striped title1">
  <tr><td><b>Employee ID</b></td><td><b>Full Name</b></td><td><b>Branch</b></td><td><b>Position</b></td><td></td><td><b>Action</b></td></tr>';
  while($row = $result->fetch_assoc()) {
    echo '<tr><td>' . $row['emp_id'] . '</td><td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td><td>' . $row['branch'] . '</td><td>' . $row['emp_position'] . '</td><td></td><td><a title="Remove Participant" href="#"><b><span class="glyphicon glyphicon-trash" style="color:red;" aria-hidden="true"></span></b></a></td></tr>';
  }
  echo '</table></div>';
}
?>
<!-- -------------------- -->

</div><!--container closed-->
</div>

<!-- UPLOAD VIDEO MODAL -->
<input id="trnID" type="hidden" value="<?php echo hash('sha256', @$_GET['trnid']); ?>">
<div class="modal fade title1" id="uploadVid">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" style="font-family:'typo' "><span style="color:orange">Upload Video</span></h4>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Title</div>
          <div class="col-md-8">
            <input type="text" id="vidTitle" class="form-control">
          </div>
        </div><br>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Description</div>
          <div class="col-md-8">
            <textarea id="vidDescription" class="form-control"></textarea>
          </div>
        </div><br>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">File</div>
          <div class="col-md-8">
            <input type="file" id="vidFile" class="form-control">
          </div>
        </div><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="uploadVidBtn"><span class="glyphicon glyphicon-open" aria-hidden="true"></span> Upload</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border: 1px solid gray"><span class="glyphicon glyphicon-remove" aria-hidden="true" style="color: maroon"></span> Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END OF UPLOAD VIDEO MODAL -->

<!-- SCHEDULE A TRAINING MODAL -->
<div class="modal fade title1" id="scheduleTraining">
  <div class="modal-dialog modal-md" style="width: 500px">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" style="font-family:'typo' "><span style="color:orange">Schedule A Training</span></h4>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Pick A Date</div>
          <div class="col-md-8">
            <input type="date" id="trainingDate" class="form-control">
          </div>
        </div><br>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Title</div>
          <div class="col-md-8">
            <input id="trainingTitle" type="text" class="form-control">
          </div>
        </div><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="scheduleTrnBtn"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border: 1px solid gray"><span class="glyphicon glyphicon-remove" aria-hidden="true" style="color: maroon"></span> Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END OF SCHEDULE TRAINING MODAL -->

<!-- ADD PARTICIPANTS MODAL -->
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

<!-- UPDATE SCHEDULE MODAL -->
<div class="modal fade title1" id="updateModal">
  <div class="modal-dialog modal-md" style="width: 520px">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" style="font-family:'typo' "><span style="color:orange">Update Schedule</span></h4>
      </div>

      <div class="modal-body">
        <input type="hidden" id="updateTrainingID" value="">
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Update Date</div>
          <div class="col-md-8">
            <input type="date" id="updateTrainingDate" class="form-control">
          </div>
        </div><br>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Update Title</div>
          <div class="col-md-8">
            <input type="text" id="updateTrainingTitle" class="form-control">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" id="submitUpdateBtn"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Update</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border: 1px solid gray"><span class="glyphicon glyphicon-remove" aria-hidden="true" style="color: maroon"></span> Cancel</button>
      </div></div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END OF UPDATE SCHEDULE MODAL -->

</body>
</html>

<script type="text/javascript">
  document.onmousedown = disableclick;
  var status = "Right Click Disabled!";
  function disableclick(e) {
    if (event.button == 2) {
      alert(status);
      return false;
    }
  }

  $(document).ready(function() {

    $(".se-pre-con").delay(1300).fadeOut("fast");

    jQuery.noConflict();

    $("#uploadVidBtn").click(function() {
      var action = "Upload Video";
      var title = $("#vidTitle").val();
      var file_data = $("#vidFile").prop('files')[0];
      var form_data = new FormData();
      form_data.append('file', file_data);
      $.ajax({
        url : "upload.php?title=" + title,
        dataType : "text",
        cache : false,
        contentType : false,
        processData : false,
        method : "POST",
        data : form_data,
        success : function(response) {
          alert(response);
          location.reload();
        }
      });
    });

    $("#scheduleTrnBtn").click(function() {
      var action = "Training Schedule";
      var trainingDate = $("#trainingDate").val();
      var trainingTitle = $("#trainingTitle").val();
      $.ajax({
        url : "training_process.php",
        method : "POST",
        data : {action : action, trainingDate : trainingDate, trainingTitle : trainingTitle},
        success : function(response) {          
          window.location.reload();
        }
      });
    });

    $("button[name=updateBtn]").click(function() {
      var trnID = $(this).val();
      var action = "Update Training"

      $.ajax({
        url : "training_process.php",
        type : "POST",
        dataType: "json",
        data : {action : action, trnID : trnID},
        success : function (data) {
          if (data.error == "") {
            $("#updateTrainingDate").val(data.training_details.trn_schedule);
            $("#updateTrainingTitle").val(data.training_details.trn_title);
            $("#updateTrainingID").val(data.training_details.trn_id)
          } else {
            alert(data.error);
          }          
        }
      });
      $("#updateModal").modal("show");
    });

    $("#submitUpdateBtn").click(function() {      
      var trn_id = $("#updateTrainingID").val();
      var trn_title = $("#updateTrainingTitle").val();
      var trn_schedule = $("#updateTrainingDate").val();
      var action = "Submit Update Training";
      $.ajax({
        url : "training_process.php",
        type : "POST",
        data : {action : action, trn_id : trn_id, trn_schedule : trn_schedule, trn_title : trn_title},
        success : function(result) {
          window.location.reload();
        }
      });

      $("#updateModal").modal("show");

    });

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
      var trnID = $("#trnID").val();
      $.ajax({
        url : "training_process.php",
        type : "POST",
        data : {action : action, empID : empID, trnID : trnID},
        success : function (response) {
          alert(response);
          location.reload();        
        }
      });
    });

  });
</script>