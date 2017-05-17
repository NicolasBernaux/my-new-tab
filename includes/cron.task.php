<?php

$files = glob('./cache/*');
foreach($files as $file){
  if( date('Y-m-d H', filemtime($file)) != date("Y-m-d H")){
    unlink($file);
  }
}
