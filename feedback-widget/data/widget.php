<?php
  $fname = $_GET['firstname'];
  $html = '<div class="fdbk-main"></div>';
  if($fname == 'Jeff') {
    //header("Content-Type: application/json");
    echo $_GET['callback'] . '(' . "{'markup' : '" . $html . "'}" . ')';
  }
?>
