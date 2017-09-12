<?php
/**
 * Created by PhpStorm.
 * User: qw
 * Date: 4/15/2016
 * Time: 8:45 PM
 */
session_start();
$userid=$_SESSION['userid'];

$connection = oci_connect($username = 'my1',
    $password = 'My4114510',
    $connection_string = '//oracle.cise.ufl.edu/orcl');

if (!$connection) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$sql3="select MAX(ORDERID) AS useridm from G14CART";
$query3 = oci_parse($connection,$sql3);
oci_define_by_name($query3, 'USERIDM',$cnt);

oci_execute($query3);


$sqlOrder = "SELECT * FROM G14CART WHERE CUSTID='$userid' ";
$query = oci_parse($connection,$sqlOrder);
oci_execute($query);

$nrows=oci_fetch_all($query,$res);

for($i=0; $i <= $nrows-1; $i++) {
    $userID = $res['CUSTID'][$i];
    $orderID = $res['ORDERID'][$i];
    $bussID = $res['BUSSID'][$i];
    $dishID = $res['DISHID'][$i];
    $DishQuantity = $res['DISHQUANTITY'][$i];
    $Status = $res['STATUS'][$i];
    $orderTime = $res['ORDERTIME'][$i];
    $DliveryTime = $res['DELIVERYTIME'][$i];
    $DeliveryMethod = $res['DELIVERYMETHOD'][$i];
    $Rating = $res['RATING'][$i];
    $Price = $res['PRICE'][$i];

    $sqlOrder = "SELECT ITEMNAME FROM G14CART c,G14RESTAURANT r,G14MENU m WHERE $bussID=r.usrid and r.brandid=m.brandid and m.itemid=c.dishid ";
    $query = oci_parse($connection,$sqlOrder);
    oci_define_by_name($query, 'ITEMNAME',$ITEMNAME);
    oci_execute($query);
    oci_fetch($query);

    echo"  itemname: ".$ITEMNAME;
    echo"  quantity: ".$DishQuantity;
    echo"  price: ".$Price;
}


//$sql="SELECT * FROM G14CART WHERE CUSTID=$userid";
//$query = oci_parse($connection,$sql);
//oci_execute($query);
//
//
//$sql2="DELETE from G14CART WHERE ORDERID=$orderid";
//$query2 = oci_parse($connection,$sql2);
//oci_execute($query2);

?>