<!DOCTYPE html>
<html lang="en">
<head>
  <title>QUERYS?</title>
  <meta charset="utf-8">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
			body{ font-size: 20px;background:#f5f5f5;}
			a{cursor:pointer;}
		</style>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
	
.tz-link{
	text-decoration: none;
	color: #fff !important;
	font: bold 36px Arial,Helvetica,sans-serif !important;
}

.tz-link span{
	color: #da431c;
}
.form-search{
    margin: 0 auto;
    text-align: center;

    font: bold 13px sans-serif;
    max-width: 325px;
    position: relative;
}

.form-search input{
    width: 230px;
    box-sizing: border-box;
    border-bottom-left-radius: 2px;
    border-top-left-radius: 2px;
    background-color:  #ffffff;
    box-shadow: 1px 2px 4px 0 rgba(0, 0, 0, 0.08);
    padding: 14px 15px 14px 40px;
    border: 1px solid #b6c3cd;;
    border-right: 0;
    color:#4E565C;
    outline: none;
    -webkit-appearance: none;
}


.form-search button{
    border-bottom-right-radius: 2px;
    border-top-right-radius: 2px;
    background-color:  #6caee0;
    box-shadow: 1px 2px 4px 0 rgba(0, 0, 0, 0.08);
    color: #ffffff;
    padding: 15px 22px;
    margin-left: -4px;
    cursor: pointer;
    border: none;
    outline: none;
	border-radius: 4px;
	
}

.form-search i{
    position: absolute;
    top: 15px;
    left: 20px;
    font-size: 16px;
    color: #80A3BD;
}

/* Placeholder color */

.form-search input::-webkit-input-placeholder {
    color:  #879097;
}

.form-search input::-moz-placeholder {
    color:  #879097;
    opacity: 1;
}

.form-search input:-ms-input-placeholder {
    color:  #879097;
}

  </style>
</head>

<body>

<div class="w3-bar w3-white w3-large">
<img src="https://cegepgim.koha.ccsr.qc.ca/opac-tmpl/bootstrap/images/cegeps/gaspe_img_logo_cegep.png" width="100%">
 </div>
  
<div class="container-fluid text-center">    
  <div class="row content">
   
    <div class="col-sm-8 text-left"> 
     <nav class="nav">
<ul>
</ul>
</nav>

<article class="article">
 <div>
 
 </div>
 
 <form class="form-search" name ="form" method="get" action="qwerty.php">
            <input type="search" name="name" id="name" value="<?php if (isset($_GET['name'])) echo $_GET['name']; ?>" placeholder="Type a query.. ">
        <button type="submit" name="submit" id="submit">Submit</button>
			<button type="submit" name="hello" id="hello">NotThisOne</button>

            <i class="fa fa-search"></i>
        </form>

</article>
<?php
//echo "hello";
error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
function depluralize($word){
    $rules = array( 
        //'ss' => false, 
        'os' => 'o', 
        'ies' => 'y', 
        'xes' => 'x', 
        'oes' => 'o', 
        'ies' => 'y', 
        'ves' => 'f', 
        's' => '');
    foreach(array_keys($rules) as $key){
        
        if(substr($word, (strlen($key) * -1)) != $key) 
            continue;
     
        if($key === false) 
            return $word;
     
        return substr($word, 0, strlen($word) - strlen($key)) . $rules[$key]; 
    }
    return $word;
}
$keyword = array("syllabus","carrier","guidance","location","your","name","age","creator","gender","take","admission","specialization","training","wifi","bu","fee","library","computer","health","sport","canteen","stationary","water","hostel","faculty","infrastructure","achievement","research","professional society","seminar","clubs","department","vision","mission","college","ceo","principal","chairman","hi","hello","backup","guide","first","second","third","fourth","subject");
//$question= "what is your age";
//$question = $_POST["name"];
$q=$question = isset($_GET['name']) ? $_GET['name'] : '';
if (isset($_GET['hello'])) {
       
	   $sql = "INSERT INTO notfound (query) VALUES ('".$question."')";
	   $conn->query($sql);
	   $sql = "DELETE FROM notfound WHERE query = ''";
	   	   $conn->query($sql);

		echo "Thanks we will update  this soon.";
    }
if (isset($_GET['submit'])) {
    $quest=$question;
$question=str_replace("?","",$question);
$question = strtolower($question);
$question = explode(" ", $question);
$key="";
//echo $token[0];
for($i=0;$i<sizeof($question);$i++){
	$question[$i]=depluralize($question[$i]);
	for($j=0;$j<sizeof($keyword);$j++)
		if($question[$i]==$keyword[$j])
		{	$key=$key.$question[$i]." ";
		}
}
$key=rtrim($key);
$key = explode(" ", $key);
$k=0;
static $flag;
for($i=0;$i<sizeof($key);$i++){
	$sql = "SELECT * FROM keywords";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	
    // output data of each row
    while($row = $result->fetch_assoc()) {
         $id[$k]=$row["id"];
         $kee[$k]=$row["keyword"];
         $dlink[$k]=$row["dlink"];
         $flink[$k]=$row["flink"];
         $ulink[$k]=$row["ulink"];
         $value[$k]=$row["value"];
		 $flag[$k]=0;
	   $k++;
    }
}
		echo "<center><bold>".""."</center>";

//print_r ($key);
echo "<br/>";

function traversal($link)
{
	extract($GLOBALS);
	global $flag,$kee;
	for($i=0;$i<sizeof($key);$i++)
	{
		if($key[$i]==$kee[$link])
		{
			$flag[$link]=($flag[$ulink[$link]])+1;
		//echo "$id[$link] $kee[$link] $flag[$link]";
		break;
		}
	}
	
	//	echo "$kee[$link] $flag[$link]"."<br/>";
    if($dlink[$link]!=0)
	traversal($dlink[$link]);
	if($flink[$link]!=0)
	traversal($flink[$link]);
	if($dlink[$link]==0&&$flink[$link]==0)
	{
		return;
	}
}
traversal(0);
function fmaximum($link)
{
	extract($GLOBALS);
	global $flag,$flink;
	$q=0;
	while($link!=0)
	{
		if($q<$flag[$link])
		$q=$flag[$link];
	    $link=$flink[$link];
	}
	return $q;
	
}


    for($i=0;$i<sizeof($kee);$i++)
	{
		for($j=0;$j<sizeof($kee);$j++)
	        {
				if($i!=$j){
				if($kee[$i]==$kee[$j])
				{
					if($flag[$i]>$flag[$j])
						$flag[$j]=0;
				}
				}
	        }
	}
function printing($shw)
{
//	$shw = explode(" ", $shw);
	for($i=0;$i<(strlen($shw));$i++)
	{
		if($shw[$i]=="x"&&$shw[$i+1]=="y"&&$shw[$i+2]=="z"){
			$shw[$i]==" ";$shw[$i+1]=" ";$shw[$i+2]=" ";
						echo "<br/>";
		}
else if($shw[$i]=="z"&&$shw[$i+1]=="y"&&$shw[$i+2]=="x"){
			$shw[$i]==" ";$shw[$i+1]=" ";$shw[$i+2]=" ";
						echo "   ";
}
						else if($shw[$i]=="y"&&$shw[$i+1]=="x"&&$shw[$i+2]=="z"){
			$shw[$i]==" ";$shw[$i+1]=" ";$shw[$i+2]=" ";
						echo " ";
						
		}else 
			echo $shw[$i];
	}
	
}
printing("you: ".$quest);
echo "<br/>";
printing("Boomer: ");
$final="";
function disp($link)
{
	
	extract($GLOBALS);
	global $final;
	if($flag[$link]!=0&&$flag[$link]>fmaximum($dlink[$link]))
	{
		printing(str_replace("-"," ",clean($value[$link])));
		$final=$final.str_replace("-"," ",clean($value[$link]))." ";
		echo "<br/>";
				echo "<br/>";
				$sql = "SELECT image FROM keywords WHERE id = $link and image is not null";
$result=mysqli_fetch_array($conn->query($sql));
echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['image'] ).'"/>';
				

	}
    if($dlink[$link]!=0)
	disp($dlink[$link]);
	if($flink[$link]!=0)
	disp($flink[$link]);
	if($dlink[$link]==0&&$flink[$link]==0)
	{
		return;
	}
}
disp(0);

	}
$conn->close();
function tts($arg){
require_once('voicerss_tts.php');
$tts = new VoiceRSS;
$voice = $tts->speech([
    'key' => '521540016edb4dbabdb9f0d21faac9ef',
    'hl' => 'en-in',
    'src' => $arg,
    'r' => '0',
    'c' => 'mp3',
    'f' => '44khz_16bit_stereo',
    'ssml' => 'false',
    'b64' => 'true'
]);
echo '<audio src="' . $voice['response'] . '" autoplay="autoplay"></audio>';
}


function is_connected()
{
    $connected = @fsockopen("www.example.com", 80); 
                                        //website, port  (try 80 or 443)
    if ($connected){
        $is_conn = true; //action when connected
        fclose($connected);
    }else{
        $is_conn = false; //action in connection failure
    }
    return $is_conn;

}
if(is_connected()){
	$final=str_replace("xyz",", ",$final);
	$final=str_replace("zyx"," ",$final);
	$final=str_replace("yxz"," ",$final);
tts($final);
}
}
	
?>

</div>
    </div>
    
  </div>
</div>


</body>
</html>
