<?php
	extract($_GET);
	//Get req has table number: $tnum
	
	$dbname="Init";
	$conn = new mysqli("127.0.0.1","root","");
	$db=mysqli_select_db($conn,$dbname);
	$qry="select count(*) as count from orders2;";
	$sql=$conn->query($qry);
	$row = mysqli_fetch_assoc($sql);
	
	//Getting order number
	if ($row['count']==0)
		$onum=1;
	else
	{
		$qry="select max(ordernum) as max from orders2;";
		$sql=$conn->query($qry);
		$row = mysqli_fetch_assoc($sql);
		$onum=$row['max']+1;
	}
	$trav=array_slice($_GET,2);
	//echo json_encode($_GET);
	
	foreach ($trav as $k=>$v)
	{
		$share=array();
		if (strpos($v,',')) //("," in $v)
		{
			$share=explode(",",$v);
			//echo "$share[0] $share[1] $share[2]<br />";
		}
		else
		{
			$share[]=$v;
		}
		$sw=count($share);
		echo "$sw<br />";
		$tempj=1;
		$item=intval(substr($k,4));
		$qry="select price from items where itemid=$item;";
		$sql=$conn->query($qry);
		$row = mysqli_fetch_assoc($sql);
		$price=$row['price']/$sw;
		$qry="insert into orders2 values($onum,$tnum,$pid,$item,$share[0],0,$price,$sw);";
		echo "$qry <br />";
		$sql=$conn->query($qry);
		$onum+=1;
		while ($tempj<$sw)
		{
			$qry="insert into orders2 values($onum,$tnum,$share[$tempj],$item,$share[0],0,$price,$sw);";
			echo "$tempj!$qry <br />";
			$sql=$conn->query($qry);
			$onum+=1;
			$tempj+=1;
		}
		
	}
	
	//$qry="select count(*) as count from patrons where tablenum=$tnum;";
	//$sql=$conn->query($qry);
	
	
	
?>