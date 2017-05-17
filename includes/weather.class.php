<?php



class Weather{
    public function __construct(){
        $this->city = $this->replaceSpaces(CITY);
        $this->url = 'http://api.openweathermap.org/data/2.5/weather?q='. $this->city .'&units=metric&appid=' . WEATHER_KEY;
        $this->infos = file_get_contents($this->url);
        $this->infos = json_decode($this->infos);
    }
    public function tidy(){
        $this->temps = round($this->infos->main->temp);
        $this->description = ucfirst($this->infos->weather[0]->description);
        $this->image = $this->infos->weather[0]->icon . '.svg';
        $this->humidity = $this->infos->main->humidity;
        $this->wind = $this->infos->wind->speed;
        $this->clouds = $this->infos->clouds->all;
        unset($this->infos);
    }
    public function replaceSpaces($replace){
        $replace = preg_replace(
        '/(\s)+/',
            '-',
            $replace
        );
        return $replace;
    }
}

class Forecast{
    public function restResquest(){
        $this->city = $this->replaceSpaces(CITY);
        $url = 'http://api.openweathermap.org/data/2.5/forecast?q='. $this->city .'&units=metric&appid=' . WEATHER_KEY;
        $this->infos = file_get_contents($url);
        $this->infos = json_decode($this->infos);
    }
    public function tidy($that){
        $that->temps = round($that->main->temp);
        $that->description = ucfirst($that->weather[0]->description);
        $that->image = $that->weather[0]->icon . '.svg';
        $that->humidity = $that->main->humidity;
        $that->wind = $that->wind->speed;
        $that->clouds = $that->clouds->all;
        $that->date = $that->dt_txt;
        unset($this->infos);
    }
    public function replaceSpaces($replace){
        $replace = preg_replace(
        '/(\s)+/',
            '-',
            $replace
        );
        return $replace;
    }
}
