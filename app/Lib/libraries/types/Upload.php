<?php
/**
 * Created by PhpStorm.
 * User: James Fulton
 * Date: 19/12/2017
 * Time: 5:10 PM
 */

class Nookal_Upload extends Nookal_Response {

    public function __construct($config = NULL)
    {
       
        parent::__construct($config);
        
        /*
        if(!empty($config['data']['results']['key'])){
            
            $this->key($config['data']['results']['key']);
            $this->AWSAccessKeyId($config['data']['results']['AWSAccessKeyId']);
            $this->acl($config['data']['results']['acl']);
            $this->policy($config['data']['results']['policy']);
            $this->contentType($config['data']['results']['contentType']);
            $this->signature($config['data']['results']['signature']);
            $this->url($config['data']['results']['url']);
            $this->ID($config['data']['results']['file_id']);
            
        }
        */
        if(!empty($config['data']['results']['file_id'])){
            
            $this->ID($config['data']['results']['file_id']);
            $this->url($config['data']['results']['url']);
            
        }
        

    }
    
    public function ID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }
    
    public function url($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }
    
}

class Nookal_File_Upload extends Nookal_Response {

    public function __construct($config = NULL)
    {

        parent::__construct($config);
        
        if(!empty($config['file_id'])){
            
            $this->ID($config['file_id']);
            
        }

    }
    
    public function ID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }
    
}