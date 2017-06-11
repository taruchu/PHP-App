<?php
 

/**
 * Description of JokeModel
 *
 * @author Dionn
 */ 
require_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING) . "/PhpDemo/Models/IRetrievalModel.php");
require_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING) . "/PhpDemo/Models/RetrievalModelRequestBase.php");

class GetAJokeModel implements IRetrievalModel{
     private function WebServiceJoke(){          
        $url = 'http://api.adviceslip.com/advice'; // AdviceSlip.com © Tom Kiss 2017 
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, false); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        $result = curl_exec($ch); 
        curl_close($ch); 
        $result_arr = json_decode($result, true); 
        $result_str = ( array_key_exists("slip", $result_arr) &&
                        array_key_exists("advice", $result_arr["slip"])
                      ) ?  $result_arr["slip"]["advice"] : null;
        
        return isset($result_str) ? $result_str : null;
     }
     private function DefaultJoke(){
         return "This is no joke, Love yourself :=)";
     }            
     public function ProcessRequest(RetrievalModelRequestBase $data) { 
        $webApi = $this->WebServiceJoke();
        $default = $this->DefaultJoke();
        return isset($webApi) ? $webApi : $default;           
    }     
} 
?>
