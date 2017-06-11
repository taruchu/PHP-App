<?php
 
/**
 * Description of GetJoke
 *
 * @author Dionn
 */
require_once(filter_input(INPUT_SERVER,  'DOCUMENT_ROOT' , FILTER_SANITIZE_STRING) . "/PhpDemo/AppConstants.php");
require_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING) . "/PhpDemo/Controllers/IController.php");
require_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING) . "/PhpDemo/Models/RetrievalModelContext.php"); 
require_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING) . "/PhpDemo/Models/RetrievalModelRequestBase.php");

class GetJokeRequestPacket extends RetrievalModelRequestBase {
    public $model_ID;
    public $data;
    function __construct($ID, $dat) {
        $this->model_ID = $ID;
        $this->data = $dat;
    }
}
 
class GetJoke implements IController{
    private $modelCollection = array();     
    
    function __construct(){  
        $this->modelCollection[GET_A_JOKE_MODEL] = new RetrievalModelContext(GET_A_JOKE_MODEL);        
    }
    public function InvokeModel() {
       //Call proces request for any models as needed
       $reqPacket = new GetJokeRequestPacket(GET_A_JOKE_MODEL, "");
       return $this->modelCollection[GET_A_JOKE_MODEL]->ProcessModelRequest($reqPacket);
    }
}

$joke = new GetJoke();
echo $joke->InvokeModel();
?>