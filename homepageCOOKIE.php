<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<?php
session_start();
if (isset($_GET['street'])){
    $street = $_GET['street'];
    $city = $_GET['city'];
    $state = $_GET['states'];
    setcookie("mystreet","$street");
    setcookie("mycity","$city");
    setcookie("mystate","$state");
} else{
    $street = $_COOKIE["mystreet"];
    $city = $_COOKIE["mycity"];
    $state = $_COOKIE["mystate"];
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>mainmenu</title>
    <link rel="stylesheet" type="text/css" href="homepage.css">
    <link rel="stylesheet" type="text/css" href="layout.css">
    <style TYPE="text/css">
        body {
            font-family:Arial, Helvetica, sans-serif;
            background-color: white;
            background-repeat: repeat;
            margin: 0 0 0 0;}
    </style>
</head>
<body>

<div>
    <div id="right">
        <div  style="margin:0 0 0 200px;">
            <div id="searchbar" style="background-color: #FF9966;">
                <?php
                if(!isset($_SESSION['username'])){
                    //echo "<div id='headerRight'> <button type='button'><a href='index.html'>SignIn</a></button> </div>";
                    //echo "<div id='headerRight'> <button type='button'><a href='index.html'>SignUp</a></button> </div>";
                    echo "<span style='float:right;'><button type='button'><a href='index.html'>SignIn</a></button></span>";
                    echo "<span style='float:right;'><button type='button'><a href='index.html'>SignUp</a></button></span>";
                } else{
//                    echo "<div id='headerRight'> <button type='button'><a href='mypage.php'>MyPage</a></button> </div>";
//                    echo "<div id='headerRight'> <button type='button'><a href='logout.php'>Log out</a></button> </div>";
                    echo "<span style='float:right;'><button type='button'><a href='mypage.php'>MyPage</a></button></span>";
                    echo "<span style='float:right;'><button type='button'><a href='logout.php'>Log out</a></button></span>";
                }
                ?>
        <form class="form-search" name="CreateAddress"   action="homepageCOOKIE.php" method="get"  >
            <div class="input-append">
              <table >
                <tr>
                    <td><li id="Sstates">
                        <form style="margin:0; display: inline;">
                            <select name="states" style="font-size: 20px; width:150px;height:30px">
                                <option value="states" selected="selected" disabled="disabled">States</option>
                                <option value="AK">AK</option>
                                <option value="AL">AL</option>
                                <option value="AZ">AZ</option>
                                <option value="AR">AR</option>
                                <option value="CA">CA</option>
                                <option value="CO">CO</option>
                                <option value="CT">CT</option>
                                <option value="DE">DE</option>
                                <option value="DC">DC</option>
                                <option value="FL">FL</option>
                                <option value="GA">GA</option>
                                <option value="HI">HI</option>
                                <option value="ID">ID</option>
                                <option value="IL">IL</option>
                                <option value="IN">IN</option>
                                <option value="IA">IA</option>
                                <option value="KS">KS</option>
                                <option value="KY">KY</option>
                                <option value="LA">LA</option>
                                <option value="ME">ME</option>
                                <option value="MD">MD</option>
                                <option value="MA">MA</option>
                                <option value="MI">MI</option>
                                <option value="MN">MN</option>
                                <option value="MS">MS</option>
                                <option value="MO">MO</option>
                                <option value="MT">MT</option>
                                <option value="NB">NB</option>
                                <option value="NV">NV</option>
                                <option value="NH">NH</option>
                                <option value="NJ">NJ</option>
                                <option value="NM">NM</option>
                                <option value="NY">NY</option>
                                <option value="NC">NC</option>
                                <option value="ND">ND</option>
                                <option value="OH">OH</option>
                                <option value="OK">OK</option>
                                <option value="OR">OR</option>
                                <option value="PA">PA</option>
                                <option value="PR">PR</option>
                                <option value="RI">RI</option>
                                <option value="SC">SC</option>
                                <option value="SD">SD</option>
                                <option value="TN">TN</option>
                                <option value="TX">TX</option>
                                <option value="UT">UT</option>
                                <option value="VT">VT</option>
                                <option value="VA">VA</option>
                                <option value="VI">VI</option>
                                <option value="WA">WA</option>
                                <option value="WV">WV</option>
                                <option value="WI">WI</option>
                                <option value="WY">WY</option>
                            </select>
                        </form>
                        </li>
                    </td>
                    <td><input id="Scity" name="city" type="test" placeholder="    City"/></td>
                    <td><input id="Saddr" name="street" type="test" placeholder="    Street"/></td>
                    <td><button class="btnx" type="submit">Find Food</button></td>
                </tr>
              </table>
            </div>
        </form>
            </div>

            <div id="restlist" style="background-color:white; width:100%;height:100%">
                <?php

                if(isset($_GET['MD'])){
                   $MD=$_GET['MD'];
                } else $MD=0;

                if(isset($_GET['BK'])){
                    $BK = $_GET['BK'];
                } else $BK=0;

                if(isset($_GET['PH'])){
                    $PH = $_GET['PH'];
                } else $PH=0;

                if(isset($_GET['TB'])){
                    $TB = $_GET['TB'];
                } else $TB=0;

                if(isset($_GET['WD'])){
                    $WD = $_GET['WD'];
                } else $WD=0;

                if(isset($_GET['KFC'])){
                    $KFC = $_GET['KFC'];
                } else $KFC=0;

                if(isset($_GET['JIB'])){
                    $JIB = $_GET['JIB'];
                } else $JIB=0;

                if(isset($_GET['HD'])){
                    $HD = $_GET['HD'];
                } else $HD=0;

                if(isset($_GET['CFA'])){
                    $CFA = $_GET['CFA'];
                } else $CFA=0;

                if(isset($_GET['INO'])){
                    $INO = $_GET['INO'];
                } else $INO=0;

                if($MD==0 && $BK==0 && $PH==0 && $TB==0 && $WD==0 && $KFC==0 && $JIB==0 && $HD==0 && $CFA==0 && $INO==0){
                    $MD=1;
                    $BK=2;
                    $PH=3;
                    $TB=4;
                    $WD=5;
                    $KFC=6;
                    $JIB=7;
                    $HD=8;
                    $CFA=9;
                    $INO=10;
                }

                $url_prefix = "https://maps.googleapis.com/maps/api/geocode/xml?address=";
                $address =urlencode ( str_replace(' ','+',$street).'+,'.str_replace(' ','+',$city).'+,'.$state);
                $api_key = "&key=AIzaSyCu4osXRbVK0yOZDZzLGab5RT4Li4JK3Wo";
                $google_api_url = $url_prefix.$address.$api_key;
                $str = file_get_contents($google_api_url);
                #echo $str;
                $xml = simplexml_load_string($str);

                $lat = floatval ($xml->result->geometry->location->lat);
                $lon = floatval ($xml->result->geometry->location->lng);

                $connection = oci_connect($username = 'my1',
                                          $password = 'My4114510',
                                          $connection_string = '//oracle.cise.ufl.edu/orcl');

                $sql = "select BRANDID,USRID,BRANDNAME, OPENTIME, CLOSETIME, ADDRESS, CITY, STATE, ZIPCODE,RATE
                        from g14brandname natural join G14RESTAURANT natural join g14userinfo, (select bussid,avg(rating)as RATE from g14order GROUP BY bussid)
                        WHERE USRID = BUSSID AND  USRTYPE='b' AND LAT > '$lat'-0.1 AND LAT < '$lat'+0.1 AND LON> '$lon'-0.1 AND LON< '$lon'+0.1
                              AND (BRANDID='$MD' OR BRANDID='$BK' OR BRANDID='$PH' OR BRANDID='$TB' OR BRANDID='$WD' OR BRANDID='$KFC' OR BRANDID='$JIB' OR BRANDID='$HD' OR BRANDID='$CFA' OR BRANDID='$INO')";

                $query = oci_parse($connection,$sql);
                oci_execute($query);

                $nrows = oci_fetch_all($query, $res);

                /*
                  show pages: first page, previous page, next page,last page
                  */
                // numbers of pages
                $pages = intval($nrows/5);
                if($nrows % 5){
                    $pages++;
                }
                // pageNumber
                if(isset($_GET['PAGENUM'])){
                    $pagenum = $_GET['PAGENUM'];
                }
                else{
                    $pagenum = 1;
                }

                echo "<div style='color: #ff9966;margin: 5px 0 0 10px; font-weight: bold'> ";
                echo $nrows." Restaurants In Total.";

                echo "<span style='float:right;'>Total $pages Pages</span>";
                echo "<span style='float:right;padding:2px;'> | </span>";
                // last page
                echo "<span style='float:right;'><a href='homepageCOOKIE.php?street=$street & city=$city & states=$state & PAGENUM=$pages & MD=$MD&BK=$BK&PH=$PH&TB=$TB&WD=$WD&KFC=$KFC&JIB=$JIB&HD=$HD&CFA=$CFA&INO=$INO'>Last Page</a></span>";

                //next page
                if($pagenum != $pages){
                    echo "<span style='float:right;padding:2px;'> | </span>";
                    $nextpage = $pagenum+1;
                    echo "<span style='float:right;'><a href='homepageCOOKIE.php?street=$street & city=$city & states=$state & PAGENUM=$nextpage & MD=$MD&BK=$BK&PH=$PH&TB=$TB&WD=$WD&KFC=$KFC&JIB=$JIB&HD=$HD&CFA=$CFA&INO=$INO'>Next Page</a></span>";
                }

                //Previous page
                if($pagenum != 1){
                    echo "<span style='float:right;padding:2px;'> | </span>";
                    $prepage = $pagenum-1;
                    echo "<span style='float:right;'><a href='homepageCOOKIE.php?street=$street & city=$city & states=$state & PAGENUM=$prepage & MD=$MD&BK=$BK&PH=$PH&TB=$TB&WD=$WD&KFC=$KFC&JIB=$JIB&HD=$HD&CFA=$CFA&INO=$INO'>Previous Page</a></span>";
                }
                echo "<span style='float:right;padding:2px;'> | </span>";

                // First page
                echo "<span style='float:right;'><a href='homepageCOOKIE.php?street=$street & city=$city & states=$state & PAGENUM=1 & MD=$MD&BK=$BK&PH=$PH&TB=$TB&WD=$WD&KFC=$KFC&JIB=$JIB&HD=$HD&CFA=$CFA&INO=$INO'>First Page</a></span>";
                echo "</div>";

                /*
                 * display every page's content
                 */
                echo "<hr>";
                // start number of tuples in a pagenum
                $offset = ($pagenum-1)*5;
                $maxcount = min(5, $nrows - $offset);   //number of tuples in a page
                for($i=$offset; $i < $offset + $maxcount; $i++){
                    $usrID=$res['USRID'][$i];
                    $brandName =$res['BRANDNAME'][$i];
                    $openTime = $res['OPENTIME'][$i];
                    $closeTime= $res['CLOSETIME'][$i];
                    $Street= $res['ADDRESS'][$i];
                    $City= $res['CITY'][$i];
                    $State= $res['STATE'][$i];
                    $zipCode= $res['ZIPCODE'][$i];
                    $Rate = number_format($res['RATE'][$i],1);
                    $brandID=$res['BRANDID'][$i];


                    echo "<table id=cover>";
                    echo "<tr>";
                    echo "<td style='width: 210px;'>";
                    //display pic
                    echo "<div >
							<img class='summary-pic' src='brand_logo/$brandID.png' alt=''>
					      </div>";
                    echo"</td>";
                    echo"<td>";
                    //display restaurant name
                    //add review button direct to review.php
                    echo "<div id=detail>
                            <span><a href='restaurant.php?usrID=$usrID & BRANDID=$brandID'> $brandName </a></span>
                            <span>OpenTime: $openTime, CloseTime: $closeTime </span>							";
                    //display rating
                    $intRate = round($Rate);
                    echo "<p><span ><img src='$intRate.png' alt=''  align='top'/></span><span id=rate>Rate:".$Rate;
                    echo"</span></p>";
                    //display address
                    echo"<div id=addr>";
                    echo "<h4>Address: </h4>";
                    echo "<span>$Street, $City, $State, $zipCode</span>";
                    echo"</div>";
                    echo "</div>";
//                    echo "</li>";
                    echo"</td>";
                    echo"</tr>";
                    echo "</table>";
                }

                ?>


            </div>
        </div>
    </div>
    <div id="left" style="float:left;width:200px; background-color: #FF9966; height: 100%;">
        <form class="form-search" name="CreateAddress"  method="get"  action="homepageCOOKIE.php"  >
            <div id="filter">
                <h1>Brand</h1>
                <div class="items">
                    <input id="item1" type="checkbox" name="MD" VALUE="1">
                    <label for="item1">McDonalid's</label>

                    <input id="item2" type="checkbox" name="BK" VALUE="2">
                    <label for="item2">Burger King</label>

                    <input id="item3" type="checkbox" name="PH" VALUE="3" >
                    <label for="item3">Pizza Hut</label>

                    <input id="item4" type="checkbox" name="TB" VALUE="4">
                    <label for="item4">Taco Bell</label>

                    <input id="item5" type="checkbox" name="WD" VALUE="5">
                    <label for="item5">Wendy's</label>

                    <input id="item6" type="checkbox" name="KFC" VALUE="6">
                    <label for="item6">KFC</label>

                    <input id="item7" type="checkbox" name="JIB" VALUE="7">
                    <label for="item7">Jack in the Box</label>

                    <input id="item8" type="checkbox" name="HD" VALUE="8">
                    <label for="item8">Hardee's</label>

                    <input id="item9" type="checkbox" name="CFA" VALUE="9">
                    <label for="item9">Chick-fil-A</label>

                    <input id="item10" type="checkbox" name="INO" VALUE="10">
                    <label for="item10">in-N-Out</label>

                    <h2 class="selected" aria-hidden="true">Selected</h2>
                    <h2 class="unselected" aria-hidden="true">Unselected</h2>
                </div>
            </div>
            <button class="btnx" type="submit">Filter</button>
        </form>



    </div><!--end of left-->
</div>

<div id="restTable">
    <table>
        <tr>
            <td></td>
        </tr>
        </tr>
    </table>
</div>
</body>
</html>