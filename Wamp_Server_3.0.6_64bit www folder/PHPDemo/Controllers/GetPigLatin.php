<?php
 
/**
 * Description of GetPigLatin
 *
 * @author Dionn
 */
require_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING) . "/PhpDemo/AppConstants.php");
require_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING) . "/PhpDemo/Controllers/IController.php");
require_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING) . "/PhpDemo/Models/RetrievalModelContext.php");
require_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING) . "/PhpDemo/Models/RetrievalModelRequestBase.php");

class GetPigLatinRequestPacket extends RetrievalModelRequestBase{
    public $model_ID;
    public $data;
    function __construct($ID, $inputToTranslate) {
        $this->model_ID = $ID;
        $this->data = $inputToTranslate;
    }
}
class GetPigLatin implements IController {
    private $modelCollection = array();
    
    function __construct() {
        $this->modelCollection[GET_PIG_LATIN_MODEL] = new RetrievalModelContext(GET_PIG_LATIN_MODEL);
    }    
    private function GetJSON(){ 
                $server_request_method = trim(filter_input(INPUT_SERVER, "REQUEST_METHOD", FILTER_SANITIZE_STRING));
                $server_content_type = trim(filter_input(INPUT_SERVER, "CONTENT_TYPE", FILTER_SANITIZE_STRING));
                
                if(strcasecmp($server_request_method, 'POST') != 0){
                    throw new Exception('GetPigLatin is a POST request.');
                } 
                $contentType = isset($server_content_type) ? $server_content_type : '';
                if(strcasecmp($contentType, 'application/json') != 0){
                    throw new Exception('Content type must be: application/json');
                }
 
                $content = trim(file_get_contents("php://input")); 
                $decoded = json_decode($content);
                return isset($decoded) ? $decoded : "";
    }
    public function InvokeModel(){        
        $translationInput = $this->GetJSON();
        $reqPak = new GetPigLatinRequestPacket(GET_PIG_LATIN_MODEL, $translationInput);
        return $this->modelCollection[GET_PIG_LATIN_MODEL]->ProcessModelRequest($reqPak);
    }
}

$piglatin = new GetPigLatin();
echo $piglatin->InvokeModel();
?>