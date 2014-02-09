<?php
function connectToDB() {
	$dbc = mysqli_connect("192.186.210.36", "basketsAdmin", "ble11ach23", "baskets");
	
	// Check connection
	if (mysqli_connect_errno()){
  		echo "Our Database Seems to be down, be back in a bit".mysqli_connect_error();
  	}
	return($dbc);
}

function disconnectDB($result, $dbc) {
	mysqli_free_result($result);
	mysqli_close($dbc);
}

function fix_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>