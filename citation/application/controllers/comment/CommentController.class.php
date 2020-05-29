<?php

class CommentController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
		if(empty($_SESSION)){
            $http->redirectTo('/');
        }else{
                if(array_key_exists('id', $_GET)){
                    $_SESSION['citationId'] = $_GET['id'];
                
                    $citationModel = new CitationModel();
        	        $getOneCitation = $citationModel->getOneCitation($_GET['id']);
                    
                    $commentModel = new CommentModel();
                    $getComments = $commentModel->getComments();
                    
                    return ['citation'=> $getOneCitation, 'commentaires'=> $getComments];
                    
                }else{
                    
                    $citationModel = new CitationModel();
        	        $getOneCitation = $citationModel->getOneCitation($_SESSION['citationId']);
                    
                    $commentModel = new CommentModel();
                    $getComments = $commentModel->getComments();
                    
                    return ['citation'=> $getOneCitation, 'commentaires'=> $getComments];
                }
            }
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        
            $citationModel = new CitationModel();
    	    $getOneCitation = $citationModel->getOneCitation($_SESSION['citationId']);
    	    
            $commentModel = new CommentModel();
            
            if($_POST['commentaire'] !== ''){
                $addComment = $commentModel->addComment($_POST);    
            }
            $getComments = $commentModel->getComments();
            
            return ['citation'=> $getOneCitation, 'commentaires'=> $getComments];
        
        
    }
}