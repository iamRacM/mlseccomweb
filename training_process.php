<?php
session_start();
include_once 'dbConnection.php';
	
if (@$_GET['q'] == "delete") {
	$trn_id = @$_GET['trnid'];
	$result = $con->query("DELETE FROM tbl_trainings WHERE trn_id = '$trn_id'");
	if ($result) {
		$_SESSION['alert_msg'] = '<div class="alert alert-success alert-dismissible fade in" style="width: 93%; margin: 0 auto; margin-bottom: -3.2%; margin-top: 1.2%">
                  <strong>Success!</strong> You have successfully deleted the schedule.
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>';
	} else {
		$_SESSION['alert_msg'] = '<div class="alert alert-success alert-dismissible fade in" style="width: 93%; margin: 0 auto; margin-bottom: -3.2%; margin-top: 1.2%">
                  <strong>Error!</strong> Unable to complete the process. Please try again!
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>';
	}
	header("location: training.php?q=1");
}

if ($_POST['action'] == "Training Schedule") {
	$trainingDate = $_POST['trainingDate'];
	$trainingTitle = $_POST['trainingTitle'];

	$result = $con->query("INSERT INTO tbl_trainings (trn_schedule, trn_title) VALUES ('$trainingDate', '$trainingTitle')") or die ("Error!");

	if ($result) {
		$_SESSION['alert_msg'] = '<div class="alert alert-success alert-dismissible fade in" style="width: 93%; margin: 0 auto; margin-bottom: -3%; margin-top: 1.2%">
                  <strong>Success!</strong> You have successfully created a new schedule.
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>';
	} else {
		$_SESSION['alert_msg'] = '<div class="alert alert-danger alert-dismissible fade in" style="width: 93%; margin: 0 auto; margin-bottom: -3%; margin-top: 1.2%">
                  <strong>Error!</strong> Unable to add schedule, please contact the administrator.
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>';
	}
}

if ($_POST['action'] == "Add Participant") { //ADDING PARTICIPANT TO THE AVAILABLE EXAMS
	$emp_id = $_POST['empID'];
	$trnID = $_POST['trnID'];
	
	$result = $con->query("SELECT * FROM tbl_trnlogs WHERE log_empID = '$emp_id' AND log_trnID = '$trnID'");
	$query = "INSERT INTO tbl_trnlogs (log_empID, log_trnID) VALUES ('$emp_id', '$trnID')";
	if ($result->num_rows >= 1) {
		echo "EMPLOYEE ALREADY ADDED IN THE TRAINING!";
	} else {
		$con->query($query);
		echo "EMPLOYEE SUCCESSFULLY ADDED!";
	} 
}

if ($_POST['action'] == "Update Training") {
	$trn_id = $_POST['trnID'];
	$result = $con->query("SELECT * FROM tbl_trainings WHERE trn_id = '$trn_id'");
	if ($result->num_rows >= 1) {
		$row = $result->fetch_assoc();
		$data['training_details'] = $row;
		$data['error'] = "";
	} else {
		$data['error'] = "Error!";
	}
	echo json_encode($data);
}

if ($_POST['action'] == "Submit Update Training") {
	$trn_id = $_POST['trn_id'];
	$trn_title = $_POST['trn_title'];
	$trn_schedule = $_POST['trn_schedule'];
	
	$result = $con->query("UPDATE tbl_trainings SET trn_schedule = '$trn_schedule', trn_title = '$trn_title' WHERE trn_id = '$trn_id'");

	if ($result) {
		$_SESSION['alert_msg'] = '<div class="alert alert-success alert-dismissible fade in" style="width: 93%; margin: 0 auto; margin-bottom: -3.2%;">
                  <strong>Success!</strong> You have successfully updated the record.
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>';
	} else {
		$_SESSION['alert_msg'] = '<div class="alert alert-danger alert-dismissible fade in" style="width: 93%; margin: 0 auto; margin-bottom: -3.2%;">
                  <strong>Error!</strong> Unable to update record, please contact the administrator.
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>';
	}
}

?>