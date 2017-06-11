<?php
 
/**
 * Description of GetPigLatin
 *
 * @author Dionn
 */

require_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING) . "/PhpDemo/Models/IRetrievalModel.php");
require_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING) . "/PhpDemo/Models/RetrievalModelRequestBase.php");

class GetPigLatinModel implements IRetrievalModel{
     private function Translate($input){        
         if(isset($input)){ 
            $headers = array(
                'Content-Type: application/json'
            ); 
            $fields = array(
                'text' => $input
            );
            // Copyright © 2017 - Fun Translations - All rights reserved.
            $url = 'http://api.funtranslations.com/translate/piglatin.json'; 
            
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
             
            $result = curl_exec($ch);
            
            curl_close($ch);
            $result_arr = json_decode($result, true);
         
            $result_str = ( array_key_exists("contents", $result_arr) && 
                               array_key_exists("translated", $result_arr["contents"]) &&
                               array_key_exists("msg", $result_arr["contents"]["translated"])
                            )
                    ? $result_arr["contents"]["translated"]["msg"] : null;

            $error = ( array_key_exists("error", $result_arr) &&
                       array_key_exists("message", $result_arr["error"])                    
                      ) ? $result_arr["error"]["message"] : "service is down..";
            return isset($result_str) ? $result_str : $error;
         }
         else
         {
             return "";
         }
     }
     
     public function ProcessRequest(RetrievalModelRequestBase $data) {          
         return $this->Translate($data->data);
     }
} 
?>