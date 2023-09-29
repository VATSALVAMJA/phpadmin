<?php
session_start();
include('connect.php');

$full_name = $_REQUEST['fullname'];
$contact_us = $_REQUEST['contact_us'];
$skill = $_REQUEST['skill'];

// var_dump($_REQUEST);exit;

if ($full_name == '') {
	header('Location:profile.php?msg=Full Name is required.!');
} else if ($contact_us == '') {
	header('Location:profile.php?msg=Contact Us is required.!');
} else if ($skill == '') {
	header('Location:profile.php?msg=Skill is required.!');
}
else if(strlen($contact_us) != 10) {
	header('Location:profile.php?msg=Phone should be 10 digit.!');
} else {

	// code to save data in database table
	$sql = "UPDATE users SET full_name='$full_name', contact_us = '$contact_us', skill = '$skill' WHERE id='" . $_SESSION['userId'] . "'";
	if ($conn->query($sql) === TRUE) {
		header('Location:profile.php?msg=Profile Updated Successfully.!');
	} else {
		header('Location:profile.php?msg=Error in Profile Updation.!');
	}

}