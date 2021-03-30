<!DOCTYPE html>

<?php
$message = "";
if(isset($_POST['SubmitButton'])){ //check if form was submitted
	$input = $_POST['inputText']; //get input text
	$phoneprovider = $_POST['cars'];
	if (preg_match('/([0-9][0-9]{9})/', $input)){//checks for valid number
	$message = "Success! You entered: ".$input;

  $myfile = fopen("/home/frank/Data/phonelist.csv", "a") or die("Unable to open file!");

fwrite($myfile, $input.",".$phoneprovider."\n");
fclose($myfile);
 $command = escapeshellcmd('python3 /home/frank/Data/emailer.py '.$input.' '.$phoneprovider);
$output = shell_exec($command);

}
}    
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
  <li class="rmbar"><a href="#SignUp" onclick="openForm()">Sign up for text updates</a></li>
</ul>
<div class="form-popup" id="myForm">
  <form action="" method="post" class="form-container">
    <h1>Sign up/Unsubscrib</h1>

    <label for="email"><b>Phone Number</b></label>
    <input type="text" placeholder="xxxxxxxxxx" name="inputText" required>

    <label for="psw"><b>Phone carrier</b></label>
  <select id="cars" name="cars">
    <option value="att">ATT</option>
    <option value="versizon">Verizon</option>
    <option value="tmobile">T Mobile</option>
    <option value="sprint">Sprint</option>
  </select>
<?php echo $message; ?>
    <button type="submit" name="SubmitButton" class="btn">Submit</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>
<div id="metro">

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>

</div>
</body>
</html>
