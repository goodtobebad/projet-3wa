<?php

class FavoriteController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
		if(empty($_SESSION)){
            $http->redirectTo('/');
        }else{
        $citation = new CitationModel();
        $getFav = $citation->getFavCitation();
        return ['favs'=>$getFav];
        }
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        $citation = new CitationModel();
        $addToFavorite = $citation->addToFavorite($_POST);
        $http->redirectTo('/favorite');
    }
}