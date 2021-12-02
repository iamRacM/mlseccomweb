<?php
session_start();

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

  <title>ML SECCOM</title>
  <link  rel="stylesheet" href="css/bootstrap.min.css"/>
  <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
  <link rel="stylesheet" href="css/main.css">
  <link  rel="stylesheet" href="css/font.css">
  <script src="js/jquery.js" type="text/javascript"></script>

  <script src="js/bootstrap.min.js"  type="text/javascript"></script>
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>

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
                <li <?php if(@$_GET['q']==2) echo'class="active"'; ?> ><a href="account.php?q=2"><span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span>&nbsp;History<span class="sr-only">(current)</span></a></li>
              </ul>
            </div><!-- /.navbar-collapse --> 
          </div><!-- /.container-fluid -->
        </nav><!--navigation menu closed-->
        <div class="container"><!--container start-->
          <div class="row">
            <!--home start-->
            <?php if(@$_GET['q']==1) {
              include_once 'dbConnection.php';
              $emp_id = $_SESSION['emp_id'];
              echo '<input type="hidden" id="exam_code" value="' . $_SESSION['exam_code'] . '">';
              echo '<input type="hidden" id="qno" value="' . $_SESSION['qno'] . '">';
              echo "<h3 class='text-center'>Examination</h3>";

            //THIS IS THE QUESTION
              echo '<div id="displayExam">';
              echo '<div class="panel">';
              if (isset($_SESSION['exam_stat'])) {
                echo '<input type="hidden" id="qid" value="' . $_SESSION['exam'][$_SESSION['qno']]['qid'] . '">';
                echo '<emp style="font-size: 22px">' . $_SESSION['qno'] . ') ' . $_SESSION['exam'][$_SESSION['qno']]['question'] . '</emp>';
                echo '</div>';
    //-----------------------------------------

                //THIS IS THE OPTIONS
                echo '<div class="panel" style="margin-top: -3%">';
                echo '<emp style="font-size: 20px"><input type="radio" name="options" id="option1" value="Option 1"> <label for="option1" style="font-weight: normal">' . $_SESSION['exam'][$_SESSION['qno']]['option1'] . '</label></emp><br>';
                echo '<emp style="font-size: 20px"><input type="radio" name="options" id="option2" value="Option 2"> <label for="option2" style="font-weight: normal">' . $_SESSION['exam'][$_SESSION['qno']]['option2'] . '</label></emp><br>';
                echo '<emp style="font-size: 20px"><input type="radio" name="options" id="option3" value="Option 3"> <label for="option3" style="font-weight: normal">' . $_SESSION['exam'][$_SESSION['qno']]['option3'] . '</label></emp><br>';
                echo '<emp style="font-size: 20px"><input type="radio" name="options" id="option4" value="Option 4"> <label for="option4" style="font-weight: normal">' . $_SESSION['exam'][$_SESSION['qno']]['option4'] . '</label></emp><br>';
                echo '</div></div>';

                echo '<div class="panel" style="margin-top: -3%">';
                echo '<button type="button" class="btn btn-primary" id="prevBtn">Prev</button>';


                  echo '<button type="button" class="btn btn-primary" id="nextBtn" style="float: right" disabled>Next</button></div>';
                
              }
              //-------------------------------------------
            }?>

            <!-- LAST QUESTION POPUP MODAL -->
            <div class="modal fade title1" id="lastQModal">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" style="font-family:'typo' "><span style="color:orange">MLSECCOM</span></h4>
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
            <!------------------------------------------------->
          </div>
        </div>
      </div>
    </body>
    </html>

    

    <script type="text/javascript">   
      $(document).ready(function() {

        var selected = "";
        var qno = 0;
        $(document).on("change", "input[name=options]", function() {
          selected = $(this).val();
          $("#nextBtn").prop("disabled", false);         
        });

        $("#nextBtn").click(function() {
          var action = "check answer";
          var qry = "next";
          var qid = $("#qid").val();
          var exam_code = $("#exam_code").val();
          var selected = $("input[name=options]:checked").val();
          $.ajax({
            url : "process.php",
            method : "POST",
            data : {action : action, qry : qry, qid : qid, exam_code : exam_code, selected : selected},
            success : function(response) {
              if (response == "DONE") {
                window.location.replace("account.php?q=3&eid=" + exam_code);
              }
              $("#displayExam").html(response);
              $("#nextBtn").prop("disabled", true);
            }
          });
        });

        $("#prevBtn").click(function() {
          var action = "check answer";
          var qry = "prev";
          var qid = $("#qid").val();
          var exam_code = $(this).val();

          $.ajax({
            url : "process.php",
            method : "POST",
            data : {action : action, qry : qry, qid : qid, exam_code : exam_code},
            success : function(response) {
              $("#displayExam").html(response);
            }
          });
          $("#nextBtn").prop("disabled", true);
        });

      });
    </script>