<?php

class GameController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
		if(empty($_SESSION)){
            $http->redirectTo('/');
        }
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        
    }
}