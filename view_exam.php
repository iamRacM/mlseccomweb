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
            <!-- VIEW EXAM DETAILS STARTS -->
              <?php if(@$_GET['q']==2) {
                  $exam_code = $_GET['eid'];
                  $result = $con->query("SELECT * FROM tbl_questions WHERE exam_code = '$exam_code'") or die('Error');
                  echo '<div class="panel">
                  <div style="float: right"><a href="#" data-toggle="modal" data-target="#addQuestion" style="text-decoration: none"><b><span class="glyphicon glyphicon-plus" style="color:green;" aria-hidden="true"></span> Add Question</b></a><br><br>
                  </div>
                  <table class="table table-striped title1">
                  <tr><td><b>Question</b></td><td><b>Option 1</b></td><td><b>Option 2</b></td><td><b>Option 3</b></td><td><b>Option 4</b></td><td><b>Answer</b></td><td><b>Action</b></td></tr>';
                  while($row = mysqli_fetch_array($result)) {
                    $question = $row['question'];
                    $option1 = $row['option1'];
                    $option2 = $row['option2'];
                    $option3 = $row['option3'];
                    $option4 = $row['option4'];
                    $answer = $row['answer'];
                    echo
                    '<tr><td>' . $question . '</td>
                     <td>' . $option1 .'</td>
                     <td>' . $option2 . '</td>
                     <td>' . $option3 . '</td>
                     <td>' . $option4 . '</td>
                     <td>' . $answer . '</td>
                     <td>
                     <a title="Delete Question" href="process.php?action=delQ&qid=' . $row['q_id'] . '&eid=' . $row['exam_code'] . '"><b><span class="glyphicon glyphicon-trash" style="color:red;" aria-hidden="true"></span></b></a>
                     <a href="#" title="Edit Question" data-toggle="modal" data-target="#editQuestion"><b><span class="glyphicon glyphicon-pencil" style="color:#FF5916;" aria-hidden="true"></span></b></a>
                     </td></tr>';
                  }
                  echo '</table></div>';
                }?>
            <!-- END OF VIEW EXAM DETAILS -->        

        </div><!--container closed-->
    </div>

<!-- ADD QUESION MODAL -->
<input id="examCode" type="hidden" value="<?php echo $_GET['eid']; ?>">
<div class="modal fade title1" id="addQuestion">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" style="font-family:'typo' "><span style="color:orange">Add Question</span></h4>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Question</div>
          <div class="col-md-8">
            <textarea type="text" id="question"class="form-control"></textarea>
          </div>
        </div><br>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Option 1</div>
          <div class="col-md-8">
            <input type="text" id="option1" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Option 2</div>
          <div class="col-md-8">
            <input type="text" id="option2" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Option 3</div>
          <div class="col-md-8">
            <input type="text" id="option3" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Option 4</div>
          <div class="col-md-8">
            <input type="text" id="option4" class="form-control">
          </div>
        </div><br>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Answer</div>
          <div class="col-md-8">
            <select class="form-control" id="answer">
              <option>Select the Correct Answer</option>
              <option>Option 1</option>
              <option>Option 2</option>
              <option>Option 3</option>
              <option>Option 4</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="submit_question">Submit</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END OF ADD QUESTION MODAL -->

<!-- EDIT QUESION MODAL -->
<div class="modal fade title1" id="editQuestion">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" style="font-family:'typo' "><span style="color:orange">Update Question</span></h4>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Question</div>
          <div class="col-md-8">
            <textarea type="text" id="question"class="form-control" value=""></textarea>
          </div>
        </div><br>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Option 1</div>
          <div class="col-md-8">
            <input type="text" id="option1" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Option 2</div>
          <div class="col-md-8">
            <input type="text" id="option2" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Option 3</div>
          <div class="col-md-8">
            <input type="text" id="option3" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Option 4</div>
          <div class="col-md-8">
            <input type="text" id="option4" class="form-control">
          </div>
        </div><br>
        <div class="row">
          <div class="col-md-3" style="text-align: right; padding-top: 5px; font-weight: bold">Answer</div>
          <div class="col-md-8">
            <select class="form-control" id="answer">
              <option>Select the Correct Answer</option>
              <option>Option 1</option>
              <option>Option 2</option>
              <option>Option 3</option>
              <option>Option 4</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="submit_question">Submit</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END OF EDIT QUESTION MODAL -->

  </body>
</html>

<script type="text/javascript">
  $(document).ready(function() {

    $("#submit_exam").click(function() {
      var action = "Add Exam";
      var exam_code = $("#examCode").val();
      var exam_title = $("#examTitle").val();
      var exam_schedule = $("#examSchedule").val();
      var exam_duration = $("#examDuration").val();
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
          if (response == "SUCCESS") {
            alert(response);
            $("#examCode").val("");
            $("#examTitle").val("");
            $("#examSchedule").val("");
            $("#examDuration").val("");
          } else {
            alert(response);
          }
        }
      });
    });

    $("#submit_question").click(function() {
      var action = "Add Question";
      var exam_code = $("#examCode").val();
      var question = $("#question").val();
      var option1 = $("#option1").val();
      var option2 = $("#option2").val();
      var option3 = $("#option3").val();
      var option4 = $("#option4").val();
      var answer = $("#answer").val();
      $.ajax({
        url : "process.php",
        method : "POST",
        data : {action : action,
          exam_code : exam_code,
          question : question,
          option1 : option1,
          option2 : option2,
          option3 : option3,
          option4 : option4,
          answer : answer
        },
        success : function (response) {
          if (response == "SUCCESS") {
            location.reload();
          } else {
            alert(response);
          }
        }
      });
    });

  });
</script>

<?php
  function randText($len){
    include 'dbConnection.php';
    $txt = "";
    $str = '0123456789';
    for($i=0;$i<$len;$i++){
      $txt.=substr($str, rand(0, strlen($str)), 1);   
    }

    $result = $con->query("SELECT * FROM tbl_exams WHERE exam_code = '$txt'");
    if ($result->num_rows == 0) {
      return $txt;
    } else {
      randText(6);
    }
  }
?>