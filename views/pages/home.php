<?php

$title = 'New Tab';

include 'includes/news.class.php';
include 'includes/weather.class.php';
include 'includes/position.class.php';
include 'includes/cache.class.php';
include 'includes/cron.task.php';


// CACHE NEWS
$cache_news = new Cache('forecast');

if(!$cache_news->testExist()){ //test if news are in cache
//if not :
    //GET NEWS INFORMATIONS
    $last_news = new News;
    $last_news->tidy();
    $last_news->descriptionLimit();
    //ADD IN CACHE
    $cache_news->addToCache($last_news);
}
else{
    //if yes, get cache content
    $last_news = $cache_news->getCache();
}


//Get position
$position = new Position;

// CACHE WEATHER
$cache_weather = new Cache('weather', CITY);

if(!$cache_weather ->testExist()){ //test if weather are in cache
//if not :
    //Get weather
    $weather = new Weather;
    $weather->tidy();

    $cache_weather->addToCache($weather);
}
else{
    //if yes, get cache content
    $weather = $cache_weather->getCache();
}


?>

<div class="container black-text">

    <div class="row search">
        <form class="google-search" action="https://www.google.fr/search" method="get">
            <div class="input-field col s9 m4 l4 offset-s1 offset-m4 offset-l4">
                <i class="material-icons prefix">search</i>
                <input id="icon_prefix autocomplete-input" type="text" class="validate autocomplete" name="q" autocomplete="off">
                <label for="autocomplete-input">Google Search</label>
            </div>
        </form>
    </div>
    <div class="row cards-center">
        <!-- News card -->
        <a href="<?= $last_news->url;?>" target="_blank">
            <div class="col s12 m8 l5 offset-m2 news-card">
                <div class="card">
                    <div class="card-image">
                        <img src="<?= $last_news->image?>">
                        <span class="card-title"><?= $last_news->title;?></span>
                    </div>
                    <div class="card-content black-text">
                        <p><?= $last_news->description;?></p>
                    </div>
                    <div class="card-action">
                        <a href="<?= $last_news->url;?>" target="_blank">More destails</a>
                    </div>
                </div>
            </div>
        </a>
        <!-- weathter card -->
        <a href="<?= CITY ?>" class="link-weather" target="_blank">
            <div class="col s12 m8 l5 offset-m2 offset-l2 weather-card">
                <div class="card weather">
                    <div class="card-image purple darken-3">
                        <img src="assets/img/<?= $weather->image ?>">
                        <span class="card-title city"><?= CITY ?></span>
                    </div>
                    <div class="card-content black-text">
                        <p class="description"><?= $weather->description ?></p>
                        <p class="right-align temperature"><?= $weather->temps ?>°C</p>
                    </div>
                    <div class="card-action">
                        <a href="<?= CITY ?>" target="_blank">More details</a>
                    </div>
                </div>
            </div>
        </a>

    </div>
</div>
