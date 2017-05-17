<?php
define('CITY', $_GET['q']);
$title =  CITY . ' - weather';
require 'includes/weather.class.php';
require 'includes/cookie.class.php';
include 'includes/cache.class.php';
include 'includes/day.class.php';


// COOKIE
$cookie = new Cookie;
$day = new Day;
$day = $day->test();

// WEATHER
$cache_weather = new Cache('weather', CITY);

if(!$cache_weather->testExist()){
    //Get weather
    $weather = new Weather;
    $weather->tidy();

    $cache_weather->addToCache($weather);
}
else{
    $weather = $cache_weather->getCache();
}

// WEATHER
$cache_forecast = new Cache('forecast', CITY);

if(!$cache_forecast->testExist()){
    //Get weather
    $forecast = new Forecast;
    $forecast->restResquest();
    $cache_forecast->addToCache($forecast->infos);
}
else{
    $forecast = new Forecast;
    $forecast->infos = $cache_forecast->getCache();
}

?>
<ul id="slide-out" class="side-nav">
    <ul>
        <li><a class="subheader">Favorites</a></li>
        <li class="center-align">
            <form class="" action="#" method="post">
                <button class="btn waves-effect waves-light" type="submit" name="favorite" value="<?= CITY ?>">Add <?= CITY  ?><i class="material-icons right">add</i>
                </button>
            </form>
        </li>
    </ul>
    <ul>
        <li><div class="divider"></div></li>
        <li><a class="subheader">Favorites list</a></li>
        <?php foreach ($cookie->favorite as $favorite): ?>
            <li><a class="waves-effect" href="/<?= $favorite ?>"><?= $favorite ?></a></li>
        <?php endforeach; ?>

    </ul>
</ul>
<header class="purple darken-3">
    <div class="header">
        <div class="row">
            <form class="location" action="/" method="get" class="white-text">
                <input type="text" id="city" name="q" value="" class="col offset-s1 s7 offset-m1 m3 offset-l1 l2 " placeholder="<?= ucfirst(CITY) ?>">
                <div class="col s1 m1 l1">
                    <label for="city"><i class="material-icons ">location_on</i></label>
                </div>
            </form>
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons col offset-l7 l1 offset-s1 s1 offset-m6 m1 yellow-text center-align">star</i></a>
        </div>
    </div>
    <div class="row">
        <div class="col l2 offset-l4 offset-m3 m3 s6">
            <img src="assets/img/<?= $weather->image ?>" class="">
        </div>
        <div class="col l2  m5 s6">
            <h3 class="temperature white-text"><?= $weather->temps ?>°c
                <br>
                <span class="smalleur-text"> <?= $weather->description ?> </span>
            </h3>
        </div>
    </div>
    <div class="row"></div>
    <div class="row"></div>
    </div>
</header>

<div class="container page z-depth-2  black-text">
    <div class="row">
        <div class="offset-l3 offset-m3 col l2 m2 s4 center-align position-relative humidity-after">
            <a class="btn-floating btn-large waves-effect waves-light purple"><?= $weather->humidity?>%</a>
        </div>
        <div class="col l2 m2 s4 center-align position-relative wind-after">
            <a class="btn-floating btn-large waves-effect waves-light purple"><?= $weather->wind?></a>
        </div>
        <div class="col l2 m2 s4 center-align position-relative cloud-after">
            <a class="btn-floating btn-large waves-effect waves-light purple"><?= $weather->clouds?>%</a>
        </div>
    </div>
    <div class="row">

            <form class="col s12 center-align" action="/<?= CITY?>" method="post">
                <button  class='btn waves-effect waves-light <?= $_POST['day'] == 'today' || empty($_POST['day']) ?"purple darken-3":"grey"?>' type="submit" name="day" value="today">Today</button>
                <button  class="btn waves-effect waves-light <?= $_POST['day'] == 'tomorrow' ?"purple darken-3":"grey"?>" type="submit" name="day" value="tomorrow">Tomorrow</button>
                <button  class="btn waves-effect waves-light <?= $_POST['day'] == 'after-tomorrow' ?"purple darken-3":"grey"?>" type="submit" name="day" value="after-tomorrow">After tomorrow</button>
            </form>
    </div>
    <?php
    foreach ($forecast->infos->list as $i => $_forecast):
        $forecast->tidy($_forecast);
        if($day == date("N", strtotime($_forecast->date))):
            ?>
            <div class="row">
                <div class="col l10 offset-l1 m10 offset-m1 s12">
                    <div class="card horizontal">
                        <div class="card-image image-horizontal-card purple darken-3">
                            <img src="assets/img/<?= $_forecast->image ?>">
                        </div>
                        <div class="card-stacked">
                            <div class="card-content">
                                <p class="right-align "><?= date("D H", strtotime($_forecast->date)); ?>h</p>
                                <p class="display-inline"><?= $_forecast->temps ?>°C</p>
                                <p><?= $_forecast->description ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endif;
    endforeach ?>
</div>
