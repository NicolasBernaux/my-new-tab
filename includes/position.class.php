<?php


class Position{

    function __construct()
    {
        // $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->ip = '8.8.8.8';
        $this->city = file_get_contents('http://ip-api.com/json/'.$this->ip);
        $this->city = json_decode($this->city);
        $this->city = $this->city->city;
        define('CITY', $this->city);
    }
}
