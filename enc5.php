<?php
$conn=mysqli_connect("localhost","pi","rt","mydb");

$result=mysqli_query($conn,"SELECT * FROM encoder");

$data=array();
while($row=mysqli_fetch_assoc($result))
{
	$data[]=$row;
}

echo json_encode($data);
