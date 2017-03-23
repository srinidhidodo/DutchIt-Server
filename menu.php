<?php
	include "ip.php";
	extract($_GET);
	//Get req has table number: $tnum
	
	$dbname="Init";
	$conn = new mysqli("127.0.0.1","root","");
	$db=mysqli_select_db($conn,$dbname);
	$qry="select count(*) as count from patrons where tablenum=$tnum;";
	$sql=$conn->query($qry);
	
	$row = mysqli_fetch_assoc($sql);
	$allotted=$row['count']+1;
	$returnarr=array();
	
	$x1="http://".$ip."/Init/welcome2.html";
	$x2="http://".$ip."/Init/generatebill2.php";
	$x3="http://".$ip."/Init/checkout.php";
	$x4="http://".$ip."/Init/bill.html";
	
	$returnarr['PID']=$allotted;
	$returnarr['menu_url']=$x1;
	$returnarr['bill_url']=$x2;
	$returnarr['checkout']=$x3;
	$returnarr['final_bill']=$x4;
	
	$qry="insert into patrons values($tnum,$allotted);";
	$sql=$conn->query($qry);
	
	
	echo json_encode($returnarr);
	
?>