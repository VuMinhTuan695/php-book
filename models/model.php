<?php
require_once("../db/connectdb.php") ;

function getAll($table, $limit = 10, $start = 0){
	$sql = "SELECT * FROM $table ORDER BY id DESC LIMIT $start, $limit";
	$conn = connectdb();
	$rs = mysqli_query($conn, $sql);
	if(mysqli_num_rows($rs) > 0) {
		return mysqli_fetch_assoc($rs);
	}
	return null;
}

function getProductByParam($table, $param){
	$sql = "SELECT * FROM $table WHERE name LIKE '%$param%' OR author LIKE '%$param%' OR publisher LIKE '%$param%' OR supplier LIKE '%$param%'";
	$conn = connectdb();
	$rs = mysqli_query($conn, $sql);
	$listData = array();
	if(mysqli_num_rows($rs) > 0) {
		while ($row = $rs->fetch_assoc()) {
			array_push($listData, $row);
		}
		return $listData;
	}
	return null;
}

function getById($table, $id){
	$sql = "SELECT * FROM $table WHERE id = $id";
	$conn = connectdb();
	$rs = mysqli_query($conn, $sql);
	if(mysqli_num_rows($rs) > 0) {
		return mysqli_fetch_array($rs);
	}
	return null;
}

function getByUsername($table, $username){
	$conn = connectdb();
	$sql = "SELECT * FROM $table WHERE username = '$username'";
	$rs = mysqli_query($conn, $sql);
	if(mysqli_num_rows($rs) > 0) {
		return mysqli_fetch_array($rs);
	}
	return null;
}

function getAccount($table, $username, $password){
	$conn = connectdb();
	$sql = "SELECT * FROM $table WHERE username = '$username' && password = '$password'";
	$rs = mysqli_query($conn, $sql);
	if(mysqli_num_rows($rs) > 0) {
		return mysqli_fetch_array($rs);
	}
	return null;
}
//thêm sản phẩm
function insert($table, $data){
	$conn = connectdb();
	$fields = implode(',', array_keys($data));
	$values = implode("','", $data);
	$values= "'".$values;
	$values.="'";
	$sql = "INSERT INTO {$table} ({$fields}) VALUES ({$values})";
	return mysqli_query($conn, $sql);
}
//..............
function update($table, $data){
	$conn = connectdb();
	$sql = "UPDATE $table SET ";
	$id = $data["id"];
	foreach($data as $field => $value){
		$sql.=" $field = '$value',";
	}
	$sql[strlen($sql)-1] =" ";
	$sql.=" WHERE id = $id";
	return mysqli_query($conn, $sql);
}

function updateAccount($table, $username, $newpassword){
	$conn = connectdb();
	$sql = "UPDATE $table SET password = '$newpassword' WHERE username = '$username'";
	return mysqli_query($conn, $sql);
}

function updateUserInfor($table, $username, $fullname, $phonenumber, $address){
	$conn = connectdb();
	$sql = "UPDATE $table SET fullname = '$fullname',phonenumber = '$phonenumber', address = '$address' WHERE username = '$username'";
	return mysqli_query($conn, $sql);
}

function delete($table, $id){
	$conn = connectdb();
	$sql = "DELETE FROM $table WHERE id = $id";
	return mysqli_query($conn, $sql);
}

function exe_query($sql){
	$conn = connectdb();
	return mysqli_query($conn, $sql);
}
?>