<?php

class HomeController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        $CitationModel = new CitationModel();
        $citations = $CitationModel->getAllCitation();
        if(empty($_SESSION) === false){
            $fav = $CitationModel->getFav();
            return [ 'citations'=> $citations,
                  'fav'=> $fav ];
        }else{
            return [ 'citations'=> $citations];
        }
        
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
		
    }
}