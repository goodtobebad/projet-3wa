<?php

class UserModel{



    
    public function register($post) {

        $hash = $this->hashPassword($post['password']);
                
        $database = new Database();
        try{    
            if($post['firstName'] !== '' && $post['lastName'] !== '' && $post['email'] !== '' && $post['password'] !== ''){
                if(filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
                    $database->executeSql('INSERT INTO 
                                            user
                                            (FirstName, LastName, Email, Password, Role)
                                            VALUES
                                            (?, ?, ?, ?, "user")',
                                            
                                            [
                                                $post['firstName'],
                                                $post['lastName'],
                                                $post['email'],
                                                $hash
                                            ]);
                    return true;                        
                }else{
                    throw new Exception('Veuillez saisir un email valide.');
                }
            }else if($post['firstName'] === '' || $post['lastName'] === '' || $post['email'] === '' || $post['password'] === ''){
                throw new Exception('Veuillez remplir tout les champs.');
            }
        }catch(Exception $e){
            return $e->getMessage();
        }   
    }






    
    private function hashPassword($password){ // permet de crypter le mot de passe 
           
            $salt = '$2y$11$'.substr(bin2hex(openssl_random_pseudo_bytes(32)), 0, 22);
            
            return crypt($password, $salt); 
    }






    
    private function verifyPassword($password, $hashedPassword){
        return crypt($password, $hashedPassword) == $hashedPassword;
    }
    




    public function signIn($post) {
         $database = new Database();
         $user = $database->queryOne('SELECT * FROM user WHERE Email = ? ', [ $post['email'] ]);
        
        try{
            if($user === false) {
                throw new Exception('Email inconnu.');
            } else {
                if($this->verifyPassword($post['password'], $user['Password'])) {
                    $_SESSION['id'] = $user['Id'];
                    $_SESSION['firstName'] = $user['FirstName'];
                    $_SESSION['lastName'] = $user['LastName'];
                    $_SESSION['email'] = $user['Email'];
                    $_SESSION['role'] = $user['Role'];                                
                }else{
                    throw new Exception('Mot de passe incorrect.');
                }
            }
        }catch(Exception $e){
            return $e->getMessage();
        }

    }






    public function change_infos($post) {
        $database = new Database();
        
        try{
            if($post['firstName'] != '' && $post['lastName'] != '' && $post['email'] != ''){
                if(filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
                    $database->executeSql('UPDATE `user` SET `FirstName`= ?, `LastName`= ?, `Email`= ? WHERE Id = ?',[$post['firstName'],$post['lastName'],$post['email'],$_SESSION['id']]);
                    $_SESSION['firstName'] = $post['firstName'];
                    $_SESSION['lastName'] = $post['lastName'];
                    $_SESSION['email'] = $post['email'];
                }else{
                    throw new Exception('Veuillez saisir un email valide.');
                }
            }
    }catch(Exception $e){
        return $e->getMessage();
    }    
    }




    public function change_password($post){
        $database = new Database();
        $user = $database->queryOne('SELECT * FROM user WHERE Id = ? ', [ $_SESSION['id'] ]);
        try{
            if($post['oldPassword'] != '' && $post['newPassword'] != '' && $post['confirmPassword'] != ''){
                if($this->verifyPassword($post['oldPassword'], $user['Password'])){
                    if($post['newPassword'] === $post['confirmPassword']){
                        $hash = $this->hashPassword($post['newPassword']);
                        $database->executeSql('UPDATE `user` SET `Password`= ? WHERE Id = ?',[$hash, $_SESSION['id']]);
                    }else{
                        throw new Exception('Les mots de passe ne correspondent pas.Veuillez réessayer.');    
                    }    
                }else{
                    throw new Exception('Ancien mot de passe incorrect.');
                }
            }
        }catch(Exception $e){
            return $e->getMessage();
        }


    }




}




?>