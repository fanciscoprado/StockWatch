<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="layout.css">
</head>
<body>
  <ul class="menueBar">
    <li class="mbar"><a class="active" href="#home">Home</a></li>
    <li class="mbar"><a href="/Radio">Radio</a></li>
    <li class="mbar"><a href="index.php">Stocks</a></li>
  </ul>
<div class="split left">
  <table>
  <tr>
    <th>Ticker</th>
    <th>Mention Count</th>
    <th></th>
  </tr>
  <?php
  $fileName = $_GET['varname'];
  $file = file('/home/Data/data/'.$fileName);
  foreach($file as $file_data)
  	$csv[]=explode(',',$file_data);
    $counter = 0;
  foreach ($csv as $line){
  echo '
  <tr>
    <td>'.$csv[$counter][0].'</td>
    <td>'.$csv[$counter][1].'</td>
    <td>View</td>
  </tr>
  ';
  if($counter === 200)
    break;
  $counter += 1;
};
  ?>
</table>

</div>

<div class="split right">

  <div id="top">Top</div>
  <div id="bottom">Bottom</div>

</div>
</body>
</html>
