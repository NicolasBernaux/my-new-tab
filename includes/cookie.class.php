<?php


class Cookie
{

    function __construct()
    {
        if (!empty($_POST['favorite'])){
            $this->favorite = isset($_COOKIE['favorite']) ? $_COOKIE['favorite'] . ',' . $_POST['favorite'] : $_POST['favorite'];
            setcookie('favorite', $this->favorite ,time()+100*100*100);
            header("Location: /".$_POST['favorite'] );
            exit();
        }
        else
        $this->favorite = isset($_COOKIE['favorite']) ? explode(',',$_COOKIE['favorite']) : '';
    }
}
