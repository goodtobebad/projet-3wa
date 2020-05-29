<?php

class CitationModel{

    public function getAllCitation(){

        $database = new Database();
        $citations = $database->query('SELECT * FROM citations', []);
        return $citations;
    }



    public function addToFavorite($post){
        $database = new Database();
        $verifyFav = false;
        $favoris = $database->query('SELECT * FROM favori WHERE User_id = ?', [ $_SESSION['id'] ]);
        if(empty($favoris)){
            $addTofav = $database->executeSql('INSERT INTO favori(User_id, C_id) VALUES (?,?)', [ $_SESSION['id'], $post['citationId'] ]);
        }else{
            foreach($favoris as $favori){
                if($favori['C_id'] === $post['citationId']){
                    $verifyFav = true;
                }
            }
            if($verifyFav){
                $deleteFav = $database->executeSql('DELETE FROM `favori` WHERE User_id = ? AND C_id = ?', [$_SESSION['id'], $post['citationId']]);
            }else{
                $addTofav = $database->executeSql('INSERT INTO favori(User_id, C_id) VALUES (?,?)', [ $_SESSION['id'], $post['citationId'] ]);
                }
        }
     
    }


    public function getFav(){
        $database = new Database();
        $favoris = $database->query('SELECT * FROM favori WHERE User_id = ?', [ $_SESSION['id'] ]);
        return $favoris;
    }

    public function getFavCitation(){
        $database = new Database();
        $favoris = $database->query('SELECT Id, Image, Name, Citation FROM `favori` INNER JOIN citations ON citations.Id = C_id WHERE User_id = ?', [ $_SESSION['id'] ]);
        return $favoris;
    }
    
    public function getOneCitation($citaId){
        $database = new Database();
        $citation = $database->queryOne('SELECT * FROM citations WHERE Id=?', [$citaId]);
        return $citation;
    }


}




?>