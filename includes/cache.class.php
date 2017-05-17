<?php


class Cache{

    function __construct($a , $b=""){
        $this->path = './cache/'.md5($a.$b.date('Y-m-d H'));
    }
    function testExist(){
        if(file_exists($this->path)){
            return true;
        }
        else{
            return false;
        }
    }
    function addToCache($that){
        $that = json_encode($that);
        file_put_contents($this->path, $that);

    }
    function getCache(){
        return json_decode(file_get_contents($this->path));
    }
};
