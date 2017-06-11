<?php
 
/**
 * Description of ModelContext
 *
 * @author Dionn
 */
require_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING) . "/PhpDemo/AppConstants.php");
require_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING) . "/PhpDemo/Models/NewModel.php");
require_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING) . "/PhpDemo/Models/IRetrievalModel.php");
require_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING) . "/PhpDemo/Models/IRetrievalModelBinder.php");
require_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING) . "/PhpDemo/Models/RetrievalModelRequestBase.php");


class RetrievalModelContext implements IRetrievalModelBinder {
    private $model;
    function __construct($model_ID) {
        $modelFactory = new NewModel();
        $this->model = $modelFactory->RetrieveNewModel($model_ID);
    }
    public function ProcessModelRequest(RetrievalModelRequestBase $data) {
       return $this->model->ProcessRequest($data);
    }
}

?>