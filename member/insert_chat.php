<?php
session_start();
include('../function.php');

if(!isset($_SESSION['member_id'])){
	header("location:login.php");
}
$data = array(
 ':to_user_id'  => $_POST['to_user_id'],
 ':from_user_id'  => $_SESSION['member_id'],
 ':chat_message'  => $_POST['chat_message'],
 ':status'   => '1'
);

 $query = "INSERT INTO ".$db_suffix."chat_message (to_user_id, from_user_id, chat_message, status) VALUES (:to_user_id, :from_user_id, :chat_message, :status)";
$statement = $connect->prepare($query);

if($statement->execute($data)){
	echo fetch_user_chat_history($_SESSION['member_id'], $_POST['to_user_id'], $connect);
}
?>
