<?php
/**
 * Created by PhpStorm.
 * User: James Fulton
 * Date: 8/12/2017
 * Time: 10:24 AM
 */

class Nookal_Practitioner extends Nookal_Base {
    
    public function __construct($config = NULL)
    {
        
        if(!empty($config['ID'])){

            $this->ID($config['ID']);
            $this->firstName($config['FirstName']);
            $this->lastName($config['LastName']);
            $this->speciality($config['Speciality']); 
            $this->title($config['Title']);
            $this->email($config['Email']);
            $this->locations($config['locations']);
            $this->showInDiary($config['ShowInDiary']);
            $this->status($config['status']);
            
        }
        
    }
    
    public function ID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function status($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function showInDiary($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function firstName($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function lastName($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function speciality($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function title($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function email($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function locations($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

}

class Nookal_Practitioners extends Nookal_Response {

    private $practitioners = array();

    public function __construct($config = NULL)
    {

        parent::__construct($config);

        if(!empty($config['data']['results']['practitioners'])){

            $this->addPractitioners($config['data']['results']['practitioners']);

        }

    }

    private function addPractitioners($practitioners){

        if(!empty($practitioners)){

            foreach($practitioners as $key=>$value){

                $this->practitioners[] = new Nookal_Practitioner($value);

            }

        }

    }

    public function children(){

        return $this->practitioners;

    }
    
    public function count(){
        
        return count($this->practitioners);
        
    }

}

class Nookal_Practitioner_Photo extends Nookal_Response
{

    public function __construct($config = NULL)
    {

        parent::__construct($config);

        if(!empty($config['file_url'])){

            $this->url($config['file_url']);

        }

    }

    public function url($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

}