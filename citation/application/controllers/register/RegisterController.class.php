<?php

class RegisterController
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
        $register = $userModel->register($_POST);
        if($register !== 'Veuillez saisir un email valide.' && $register !== 'Veuillez remplir tout les champs.' ){
            $http->redirectTo('/login');
        }
        return ['error'=> $register];
    }
}