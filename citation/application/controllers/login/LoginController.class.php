<?php

class LoginController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
		if(empty($_SESSION) === false){
            $http->redirectTo('/');
        }
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
    	$userModel = new UserModel();
        $login = $userModel->signIn($_POST);
        if($login != 'Email inconnu.' && $login != 'Mot de passe incorrect.'){
            $http->redirectTo('/');
        }
        return ['error' => $login];
    }
}