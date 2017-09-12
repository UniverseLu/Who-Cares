<?php


$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

$connection = oci_connect("my1","My4114510" , "//oracle.cise.ufl.edu/orcl");
if (!$connection){
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
// store the brandid's name
$brandname_array = array();
$sql_str = "SELECT * FROM G14BRANDNAME";
$stid = oci_parse($connection, $sql_str);
$r = oci_execute($stid);
if(!$r){
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'], ENT_QUOTES),E_USER_ERROR);
}
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    $brandname_array[$row['BRANDID']]=$row['BRANDNAME'];
}
oci_free_statement($stid);

// prepare the statement
$sql_str = "SELECT UR_INFO.USRID URID, BRANDID, OPENTIME, CLOSETIME, DELIVERY_DIST,
              PHONENUM, ADDRESS, CITY, STATE, ZIPCODE, LAT, LON
              FROM G14USERINFO UR_INFO, G14RESTAURANT RST WHERE UR_INFO.USRID = RST.USRID and UR_INFO.USRID <= 10";
$stid = oci_parse($connection, $sql_str);
//perform the logic of the query
$r = oci_execute($stid);
if(!$r){
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'], ENT_QUOTES),E_USER_ERROR);
}
//fetch the results of the query
header("Content-type: text/xml");
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    //print_r ($row);
    $node = $dom->createElement("marker");
    $newnode = $parnode->appendChild($node);
    //$newnode->setAttribute("name", $brandname_array[$row['UR']]);
    $newnode->setAttribute("name", $brandname_array[$row['BRANDID']]);
    $newnode->setAttribute("opentime", $row['OPENTIME']);
    $newnode->setAttribute("closetime", $row['CLOSETIME']);
    $newnode->setAttribute("delivery_distance", $row['DELIVERY_DIST']);
    $newnode->setAttribute("phone_number", $row['PHONENUM']);
    $newnode->setAttribute("address", $row['ADDRESS']);
    $newnode->setAttribute("lat", $row['LAT']);
    $newnode->setAttribute("lng", $row['LON']);
    //$newnode->setAttribute("type", "bar");
    //$newnode->setAttribute("brand", $brandname_array[$row['BRANDID']]);
}
oci_free_statement($stid);
oci_close($connection);
echo $dom->saveXML();
?>