<?php
/*
1. Back-end:​ ​Using​ ​your​ ​favorite​ ​PHP​ ​framework​ ​(or​ ​just​ ​plain​ ​PHP)​ ​fetch​ ​and​ ​display​ ​the
data.​ ​Provide​ ​the​ ​user​ ​with​ ​options​ ​to​ ​limit​ ​the​ ​number​ ​of​ ​results​ ​and​ ​sort​ ​the​ ​data.
2. Front-end:​ ​Once​ ​the​ ​data​ ​is​ ​displayed,​ ​the​ ​table​ ​should​ ​be​ ​able​ ​to​ ​refresh​ ​without​ ​a​ ​full
page​ ​reload,​ ​for​ ​example​ ​to​ ​change​ ​the​ ​sorting​ ​order,​ ​etc.​ ​The​ ​content​ ​displayed​ ​should
be​ ​responsive​ ​for​ ​mobile​ ​and​ ​desktops.
3. Write​ ​a​ ​short​ ​description​ ​of​ ​the​ ​steps​ ​you​ ​took​ ​to​ ​write​ ​this​ ​program.
4. Provide​ ​the​ ​file(s)​ ​and/or​ ​a​ ​link​ ​to​ ​see​ ​the​ ​program​ ​running​ ​and​ ​a​ ​way​ ​to​ ​see​ ​the​ ​code.


stdClass Object ( [USD] => stdClass Object ( [15m] => 3909.46 [last] => 3909.46 [buy] => 3910.09 [sell] => 3908.83 [symbol] => $ ) [AUD] => stdClass Object ( [15m] => 4897.77 [last] => 4897.77 [buy] => 4898.56 [sell] => 4896.98 [symbol] => $ ) [BRL] => stdClass Object ( [15m] => 12256.53 [last] => 12256.53 [buy] => 12258.51 [sell] => 12254.56 [symbol] => R$ ) [CAD] => stdClass Object ( [15m] => 4756.21 [last] => 4756.21 [buy] => 4756.97 [sell] => 4755.44 [symbol] => $ ) [CHF] => stdClass Object ( [15m] => 3768.72 [last] => 3768.72 [buy] => 3769.33 [sell] => 3768.11 [symbol] => CHF ) [CLP] => stdClass Object ( [15m] => 2448885.74 [last] => 2448885.74 [buy] => 2449280.38 [sell] => 2448491.11 [symbol] => $ ) [CNY] => stdClass Object ( [15m] => 24862.07 [last] => 24862.07 [buy] => 24890.8 [sell] => 24833.34 [symbol] => ¥ ) [DKK] => stdClass Object ( [15m] => 24465.63 [last] => 24465.63 [buy] => 24469.57 [sell] => 24461.69 [symbol] => kr ) [EUR] => stdClass Object ( [15m] => 3292.58 [last] => 3292.58 [buy] => 3293.63 [sell] => 3291.53 [symbol] => € ) [GBP] => stdClass Object ( [15m] => 2959.13 [last] => 2959.13 [buy] => 2959.61 [sell] => 2958.66 [symbol] => £ ) [HKD] => stdClass Object ( [15m] => 30542.63 [last] => 30542.63 [buy] => 30547.55 [sell] => 30537.71 [symbol] => $ ) [INR] => stdClass Object ( [15m] => 250694.51 [last] => 250694.51 [buy] => 250734.91 [sell] => 250654.11 [symbol] => ₹ ) [ISK] => stdClass Object ( [15m] => 417960.37 [last] => 417960.37 [buy] => 418027.72 [sell] => 417893.02 [symbol] => kr ) [JPY] => stdClass Object ( [15m] => 431363.08 [last] => 431363.08 [buy] => 431432.5 [sell] => 431293.67 [symbol] => ¥ ) [KRW] => stdClass Object ( [15m] => 4428049.87 [last] => 4428049.87 [buy] => 4428763.44 [sell] => 4427336.3 [symbol] => ₩ ) [NZD] => stdClass Object ( [15m] => 5395.37 [last] => 5395.37 [buy] => 5396.24 [sell] => 5394.5 [symbol] => $ ) [PLN] => stdClass Object ( [15m] => 14081.5 [last] => 14081.5 [buy] => 14083.77 [sell] => 14079.23 [symbol] => zł ) [RUB] => stdClass Object ( [15m] => 226485.18 [last] => 226485.18 [buy] => 226521.68 [sell] => 226448.68 [symbol] => RUB ) [SEK] => stdClass Object ( [15m] => 31396.88 [last] => 31396.88 [buy] => 31401.94 [sell] => 31391.82 [symbol] => kr ) [SGD] => stdClass Object ( [15m] => 5278.53 [last] => 5278.53 [buy] => 5279.38 [sell] => 5277.68 [symbol] => $ ) [THB] => stdClass Object ( [15m] => 129585.04 [last] => 129585.04 [buy] => 129605.92 [sell] => 129564.15 [symbol] => ฿ ) [TWD] => stdClass Object ( [15m] => 117635.65 [last] => 117635.65 [buy] => 117654.61 [sell] => 117616.69 [symbol] => NT$ ) )
*/
error_reporting(E_ALL);
function grabData($testMode = false){ 
  
  /*get data from the api. this query string will exclude all loans already expired.
  returns up to 5000 entries; when tested there were only 300 results to parse.*/
  $file = file_get_contents("https://blockchain.info/ticker");
  return json_decode($file);

  
  /*
  foreach ($result->data->loans->values as $loan)
  {    
    /*here the first line excludes any loan that will expire some time later than the 24 hour window 
    
    if(strtotime($loan->plannedExpirationDate) < $now+(24*60*60)){      
      $unfunded = (float)$loan->loanAmount - (float)$loan->fundedAmount;
      echo 'Loan ID: <a href="http://www.kiva.org/lend/'.$loan->id.'">'. $loan->id . '</a> Left to Fund: $'. $unfunded .'<br>';
      $totalLoanAmount += $unfunded;
      $loansTotalled++;
    }
    else
    {
      //data gathering - how many loans are being excluded?    
      $loansOutsideWindow++;
    }
        
  }

echo 'Total to fund all loans $'.$totalLoanAmount.'<br>';
echo 'Loans Tabulated: '.$loansTotalled.'<br>';
echo 'Loans Outside Window: '.$loansOutsideWindow.'<br>';
echo 'TotalCount from result: '.$result->data->loans->totalCount.'<br>';
*/
}
?>
<html>
<head>
<!-- START code for the datatable -->					
  <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">		
  <link rel="stylesheet" type="text/css" href="css/dataTables.responsive.css">
  <link rel="stylesheet" type="text/css" href="css/dataTables.tableTools.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  <script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
  <script type="text/javascript" language="javascript" src="js/dataTables.responsive.js"></script>			
  <script type="text/javascript" language="javascript" src="js/dataTables.tableTools.js"></script>	
  <script type="text/javascript" language="javascript" src="js/sorttable.js"></script>
  <script type="text/javascript" language="javascript" src="js/columnfilter.js"></script>
  <script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {
      $('table.display').dataTable({
        "ordering": true,
        "order": [[0, 'desc']]
      });				
    });
  </script>
<!--END code for the datatable -->
</head>
<body>
<table class="display">
<thead>
  <th scope='col' id='currency'>Currency</th>  
  <th scope='col' id='fifteen'>15m Value</th>
  <th scope='col' id='last'>Last Trade Value</th>
  <th scope='col' id='buy'>Buy Offer Value</th>
  <th scope='col' id='sell'>Sell Offer Value</th>
  <th scope='col' id='symbol'>Symbol</th>
</thead>
<?php 
$data = grabData();
foreach ($data as $currency => $trade){ 
  //this is the easiest way I could find to access the "15m" key.
  $tradeArray = (array)$trade;?>  
  <tr>
    <td><?php echo $currency; ?></td>
    <td><?php echo $tradeArray['15m'] ?></td>
    <td><?php echo $trade->last; ?></td>
    <td><?php echo $trade->buy; ?></td>
    <td><?php echo $trade->sell; ?></td>
    <td><?php echo $trade->symbol; ?></td>
  </tr>  
<?php } ?>
</table>

</body></html>
