<?php

//Routinf

include 'includes/config.php';

$q = isset($_GET['q']) ? $_GET['q'] : '';

if( $q == ''){
    $page = 'home';
}
else{
    $page = 'weather';

}

ob_start();
include 'views/pages/'.$page.'.php';
$content = ob_get_clean();

include 'views/partials/header.php';
echo $content;
include 'views/partials/footer.php';
