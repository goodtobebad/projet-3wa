<?php

class NewmdpController
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
        $changePassword = $userModel->change_password($_POST);
        if($changePassword != 'Les mots de passe ne correspondent pas.Veuillez réessayer.' && $changePassword != 'Ancien mot de passe incorrect.' ){
            $http->redirectTo('/infos');
        }
        return ['error' => $changePassword];
    }

}