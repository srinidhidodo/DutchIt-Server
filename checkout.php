<?php
	extract($_GET);
	//Extracting tnum and pid, so each person can pay one by one
	//When all patrons at a table have paid, records for that table's orders are deleted
	
	$dbname="Init";
	$conn = new mysqli("127.0.0.1","root","");
	$db=mysqli_select_db($conn,$dbname);
	$qry="update orders2 set paid=1 where patronid=$pid and tablenum=$tnum;";
	$sql=$conn->query($qry);
	
	$qry="select count(*) as count from orders2 where tablenum=$tnum and paid=0;";
	$sql=$conn->query($qry);
	$row = mysqli_fetch_assoc($sql);
	echo "Success";
	if ($row['count']==0)
	{
		$qry="delete from orders2 where tablenum=$tnum;";
		$sql=$conn->query($qry);
		$qry="delete from patrons where tablenum=$tnum;";
		$sql=$conn->query($qry);
		echo "Table data deleted";
	}
	
?>