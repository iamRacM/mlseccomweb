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
              $exam_code = $_GET['eid'];
              $qno = @$_GET['qno']; //QUESTION NO. 

              echo "<h3 class='text-center'>Examination</h3>";
              $result = $con->query("SELECT * FROM tbl_questions WHERE exam_code = '$exam_code'") or die ('ERROR!');
              $t_question = $result->num_rows; //TOTAL NO. OF QUESTIONS

              if (@$_GET['qno'] <= 0) {
                header("location: exam.php?q=1&eid=" . $exam_code . "&qno=1");
              }

               if (@$_GET['qno'] > $t_question) {
                header("location: exam.php?q=1&eid=" . $exam_code . "&qno=" . $t_question);
              }

              if (!isset($_SESSION['exam_q'])) {
                $n = 1;
                $_SESSION['exam_q'] = array();
                echo '<div class="panel">';
                while ($row = $result->fetch_assoc()) {
                  $exam_details = array (
                    "question" => $row['question'],
                    "option1" => $row['option1'],
                    "option2" => $row['option2'],
                    "option3" => $row['option3'],
                    "option4" => $row['option4'],
                    "answer" => $row['answer']
                  );
                  $_SESSION['exam_q'][$n] = $exam_details;
                  $n++;
                }
              } else {
                //THIS IS THE QUESTION
                echo '<div class="panel">';
                echo '<emp style="font-size: 22px">' . $qno . ') ' . $_SESSION['exam_q'][$qno]['question'] . '</emp>';
                echo '</div>';
                //-----------------------------------------

                //THIS IS THE OPTIONS
                echo '<div class="panel" style="margin-top: -3%">';
                echo '<emp style="font-size: 20px"><input type="radio" name="options" id="option1" value="Option1"> <label for="option1" style="font-weight: normal">' . $_SESSION['exam_q'][$qno]['option1'] . '</label></emp><br>';
                echo '<emp style="font-size: 20px"><input type="radio" name="options" id="option2" value="Option2"> <label for="option2" style="font-weight: normal">' . $_SESSION['exam_q'][$qno]['option2'] . '</label></emp><br>';
                echo '<emp style="font-size: 20px"><input type="radio" name="options" id="option3" value="Option3"> <label for="option3" style="font-weight: normal">' . $_SESSION['exam_q'][$qno]['option3'] . '</label></emp><br>';
                echo '<emp style="font-size: 20px"><input type="radio" name="options" id="option4" value="Option4"> <label for="option4" style="font-weight: normal">' . $_SESSION['exam_q'][$qno]['option4'] . '</label></emp><br>';
                echo '</div>';
                //-------------------------------------------

                //THIS IS THE NEXT AND PREVIOUS BUTTON
                echo '<div class="panel" style="margin-top: -3%">';
                if ($qno <= 0) {
                   echo '<a href="exam.php?q=1&eid=' . $exam_code . '&qno=' . $qno-1 . '"><button type="button" class="btn btn-primary" style="width: 80px" disabled>Previous</button></a>';
                }
                echo '<a href="exam.php?q=1&eid=' . $exam_code . '&qno=' . $qno-1 . '"><button type="button" class="btn btn-primary" style="width: 80px">Previous</button></a>
                <a href="exam.php?q=1&eid=' . $exam_code . '&qno=' . $qno+1 . '"><button type="button" class="btn btn-primary" style="width: 80px; float: right" id="nextBtn">Next</button></a>';
                //-------------------------------------------
              }
            }?>
          </div>
        </div>
      </div>
    </body>
  </html>