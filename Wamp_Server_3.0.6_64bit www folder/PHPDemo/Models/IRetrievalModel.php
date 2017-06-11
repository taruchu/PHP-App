<?php
 
/**
 *
 * @author Dionn
 * This interface describes a model only used for retrieving model data.
 */
require_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING) . "/PhpDemo/Models/RetrievalModelRequestBase.php");

interface IRetrievalModel {
     public function ProcessRequest(RetrievalModelRequestBase $data);
}
