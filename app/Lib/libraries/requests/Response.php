<?php
/**
 * Created by PhpStorm.
 * User: James Fulton
 * Date: 7/12/2017
 * Time: 4:53 PM
 */

class Nookal_Response extends Nookal_Base{
    
    private $status;
    private $errorDescription;
    private $errorCode;
    private $apiCall;
    private $settings;
    private $details;
    
    const STATUS_SUCCESS = true;
    const STATUS_FAILURE = false;
    
    public function __construct($config = NULL)
    {

        if(!empty($config)){
           
            $this->status($config['status']);

            if($config['status'] == 'failure'){

                $this->errorDescription($config['details']['errorMessage']);
                $this->errorCode($config['details']['errorCode']);

            }else{

                $this->apiCall($config['data']['api_call']);
                if(!empty($config['details'])){
                    $this->details($config['details']);
                }
                if(!empty($config['settings'])) {
                    $this->settings($config['settings']);
                }
                
            }

        }
        
    }

    public function settings($settings = NULL){

        if($settings == NULL){
            return $this->settings;
        }

        $this->settings = $settings;
        return $this->settings();

    }

    public function details($details = NULL){

        if($details == NULL){
            return $this->details;
        }

        $this->details = $details;
        return $this->details();

    }
    
    public function hasNextPage(){
        
        if(!empty($this->settings['currentPage'])){
            
            if(empty($this->settings['nextPage'])){
                
                return false;
                
            }else{
                
                return true;
                
            }
            
        }
        
        return false;
        
    }

    public function nextPage(){

        if(!empty($this->settings['currentPage'])){

            if(empty($this->settings['nextPage'])){

                return NULL;

            }else{

                return $this->settings['nextPage'];

            }

        }

        return NULL;

    }

    public function pageLength(){

        if(!empty($this->settings['pageLength'])){

            return $this->settings['pageLength'];
        }

        return 0;

    }
    
    public function apiCall($call = NULL){
        
        if($call == NULL){
            return $this->apiCall;
        }

        $this->apiCall = $call;
        return $this->apiCall();
        
    }
    
    public function status($status = NULL){
        
        if($status == NULL){
            return $this->status;
        }
        
        $this->status = $status;
        return $this->status();
        
    }
    
    public function errorDescription($description = NULL){

        if($description == NULL){
            return $this->errorDescription;
        }

        $this->errorDescription = $description;
        return $this->errorDescription();
        
    }
    
    public function errorCode($code = NULL){

        if($code == NULL){
            return $this->errorCode;
        }

        $this->errorCode = $code;
        return $this->errorCode();

    }
    
}