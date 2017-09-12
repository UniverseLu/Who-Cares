<!DOCTYPE html>
<?php
session_start();

//if(!isset($_SESSION['username'])){
//    echo "<script type='text/javascript'>alert('You must login in first!')</script>";
////setcookie("user",$id, time()+3600);
//    echo "<script type='text/javascript'>window.location.replace('index.html');</script>";
//}
//?>
<HTML>
<!--==============================head=================================-->
<HEAD>
    <TITLE>MyPage</TITLE>
    <link rel="stylesheet" type="text/css" href="mycart.css">
    <style TYPE="text/css">
        body {
            font-family:Arial, Helvetica, sans-serif;
            background-color: white;
            background-repeat: repeat;
            margin:  0 0 0 0;
            color:black;
        }
    </style>
</HEAD>
<BODY>
<div id="content" style="float: left">
    <?php


    $brandID= $_GET['brandID'];
    $bussID= $_GET['bussID'];
    $orderid= $_GET['orderid'];
    
    $connection = oci_connect($username = 'my1',
    $password = 'My4114510',
    $connection_string = '//oracle.cise.ufl.edu/orcl');

    echo"<div id = 'fixinfo' style='margin-top: 10px;margin-bottom: 10px'><span style='margin:5px;' >My Cart</span></div>";

    echo"<div id='orderdetail'>
        <form id=info action='placeorder.php?orderid=$orderid' method='get'>
            <table class='tg'>";
    echo"  <tr>
                    <td class='tg-mme0'>No.</td>
                    <td class='tg-mme0'>DISH</td>
                    <td class='tg-mme0'>PRICE</td>
                    <td class='tg-mme0'>QTY</td>
                </tr>";

    if (!$connection) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    date_default_timezone_set('america/new_york');
    $ordertime= date('d/m/Y H:i:s');


    $userid=$_SESSION['userid'];
    $i=0;
    $k=0;
    $array = array();
    while((isset($_GET['qua'][$i]))){

    if ($_GET['qua'][$i]!=null)
    {
    $qua=$_GET['qua'][$i];
    $array[]=$qua;
    $k++;
    }
    $i++;
    }

    $i=0;
    $tprice=0;

    while((isset($_GET['color'][$i]))){

    $itemid=$_GET['color'][$i];

    $sql2="select ITEMPRICE,ITEMNAME from g14menu where brandid=$brandID and itemid=$itemid";
    $query2 = oci_parse($connection,$sql2);
    oci_define_by_name($query2, 'ITEMPRICE',$ITEMPRICE);
    oci_define_by_name($query2, 'ITEMNAME',$ITEMNAME);
    oci_execute($query2);
    $row=oci_fetch_assoc($query2);

    $tprice=$tprice+$array[$i]*$ITEMPRICE;
        echo"<tr> <td class='tg-175l'>".($i+1)."</td>";
        echo"<td class='tg-175l'>".$ITEMNAME."</td>";
        echo"<td class='tg-175l'>$".$ITEMPRICE."</td>";
        echo"<td class='tg-175l' style='padding-left: 15px'>".$array[$i]."</td></tr>";

    $sql="INSERT INTO G14CART VALUES( '$orderid', $userid, $bussID, '$itemid', $array[$i], 'p',to_date('$ordertime','DD/MM/YYYY HH24:MI:SS'), null, 'd',null,$array[$i]*$ITEMPRICE)";
    //    echo  $sql;
    $query = oci_parse($connection,$sql);
    oci_execute($query);
    $i++;
    }

    echo"  <tr>
                  <td class='tg-71kt' ></td>
                  <td class='tg-71kt' style='text-align: right'>TOTAL:</td>
                  <td class='tg-71kt' >$".$tprice."</td>
                  <td class='tg-rb70' ></td></tr></table>";
    echo"
        <input onclick='window.location=' class=update type='submit' value='Place Order' />
    </form>
</div>";

    ?>
</div>

</BODY>

<script>
    function update() {
        var flag=0;
        if(document.getElementById("status").value=="Edit"){
            var form = document.getElementById("info");
            var elements = form.elements;
            for (var i = 0, len = elements.length; i < len-1; ++i) {
                elements[i].readOnly = false;
                elements[i].style.borderBottom="1px solid black";
            }
            document.getElementById("status").value="Confirm";
            document.getElementById("status").style.width="206px";
            document.getElementById("status").style.height="36px";
            document.getElementById("status").type="submit";
        } else
        if(document.getElementById("status").value=="Confirm"){
            var form2 = document.getElementById("info");
            var elements2 = form.elements;
            for (var j = 0, length = elements.length; i < length-1; ++j) {
                elements2[i].readOnly = true;
                elements2[i].style.borderBottom="1px solid transparent";
            }
            document.getElementById("status").value="Edit";
            document.getElementById("status").style.width="200px";
            document.getElementById("status").style.height="30px";
            document.getElementById("status").type="text";
        }


    }

</script>

</HTML>