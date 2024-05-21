<?php 
$position = $_POST['position'];
$i=1;
foreach($position as $k=>$v)
{
    $update 	    = mysqli_query($con,"UPDATE admin SET sortid='$i',update_date='$now' WHERE id='$v'")or die('ERROR: '. mysqli_error($con));
	$i++;
}
?>