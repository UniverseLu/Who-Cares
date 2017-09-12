<?php

$valid=false;
$connection = oci_connect($username = 'my1',
                          $password = 'My4114510',
                          $connection_string = '//oracle.cise.ufl.edu/orcl');

if (!$connection) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
//else { echo "Successful connection";}

$valid =true;

$user = $_POST['username'];
$pass = $_POST['pwd'];
$pass1 = $_POST['pwd2'];
$email = $_POST['email'];
$phnum = $_POST['phnum'];
$street = $_POST['addr'];
$state = $_POST['states'];
$city = $_POST['city'];


$zip = $_POST['zip'];

$fname = $_POST['fname'];
$lname = $_POST['lname'];

$url_prefix = "https://maps.googleapis.com/maps/api/geocode/xml?address=";
$address =urlencode ( str_replace(' ','+',$street).'+,'.str_replace(' ','+',$city).'+,'.$state);
$api_key = "&key=AIzaSyCu4osXRbVK0yOZDZzLGab5RT4Li4JK3Wo";
$google_api_url = $url_prefix.$address.$api_key;
$str = file_get_contents($google_api_url);
#echo $str;
$xml = simplexml_load_string($str);

#print_r($xml);
$lat = floatval ($xml->result->geometry->location->lat);
$long = floatval ($xml->result->geometry->location->lng);

//$date = $_POST['DOB'];
//$gen = $_POST['gender'];
////put default unknown user pic path in image url initially
//$iurl = 'images/pic.jpg';
//$level = 'Gourmet';
//date_default_timezone_set('America/New_York');
//$usersince = date('d-M-y');
//echo $pass ." ". $fname ." ". $lname ." ". $iurl ." ". $street ." ". $zip ." ". $user ." ". $gen ." ". $date ." ". $level ." ". $usersince ." ". $city ." ". $state;
//if(empty($user) || empty($fname) || empty($lname) ||empty($pass) || empty($city) || empty($state)){ echo "<script type='text/javascript'>alert('Enter required fields(Email-ID, Password, First name, Last name, City, State)')</script>";; $valid = false;}
//if($user != $user1) {echo "<script type='text/javascript'>alert('Email IDs do not match')</script>"; $valid=false;}
if($pass != $pass1) {echo "<script type='text/javascript'>alert('Passwords do not match')</script>"; $valid=false;}
if($valid == true)
{	
	$sql1 = "SELECT USRNAME, COUNT(*) AS CNT FROM G14USERINFO where USRNAME = '$user' Group By USRNAME";
	$query1 = oci_parse($connection,$sql1);
	oci_define_by_name($query1, 'CNT',$cnt);
	oci_execute($query1);
	
	while ($row=oci_fetch_assoc($query1)) {
			//echo "qwe";
			//echo $cnt;
	}
	
	if(oci_num_rows($query1) > 0)
	{
		echo "<script type='text/javascript'>alert('The name is already registered')</script>";
	}
	else
	{			
		$sql="select MAX(USRID) AS useridm from G14USERINFO";
		$query = oci_parse($connection,$sql);
		oci_define_by_name($query, 'USERIDM',$cnt);
		
		oci_execute($query);
		while ($row=oci_fetch_assoc($query)) {
		    $useridm=$row['USERIDM'];
		}
		$useridm=$useridm+1;
//		$sql="Insert into G14USERINFO values('$useridm','$pass','$fname','$lname','$iurl','$street','$zip','$user','$gen','$date','$level','$usersince','$city','$state')";
		$sql="Insert into G14USERINFO values('$useridm','c','$user','$pass','$email','$phnum','$street','$city','$state','$zip','$lat','$long')";
		$query = oci_parse($connection,$sql);
		oci_execute($query);

		$sql2="Insert into G14CUSTOMER values('$useridm','$lname','$fname')";
		$query2 = oci_parse($connection,$sql2);
		oci_execute($query2);
					
		if(!$query)
		{
		  echo "Failed ".oci_error();
		}
		else
		{
		  //echo "Successful";
	  	  //set cookie with userid, userid is unique
		  //Done, commenting it out for time being
		  //setcookie("user",$useridm, time()+3600);
		  echo "<script type='text/javascript'>alert('You have successfully signed up!!! You may login using your credentials now.')</script>";
			echo "<script type='text/javascript'>window.location.replace('LogInIndex.html');</script>";
		  
		}
		oci_free_statement($query);
	}
	oci_free_statement($query1);
}
echo "<script type='text/javascript'>window.location.replace('signin.html');</script>";
oci_close($connection);
?>