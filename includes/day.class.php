<?php


class Day{
    function test(){
        if(empty($_POST['day']) || $_POST['day'] == 'today'){
            return date('N');
        }
        else if($_POST['day'] == 'tomorrow'){
            return (date('N')+1)%7;
        }
        else if($_POST['day'] == 'after-tomorrow'){
            return (date('N')+2)%7;
        }
    }
}
