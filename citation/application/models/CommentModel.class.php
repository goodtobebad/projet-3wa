<?php

class CommentModel{
    
    public function addComment($post){
        $database = new Database();
        $addComment = $database->executeSql('INSERT INTO `comment`(`UserName`, `Comment`, `CreationTime`, `CitationId`) VALUES (?,?,now(),?)', [ $_SESSION['lastName'],$post['commentaire'],$_SESSION['citationId'] ]);
    }
    
    public function getComments(){
        $database = new Database();
        $getComments = $database->query("SELECT `UserName`,`Comment`,`CreationTime` FROM `comment` WHERE CitationId=? ORDER BY CreationTime desc",[ $_SESSION['citationId'] ]);
        return $getComments;
    }
    

}




?>