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

  <div id="top">

<table id="tickerList">
  <tr>
    <th>Ticker</th>
    <th>Mention Count</th>
    <th></th>
  </tr>
  <?php
  $data_path = '';
  $fileName = $_GET['varname'];
  $file = file($data_path.$fileName);
  foreach($file as $file_data)
  	$csv[]=explode(',',$file_data);
    $counter = 0;
  foreach ($csv as $line){
  echo '
  <tr>
    <td>'.$csv[$counter][0].'</td>
    <td>'.$csv[$counter][1].'</td>
    <td><a href="#view">View</a></td>
  </tr>
  ';
  if($counter === 200)
    break;
  $counter += 1;
};
  ?>
</table>


</div>

<div id="bottom">


<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div id="tradingview_e75ab"></div>
  <div class="tradingview-widget-copyright"><span class="blue-text">Chart</span> by TradingView</div>
  <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
  <script type="text/javascript">
  new TradingView.widget(
{
  'width': 1000,
  'height': 400,
  'symbol': 'GME',
  'interval': 'D',
  'timezone': 'Etc/UTC',
  'theme': 'light',
  'style': '1',
  'locale': 'en',
  'toolbar_bg': '#f1f3f6',
  'enable_publishing': false,
  'allow_symbol_change': true,
  'container_id': 'tradingview_e75ab'
}
  );
  </script>
</div>
</div>
<!-- TradingView Widget END -->
</div>

</body>

<script type="text/javascript">
var table = document.getElementById("tickerList");
var rows = table.rows;
var pt1 = "";
var pt2 = "";
for (var i = 1; i < rows.length; i++) {
    rows[i].onclick = (function (e) {
	    var rowid = (this.cells[0].innerHTML);
	document.getElementById("bottom").innerHTML = "<div class='tradingview-widget-container'>  <div id='tradingview_e75ab'></div>  <div class='tradingview-widget-copyright'><span class='blue-text'>Chart</span> by TradingView</div>";


  new TradingView.widget(
{
  'width': 1000,
  'height': 400,
  'symbol': this.cells[0].innerHTML,
  'interval': 'D',
  'timezone': 'Etc/UTC',
  'theme': 'light',
  'style': '1',
  'locale': 'en',
  'toolbar_bg': '#f1f3f6',
  'enable_publishing': false,
  'allow_symbol_change': true,
  'container_id': 'tradingview_e75ab'
}
  );


    });
}
</script>
</html>
