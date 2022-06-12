<?php
/**
 * Created by PhpStorm.
 * User: James Fulton
 * Date: 19/12/2017
 * Time: 11:40 AM
 */

class Nookal_File extends Nookal_Base {

    public function __construct($config = NULL)
    {

        if(!empty($config['ID'])){

            $this->ID($config['ID']);
            $this->mime($config['mime']);
            $this->name($config['name']);
            $this->extension($config['extension']);
            $this->patientID($config['patientID']);
            $this->caseID($config['caseID']);
            $this->status($config['status']);
            
        }

    }

    public function ID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function mime($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function name($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }
    
    public function extension($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function patientID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function caseID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function status($value = NULL){
        if(!empty($value) && $value >= 1){
            $value = true;
        }else{
            $value = false;
        }
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }
    
}

class Nookal_Files extends Nookal_Response { 
    /**
     * @var array (Nookal_File)
     */
    private $files = array();

    public function __construct($config = NULL)
    {

        parent::__construct($config);

        if(!empty($config['data']['results']['files'])){

            $this->addChildren($config['data']['results']['files']);

        }

    }

    public function addChildren($files){

        if(!empty($files)){

            foreach($files as $key=>$value){

                $this->addChild($value);

            }

        }

    }

    private function addChild($file){

        $this->files[] = new Nookal_File($file);

    }

    public function children(){

        return $this->files;

    }

    public function count(){

        return count($this->files);

    }
    
}

class Nookal_File_URL extends Nookal_Response {
    
    public function __construct($config = NULL)
    {
        
        parent::__construct($config);

        print_r($config);
        
        if(!empty($config['data']['results']['url'])){
            
            $this->url($config['data']['results']['url']);
            
        }

    }

    public function url($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

}