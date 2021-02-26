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

<div id="metro">

<?php
$data_dir = '/home/Data/data/';
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
</div>
</body>
</html>
