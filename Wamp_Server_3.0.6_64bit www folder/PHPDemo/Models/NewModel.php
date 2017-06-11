<?php

 

/**
 * Description of NewModel
 *
 * @author Dionn
 */
require_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING) . "/PhpDemo/AppConstants.php");
require_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING) . "/PhpDemo/Models/IModelFactory.php");
require_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING) . "/PhpDemo/Models/GetAJokeModel.php");
require_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING) . "/PhpDemo/Models/GetPigLatinModel.php");

class NewModel implements IModelFactory{
    
     public function RetrieveNewModel($model_ID) {
         switch ($model_ID) {
             case GET_A_JOKE_MODEL:
                 //Loose coupling :=)
                 return new GetAJokeModel();               
             case GET_PIG_LATIN_MODEL:
                 return new GetPigLatinModel();
             default: 
                 throw new Exception('RetrieveNewModel does not recognize this model_ID: ' + $model_ID);             
         }
     }
}
?>