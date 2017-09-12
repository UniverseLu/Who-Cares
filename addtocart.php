<?php
/**
 * Created by PhpStorm.
 * User: minyang
 * Date: 4/9/2016
 * Time: 9:51 PM
 */
session_start();
//if (isset($_POST['color'][0])) {
//
//    $itemid=$_POST['color'][0];
//}
//echo $itemid;


$brandID= $_POST['brandID'];
echo '<br/>';
$bussID= $_POST['bussID'];
echo '<br/>';
$orderid= $_POST['orderid'];
echo '<br/>';
$connection = oci_connect($username = 'my1',
    $password = 'My4114510',
    $connection_string = '//oracle.cise.ufl.edu/orcl');

if (!$connection) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

date_default_timezone_set('america/new_york');
$ordertime= date('d/m/Y H:i:s');
//echo $ordertime;
//echo $orderid;

//$i=0;
//
//while((isset($_POST['color'][$i]))){
//    echo $_POST['color'][$i];
//    echo '<br/>';
//    $i++;
//}
//echo '<br/>';
//echo "total number";
//echo $i;
//echo '<br/>';

$userid=$_SESSION['userid'];
$i=0;
$k=0;
$array = array();
while((isset($_POST['qua'][$i]))){



    if ($_POST['qua'][$i]!=null)
    {
        $qua=$_POST['qua'][$i];
        $array[]=$qua;
        $k++;
    }
    $i++;
}
//print_r($array);
//echo $k;


$i=0;
$tprice=0;

while((isset($_POST['color'][$i]))){

    $itemid=$_POST['color'][$i];
//    echo $itemid;
//    echo '<br/>';
//    var_dump($itemid);
//    echo $itemid;
//    echo $i;
//    echo '<<<colori';
//    $qua=$_POST['qua'][$i];
//    $qua=$_POST['qua'];
//    echo $qua;
//    $qua=$_POST['qua'][$i];

    $sql2="select ITEMPRICE,ITEMNAME from g14menu where brandid=$brandID and itemid=$itemid";
    $query2 = oci_parse($connection,$sql2);
    oci_define_by_name($query2, 'ITEMPRICE',$ITEMPRICE);
    oci_define_by_name($query2, 'ITEMNAME',$ITEMNAME);
    oci_execute($query2);
    $row=oci_fetch_assoc($query2);

    $tprice=$tprice+$array[$i]*$ITEMPRICE;
    echo "numer:".($i+1);
    echo " |";
    echo "itemname:".$ITEMNAME;
    echo " |";
    echo "quantity".$array[$i];
    echo " |";
    echo "price".$ITEMPRICE;
    echo " |";
    echo"<br />";

    $sql="INSERT INTO G14CART VALUES( '$orderid', $userid, $bussID, '$itemid', $array[$i], 'p',to_date('$ordertime','DD/MM/YYYY HH24:MI:SS'), null, 'd',null,$array[$i]*$ITEMPRICE)";
//    echo  $sql;
    $query = oci_parse($connection,$sql);
    oci_execute($query);
    $i++;
}


    echo"total price is". $tprice;

echo"<a href='placeorder.php?orderid=$orderid  '> place order</a>";

//<a href='index.php?&RATE=1'>place order</a></label>

//echo "you success place order";
//echo '<br/>';
//echo "total number";
//echo $i;
//echo '<br/>';
//
//
//
//for($j=0; $j <= $i; $j++) {
//    $sql="INSERT INTO G14ORDER VALUES( '$orderid', 888888, $bussID, '$dishid', 1, 'p','$ordertime', null, 'd',null, 62.45);";
//    $query = oci_parse($connection,$sql);
//    oci_execute($query);
//
//}

//$i=0;
//
////$postvalue=array("a","b","c");
////var_dump($postvalue);
//
//while((isset($_POST['color'][$i]))) {
////    $a=($_POST['color'][$i]) ;
//    var_dump($_POST['color'][$i]);
//    $postvalue =print_r($_POST['color'][$i],true);
////    echo array_values($a)[2];
////    echo $results;
////    var_dump($postvalue);
////    foreach($postvalue as $value)
////    {
////        echo $value;
////    }
//    $i++;
//}
//$i=0;
//while((isset($_POST['color'][$i]))) {
//    var_dump($_POST['color'][$i]);
////    echo array_values($_POST['color'][$i])[0];
//
//    $i++;
//}
//
////var_dump($_POST['color'][0]);
////var_dump($_POST['color'][1]);



?>