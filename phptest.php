<?php

$con=mysqli_connect("localhost","root","apmsetup","test");

if (mysqli_connect_errno($con))
{
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

mysqli_set_charset($con,"utf-8");


$res = mysqli_query($con,"select * from member");

$result = array();

while($row = mysqli_fetch_array($res)){
  array_push($result,
    array('id'=>$row[0],'pass'=>$row[1],'name'=>$row[2],'nick'=>$row[3],
	'hp'=>$row[4],'email'=>$row[5],'regist_day'=>$row[6],'level'=>$row[7]
    ));
}

echo json_encode(array("result"=>$result));

mysqli_close($con);

?>