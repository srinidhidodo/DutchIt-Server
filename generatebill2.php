<?php
	extract($_GET);
	//Get req has table number: $tnum
	
	$dbname="Init";
	$conn = new mysqli("127.0.0.1","root","");
	$db=mysqli_select_db($conn,$dbname);
	$qry="select * from orders2 where tablenum=$tnum;";
	$sql=$conn->query($qry);
	
	$returnarr=array();
	$track=array();
	$returnarr['billamt']=0;
	$returnarr['pids']=array();
	
	while($row = mysqli_fetch_array($sql))
	{
		//echo "<br /><br />";
		$t=$row['patronid'];
		$t2=$row['itemid'];
		
		$priceqry="select * from items where itemid=$t2;";
		$pricesql=$conn->query($priceqry);
		$pricerow = mysqli_fetch_array($pricesql);
		
		$price=$row['price'];
		$prodname=$pricerow['itemname'];
		
		//echo "array_key_exists($t,$returnarr)";
		if (!array_key_exists("$t",$returnarr['pids']))
		{
			$returnarr['pids'][$t]=array();
			$returnarr['pids'][$t]['items']=array();
			$returnarr['pids'][$t]['total']=0;
			//echo "$t pid added: ".json_encode($returnarr)." <br />";
		}
		if (!array_key_exists("$t2",$returnarr['pids'][$t]))
		{
			$returnarr['pids'][$t]['items'][$t2]=array();
			$returnarr['pids'][$t]['items'][$t2]['qty']=$row['qty'];
			$returnarr['pids'][$t]['items'][$t2]['pricePerItem']=$price;
			$returnarr['pids'][$t]['items'][$t2]['itemname']=$prodname;
			$returnarr['pids'][$t]['items'][$t2]['price']=$price*$row['qty'];
			$returnarr['pids'][$t]['items'][$t2]['shared']=$row['splitwith'];
			$returnarr['pids'][$t]['total']+=$price*$row['qty'];
			$returnarr['billamt']+=$price*$row['qty'];
			//echo "$t2 item to $t added: ".json_encode($returnarr)." <br />";
		}
		else
		{
			$returnarr[$t]['items'][$t2]['qty']+=$row['qty'];
			$returnarr[$t]['items'][$t2]['price']+=$price*$row['qty'];
			$returnarr[$t]['total']+=$price*$row['qty'];
			$returnarr['billamt']+=$price*$row['qty'];
			//echo "$t2 existing item to $t added: ".json_encode($returnarr)." <br />";
		}
	}
	echo json_encode($returnarr);
	
	
	
?>