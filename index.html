<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>ML SECCOM </title>
  <link  rel="stylesheet" href="css/bootstrap.min.css"/>
  <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
  <link rel="stylesheet" href="css/main.css">
  <link  rel="stylesheet" href="css/font.css">
  <script src="js/jquery.js" type="text/javascript"></script>

  <script src="js/bootstrap.min.js"  type="text/javascript"></script>
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
  <script src="resources/jQuery3.6.0/jQuery3.6.0.js" type="text/javascript"></script>

</head>

<body>
  <div class="header">
    <div class="col-lg-6">
      <span class="logo">ML SECCOM</span>
    </div>

    <div class="col-md-2 col-md-offset-4">
      <a href="#" class="pull-right btn sub1" style="border-radius:0%" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Login</b></span></a>
    </div>
  </div>

  <div class="container"><!--container start-->  
    <div class="panel">
      <?php
      if (isset($_SESSION['err_msg'])) {
        echo '<div class="alert alert-danger alert-dismissible fade in">'
        . $_SESSION['err_msg'] . 
        '<button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>';
        unset($_SESSION['err_msg']);
      } ?>
    </div>
  </div 
  <!--sign in modal start-->
  <div class="modal fade" id="myModal">
    <img src="image/technology.png" style="width: 8%; border-radius: 50%; border: 4px solid maroon; position: relative; left: 50%; top: 14%; transform: translate(-50%); z-index: 2">
    <div class="modal-dialog modal-sm" style="position: absolute; width: 350px; left: 50%; top: 40%; transform: translate(-50%, -50%);">
      <div class="modal-content title1">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br><br>
          <h4 class="modal-title title1 text-center"><span style="color:black"><b>LOGIN</b></span></h4>
        </div>
        <div class="modal-body">
          <div class="form-horizontal">
            <fieldset>
              <!-- Text input-->
              <div class="form-group">                 
                <div class="col-md-12 px-0">
                  <input id="user_id" name="user_id" placeholder="ID" class="form-control input-md" type="text">
                </div>
              </div>
              <!-- Password input-->
              <div class="form-group">
                <div class="col-md-12">
                  <input id="password" name="password" placeholder="Password" class="form-control input-md" type="password">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="loginBtn" class="btn btn-primary">Log in</button>
            </fieldset>
          </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!--sign in modal closed-->
</body>
</html>

<script type="text/javascript">

  $(document).ready(function() {
    $("#loginBtn").click(function() {
      var action = "login";
      var user_id = $("#user_id").val();
      var password =  $("#password").val();
      $.ajax({
        url : "process.php",
        method : "POST",
        data : {action : action, user_id : user_id, password : password},
        success : function (response) {
          if (response == "EMPLOYEE") {
            window.location.replace("account.php?q=0");
          } else if (response == "ADMIN") {
            window.location.replace("dash.php?q=0");
          } else if (response == "ADMIN TRAINING") {
            window.location.replace("training.php?q=0");
          } else {
            alert("INVALID CREDENTIALS!");
          }
        }
      });
    });
  });

</script>
