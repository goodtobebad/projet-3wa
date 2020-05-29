<?php

class NewinfosController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
		if(empty($_SESSION)){
            $http->redirectTo('/');
        }
        
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        $userModel = new UserModel();
    	$changeInfos = $userModel->change_infos($_POST);
        if($changeInfos != 'Veuillez saisir un email valide.'){
            $http->redirectTo('/infos');
        }
        return ['error'=> $changeInfos];
    }
}