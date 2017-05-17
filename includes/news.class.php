<?php

class News{
    public function __construct(){
        $url = 'https://newsapi.org/v1/articles?source=recode&sortBy=top&apiKey='.NEWS_KEY;
        $this->news = file_get_contents($url);
        $this->news = json_decode($this->news);
    }
    public function tidy(){
        $this->title = $this->news->articles[0]->title;
        $this->description = $this->news->articles[0]->description;
        $this->image = $this->news->articles[0]->urlToImage;
        $this->url = $this->news->articles[0]->url;
    }
    public function descriptionLimit(){
        $description_sort = [];
        preg_match(
            '/^(\w+[éèàê]*.\w*\s){1,10}/',
            $this->description,
            $description_sort
        );
        $this->description = $description_sort[0]. ' ...';
    }
}
