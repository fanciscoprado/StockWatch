<!DOCTYPE html>
<script> var noGood = false;</script>
<?php

$data_dir = '/home/frank/Data/data/';
$root_dir = '/home/frank/Data/';
/*
$message = "";
if(isset($_POST['SubmitButton'])){ //check if form was submitted

		$input = $_POST['inputText']; //get input text
		$phoneprovider = $_POST['cars'];
		if (preg_match('/([0-9][0-9]{9})/', $input)){//checks for valid number
	if(strcmp("8264",$phoneprovider) != 0){ print("yolo");
	  $myfile = fopen($root_dir."phonelist.csv", "a") or die("Unable to open file!");
		$file = file($root_dir."phonelist.csv");
		foreach($file as $file_data)
	  	$csv[]=explode(',',$file_data);
		$found = false;
		foreach ($csv as $key ) {
			if(0 == strcmp($key[0], $input)){
				$found = true;
			}
		}

		if(! $found){
			fwrite($myfile, $input.",".$phoneprovider."\n");
			$message = "Success! You entered: ".$input;
			$command = escapeshellcmd('python3 '.$root_dir.'emailer.py '.$input.' '.$phoneprovider);
		 $output = shell_exec($command);
		}else {
			$message = "Error number already in list";
		}
		fclose($myfile);

		echo "<script> noGood = true; </script>";
}else {
	//call remove script.
	
	//--------------------
}
		}else{
			$message = "Error pleas enter a 10 digit number ";
			echo "<script> noGood = true; </script>";
		}


}*/
?>

<html>
<head>
 <link rel="stylesheet" href="layout.css">
</head>
<body>

<ul class="menueBar">
  <li class="mbar"><a class="active" href="#home">Home</a></li>
  <li class="mbar"><a href="/Radio">Radio</a></li>
  <li class="mbar"><a href="index.php">Stocks</a></li>
 <!-- <li class="rmbar"><a href="#SignUp" onclick="openForm()">Sign up for text updates</a></li>-->
</ul>
<div class="form-popup" id="myForm">
  <form action="" method="post" class="form-container">
    <h1>Register</h1>

    <label for="email"><b>Phone Number</b></label>
    <input type="text" placeholder="xxxxxxxxxx" name="inputText" required>

    <label for="psw"><b>Phone carrier</b></label>
  <select id="cars" name="cars">
    <option value="att">ATT</option>
    <option value="versizon">Verizon</option>
    <option value="tmobile">T Mobile</option>
    <option value="sprint">Sprint</option>
		<option value="8264">Remove</option>
  </select>
<?php echo $message; ?>
    <button type="submit" name="SubmitButton" class="btn">Submit</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>
<div id="metro">

<?php

$files = scandir($data_dir);
$files = array_diff($files, array('.','..'));//remove '.' and '..' from list
foreach ($files as $fileName){
	unset($csv);//resets array holding csv inofrmation
	$title = str_replace(".csv", "", $fileName);
$file = file($data_dir.$fileName);
foreach($file as $file_data)
	$csv[]=explode(',',$file_data);
echo '
  <div class="tile">

    <div class="subTittle">

	<h1>'.(strcmp($title, "output") === 0 ? "Top 5" : "<a style='color: #000; text-decoration: none;'  href='http://www.reddit.com/r/$title'>r/".$title).'</a></h1>

      </div>

      <div class="subBody">

      <!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div class="tradingview-widget-container__widget"></div>
  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/markets/indices/" rel="noopener" target="_blank"><span class="blue-text">Indices</span></a> by TradingView</div>
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js" async>
  {
  "colorTheme": "light",
  "dateRange": "1D",
  "showChart": true,
  "locale": "en",
  "largeChartUrl": "",
  "isTransparent": false,
  "showSymbolLogo": true,
  "width": "400",
  "height": "660",
  "plotLineColorGrowing": "rgba(33, 150, 243, 1)",
  "plotLineColorFalling": "rgba(33, 150, 243, 1)",
  "gridLineColor": "rgba(240, 243, 250, 1)",
  "scaleFontColor": "rgba(120, 123, 134, 1)",
  "belowLineFillColorGrowing": "rgba(33, 150, 243, 0.12)",
  "belowLineFillColorFalling": "rgba(33, 150, 243, 0.12)",
  "symbolActiveColor": "rgba(33, 150, 243, 0.12)",
  "tabs": [
    {
      "title": "Indices",
      "symbols": [
        {
          "s": "'.$csv[0][0].'",
          "d": "'.$csv[0][0].'"
        },
        {
          "s": "'.$csv[1][0].'",
          "d": "'.$csv[1][0].'"
        },
        {
          "s": "'.$csv[2][0].'",
          "d": "'.$csv[2][0].'"
        },
        {
          "s": "'.$csv[3][0].'",
          "d": "'.$csv[3][0].'"
        },
        {
          "s": "'.$csv[4][0].'",
          "d": "'.$csv[4][0].'"
        }
      ],
      "originalTitle": "Indices"
    }
  ]
}
  </script>
</div>
<!-- TradingView Widget END -->


	<p style="float: right"> <a href="expanded.php?varname='.$fileName.' ">Expand</a></p>
      </div>

    </div>
';
};
?>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
if(noGood){
	openForm();
}
</script>

</div>
</body>
</html>
