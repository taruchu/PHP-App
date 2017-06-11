<?php
 
/**
 *
 * @author Dionn
 * This is a Facade to decouple the model implementation from the controller.
 */
require_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING) . "/PhpDemo/Models/RetrievalModelRequestBase.php");
 
interface IRetrievalModelBinder {     
     public function ProcessModelRequest(RetrievalModelRequestBase $data);
}

?>