<?php
/*
1. Back-end:​ ​Using​ ​your​ ​favorite​ ​PHP​ ​framework​ ​(or​ ​just​ ​plain​ ​PHP)​ ​fetch​ ​and​ ​display​ ​the
data.​ ​Provide​ ​the​ ​user​ ​with​ ​options​ ​to​ ​limit​ ​the​ ​number​ ​of​ ​results​ ​and​ ​sort​ ​the​ ​data.
2. Front-end:​ ​Once​ ​the​ ​data​ ​is​ ​displayed,​ ​the​ ​table​ ​should​ ​be​ ​able​ ​to​ ​refresh​ ​without​ ​a​ ​full
page​ ​reload,​ ​for​ ​example​ ​to​ ​change​ ​the​ ​sorting​ ​order,​ ​etc.​ ​The​ ​content​ ​displayed​ ​should
be​ ​responsive​ ​for​ ​mobile​ ​and​ ​desktops.
3. Write​ ​a​ ​short​ ​description​ ​of​ ​the​ ​steps​ ​you​ ​took​ ​to​ ​write​ ​this​ ​program.
4. Provide​ ​the​ ​file(s)​ ​and/or​ ​a​ ​link​ ​to​ ​see​ ​the​ ​program​ ​running​ ​and​ ​a​ ​way​ ​to​ ​see​ ​the​ ​code.


*/
error_reporting(E_ALL);
function grabData($testMode = false){     
  $file = file_get_contents("https://blockchain.info/ticker");
  return json_decode($file); 
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
