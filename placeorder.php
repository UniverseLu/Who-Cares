<?php
/**
 * Created by PhpStorm.
 * User: qw
 * Date: 4/15/2016
 * Time: 7:37 PM
 */

$orderid= $_GET['orderid'];



$connection = oci_connect($username = 'my1',
    $password = 'My4114510',
    $connection_string = '//oracle.cise.ufl.edu/orcl');

if (!$connection) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}


$sql="INSERT INTO G14ORDER SELECT * FROM G14CART WHERE ORDERID=$orderid";
$query = oci_parse($connection,$sql);
oci_execute($query);


$sql2="DELETE from G14CART WHERE ORDERID=$orderid";
$query2 = oci_parse($connection,$sql2);
oci_execute($query2);

?>