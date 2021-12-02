<?php
session_start();

include "dbConnection.php";

if ($_POST['action'] == "login") {
	$user_id = $_POST['user_id'];
	$password = $_POST['password'];

	$user_id = stripslashes($user_id);
	$user_id = addslashes($user_id);
	$password = stripcslashes($password);
	$password = addslashes($password);

	$result = $con->query("SELECT * FROM tbl_accounts WHERE emp_id = '$user_id' AND password = '$password'");

	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		if ($row['account_type'] == 0) { //EMPLOYEE USER TYPE ACCOUNT
			$r2 = $con->query("SELECT * FROM tbl_users WHERE emp_id = '$user_id'");
			$row = $r2->fetch_assoc();
			$_SESSION['firstname'] = $row['first_name'];
			$_SESSION['emp_id'] = $row['emp_id'];
			$_SESSION['account_type'] = 0;
			$_SESSION['logged'] = 1;
			echo "EMPLOYEE";
		} elseif ($row['account_type'] == 1) { //USER ADMIN
			$_SESSION['firstname'] = "Administrator <emp style='color: rgb(0, 187, 47)'>(Users)</emp>";
			$_SESSION['emp_id'] = "admin";
			$_SESSION['account_type'] = 1;
			$_SESSION['logged'] = 1;
			echo "ADMIN";
		} elseif ($row['account_type'] == 2) { //EXAMINATION ADMIN
			$_SESSION['firstname'] = "Administrator <emp style='color: rgb(0, 187, 47)'>(Exam)</emp>";
			$_SESSION['emp_id'] = "admin";
			$_SESSION['account_type'] = 2;
			$_SESSION['logged'] = 1;
			echo "ADMIN";
		} elseif ($row['account_type'] == 3) { //OVERALL ADMIN
			$_SESSION['firstname'] = "Administrator <emp style='color: rgb(0, 187, 47)'>(All)</emp>";
			$_SESSION['emp_id'] = "admin";
			$_SESSION['account_type'] = 3;
			$_SESSION['logged'] = 1;
			echo "ADMIN";
		} else {
			$_SESSION['firstname'] = "Administrator <emp style='color: rgb(0, 187, 47)'>(Training)</emp>";
			$_SESSION['emp_id'] = "admin";
			$_SESSION['account_type'] = 4;
			$_SESSION['logged'] = 1;
			echo "ADMIN TRAINING";
		}
	} else {
		echo "ERROR";
	}
}

//ADD USER
if ($_POST['action'] == "Add User") {
	$user_empID = $_POST['user_empID'];
	$user_firstname = $_POST['user_firstname'];
	$user_lastname = $_POST['user_lastname'];
	$user_branch = $_POST['user_branch'];
	$user_position = $_POST['user_position'];
	$default_pass = "";  

	$result = $con->query("INSERT INTO tbl_users (emp_id, first_name, last_name, branch, emp_position)
		VALUES ('$user_empID', '$user_firstname', '$user_lastname', '$user_branch', '$user_position')");

	if ($result) {
		$default_pass = $user_lastname . $user_empID;
		$result = $con->query("INSERT INTO tbl_accounts (emp_id, password, account_type) VALUES ('$user_empID', '$default_pass', 0)");
		if ($result) {
			$_SESSION['alert_msg'] = '<div class="alert alert-success alert-dismissible fade in" style="width: 93%; margin: 0 auto; margin-bottom: -3.2%; margin-top: -1.2%">
                  <strong>Success!</strong> You have successfully registered a new user.
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>';
		} else {
			$_SESSION['alert_msg'] = '<div class="alert alert-danger alert-dismissible fade in" style="width: 93%; margin: 0 auto; margin-bottom: -3.2%; margin-top: -1.2%">
                  <strong>Error!</strong> Unable to add user, please contact the administrator.
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>';
		}
	} else {
		$_SESSION['alert_msg'] = '<div class="alert alert-danger alert-dismissible fade in" style="width: 93%; margin: 0 auto; margin-bottom: -3.2%; margin-top: -1.2%">
                  <strong>Error!</strong> Unable to add user, please contact the administrator.
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>';
	}
}

if (@$_GET['action'] == "delU") { //DELETE USER
	$emp_id = $_GET['empid'];
	$result = $con->query("DELETE FROM tbl_users WHERE emp_id = '$emp_id'");
	if ($result) {
		$con->query("DELETE FROM tbl_accounts WHERE emp_id = '$emp_id'");
		$_SESSION['alert_msg'] = '<div class="alert alert-success alert-dismissible fade in" style="width: 93%; margin: 0 auto; margin-bottom: -3.2%; margin-top: -1.2%">
                  <strong>Success!</strong> You have successfully deleted the user.
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>';
	} else {
		$_SESSION['alert_msg'] = '<div class="alert alert-danger alert-dismissible fade in" style="width: 93%; margin: 0 auto; margin-bottom: -3.2%; margin-top: -1.2%">
                  <strong>Error!</strong> Unable to delete user.
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>';
	}

	header("location: dash.php?q=1");
}

if ($_POST['action'] == "Add Exam") {
	$exam_code = $_POST['exam_code'];
	$exam_title = $_POST['exam_title'];
	$exam_schedule = $_POST['exam_schedule'];
	$exam_duration = $_POST['exam_duration'];

	$result = $con->query("INSERT INTO tbl_exams (exam_code, exam_title, exam_schedule, exam_duration, exam_status)
		VALUES ('$exam_code', '$exam_title', '$exam_schedule', '$exam_duration', 1)");

	if ($result) {
		$_SESSION['alert_msg'] = '<div class="alert alert-success alert-dismissible fade in" style="width: 93%; margin: 0 auto; margin-bottom: -3.2%; margin-top: -1.2%">
                  <strong>Success!</strong> You have successfully added a new examination.
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>';
	} else {
		$_SESSION['alert_msg'] = '<div class="alert alert-danger alert-dismissible fade in" style="width: 93%; margin: 0 auto; margin-bottom: -3.2%; margin-top: -1.2%">
                  <strong>Error!</strong> Unable to add new examination.
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>';
	}
}

if (@$_GET['action'] == 'del') { //DELETE EXAMS
	$exam_code = $_GET['examID'];
	$con->query("DELETE FROM tbl_exams WHERE exam_code = '$exam_code'");
	header("location:dash.php?q=2");
}

if (@$_GET['action'] == 'examStat') { //LOCK or UNLOCK EXAMS
	$exam_code = $_GET['eid'];
	$result = $con->query("SELECT * FROM tbl_exams WHERE exam_status = 1 AND exam_code = '$exam_code'");
	if ($result->num_rows == 1) {
		$con->query("UPDATE tbl_exams SET exam_status = 0 WHERE exam_code = '$exam_code'");
	} else {
		$con->query("UPDATE tbl_exams SET exam_status = 1 WHERE exam_code = '$exam_code'");
	}
	header("location:dash.php?q=2");
}

if ($_POST['action'] == "Add Question") {
	$exam_code = $_POST['exam_code'];
	$question = $_POST['question'];
	$option1 = $_POST['option1'];
	$option2 = $_POST['option2'];
	$option3 = $_POST['option3'];
	$option4 = $_POST['option4'];
	$answer = $_POST['answer'];
	$result = $con->query("INSERT INTO tbl_questions (exam_code, question, option1, option2, option3, option4, answer) 
		VALUES ('$exam_code', '$question', '$option1', '$option2', '$option3', '$option4', '$answer')");

	if ($result) {
		echo "SUCCESS";
	} else {
		echo "FAILED";
	}
}

if (@$_GET['action'] == "result") { //EXAMINATION RESULT
	$exam_code = $_GET['eid'];
	$emp_id = $_SESSION['emp_id'];

	$qry = "SELECT
			tbl_answers.ans_empID,
			tbl_answers.ans_qid.
			tbl_questions.q_id,
			tbl_questions.exam_code
		FROM
			tbl_answers,
			tbl_questions
		WHERE
			tbl_answers.ans_empID = '$emp_id' AND tbl_answers.ans_qid = tbl_questions.q_id AND tbl_questions.exam_code = '$exam_code'";

	$score_r = $con->query($qry);
	echo $score_r->num_rows;
}

if (@$_GET['action'] == "delQ") { //DELETE QUESTIONS
	$eid = $_GET['eid'];
	$qid = $_GET['qid'];
	$con->query("DELETE FROM tbl_questions WHERE q_id = '$qid'");
	header("location: view_exam.php?q=2&eid=" . $eid);
}

if (@$_GET['action'] == "remUser") { //REMOVE PARTICIPANTS IN THE EXAM
	$emp_id = $_GET['remID'];
	$exam_code = $_GET['eid'];
	$con->query("DELETE FROM tbl_examlogs WHERE log_empID = '$emp_id' AND log_examCode = '$exam_code'");
	header("location: participants.php?q=2&eid=" . $exam_code);
}

if ($_POST['action'] == "Search Employee") {
	$emp_id = $_POST['empID'];
	$result = $con->query("SELECT * FROM tbl_users WHERE emp_id = '$emp_id'");
	if ($result->num_rows >= 1) {
		$row = $result->fetch_assoc();
		$data['users'] = $row;
		$data['error'] = "";
	} else {
		$data['error'] = "Not Found!";
	}
	echo json_encode($data);
}

if ($_POST['action'] == "Add Participant") { //ADDING PARTICIPANT TO THE AVAILABLE EXAMS
	$emp_id = $_POST['empID'];
	$exam_code = $_POST['exam_code'];
	
	$result = $con->query("SELECT * FROM tbl_examlogs WHERE log_empID = '$emp_id' AND log_examCode = '$exam_code'");
	$query = "INSERT INTO tbl_examlogs (log_empID, log_examCode, log_examStatus) VALUES ('$emp_id', '$exam_code', 1)";
	if ($result->num_rows >= 1) {
		echo "EMPLOYEE ALREADY ADDED IN THE EXAMINATION!";
	} else {
		$con->query($query);
		echo "EMPLOYEE SUCCESSFULLY ADDED!";
	} 
}

if ($_POST['action'] == "get question") {
	$exam_code = $_POST['exam_code'];
	$emp_id = $_SESSION['emp_id'];

	if(!isset($_SESSION['exam'])) {
		$_SESSION['exam_stat'] = 1;
		$n = 1;
		$result = $con->query("SELECT * FROM tbl_questions WHERE exam_code = '$exam_code'") or die ('ERROR!');
		$_SESSION['t_question'] = $result->num_rows; //TOTAL NO. OF QUESTIONS
		$_SESSION['qno'] = 1;
		$_SESSION['exam_code'] = $exam_code;
		$dateTaken = date("Y-m-d");
		$_SESSION['exam'] = array();
		while ($row = $result->fetch_assoc()) {
	      $exam_details = array (
	        "qid" => $row['q_id'],
	        "question" => $row['question'],
	        "option1" => $row['option1'],
	        "option2" => $row['option2'],
	        "option3" => $row['option3'],
	        "option4" => $row['option4'],
	      	"answer" =>$row['answer']);
	      $_SESSION['exam'][$n] = $exam_details;
	      $n++;
	    }
	    $con->query("UPDATE tbl_examlogs SET log_examStatus = 0, log_dateTaken = '$dateTaken' WHERE log_empID = '$emp_id' AND log_examCode = '$exam_code'");
	} else {
		getQuestion();
	}
}

if ($_POST['action'] == "check answer") {
	$emp_id = $_SESSION['emp_id'];
	$qid = $_POST['qid'];
	$exam_code = $_POST['exam_code'];

	$r1 = $con->query("SELECT * FROM tbl_answers WHERE ans_qid = '$qid' AND ans_empID = '$emp_id'");
	$r2 = $con->query("SELECT * FROM tbl_questions WHERE q_id = '$qid'") or die ("ERROR!");

	if ($_POST['qry'] == "next") {
		$_SESSION['qno']++;
		$selected = $_POST['selected'];
		$action = "next";

		if ($r1->num_rows == 0) {
			$row = $r2->fetch_assoc();
			if (strtoupper($row['answer']) == strtoupper($selected)) {
				$remark = 1;
			} else {
				$remark = 0;
			}
			$con->query("INSERT INTO tbl_answers (ans_empID, ans_examCode, ans_qid, ans_selected, ans_remark)
				VALUES ('$emp_id', '$exam_code', '$qid', '$selected', $remark)");
		} else {
			$row = $r2->fetch_assoc();
			if (strtoupper($row['answer']) == strtoupper($selected)) {
				$remark = 1;
			} else {
				$remark = 0;
			}
			$con->query("UPDATE tbl_answers SET ans_selected = '$selected', ans_remark = '$remark' WHERE ans_qid = '$qid' AND ans_empID = '$emp_id'");
		}
	} else {
		$_SESSION['qno']--;
		$action = "prev";
	}

	getQuestion($emp_id, $exam_code, $action);
}

function getQuestion($emp_id, $exam_code, $action) {
	include "dbConnection.php";
	$emp_id = $_SESSION['emp_id'];

	if ($_SESSION['qno'] < 1) {
		$_SESSION['qno'] = 1;
	}

	if ($_SESSION['qno'] > $_SESSION['t_question']) {
		echo 'DONE';
		unset($_SESSION['qno']);
		unset($_SESSION['exam_stat']);
		unset($_SESSION['exam']);
		$t_score = $con->query("SELECT * FROM tbl_answers WHERE ans_empID = '$emp_id' AND ans_examCode = '$exam_code' AND ans_remark = 1")->num_rows;
		$con->query("UPDATE tbl_examlogs SET log_score = $t_score WHERE log_empID = '$emp_id' AND log_examCode = '$exam_code'") or die ("ERROR!");
	} else {
		echo '<div class="panel">';
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
		echo '</div>';
	}
}

if ($_POST['action'] == "Upload Video") { //UPLOADING VIDEOS
	if (0 < $_FILES['file']['error']) {
		echo 'Error: ' . $_FILES['file']['error'] . '<br>';
	} else {
		move_uploaded_file($_FILES['file']['tmp_name'], 'resources/uploads/videos/' . $_FILES['file']['name']);
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

?>