<?php
/**
 * Created by PhpStorm.
 * User: James Fulton
 * Date: 2/03/2018
 * Time: 4:46 PM
 */

class Nookal_Matrix extends Nookal_Response {

    private $services = array();
    private $classes = array();
    
    public function __construct($config = NULL){
        
        
        parent::__construct($config);

        if(!empty($config['data']['results']['locationID'])){

            $this->locationID($config['data']['results']['locationID']);

        }

        if(!empty($config['data']['results']['services'])){

            $this->addChildren($config['data']['results']['services'], 'service');

        }
        if(!empty($config['data']['results']['classes'])){

            $this->addChildren($config['data']['results']['services'], 'class');

        }
        
    }

    public function addChildren($elements, $type){

        if(!empty($elements)){

            foreach($elements as $key=>$value){

                $this->addChild($value, $type);

            }

        }

    }
    
    public function services(){
        
        return $this->services;
        
    }
    
    public function classes(){
        
        return $this->classes;
        
    }

    private function addChild($element, $type = 'service'){

        if($type == 'service'){
            
            $this->services[] = new Nookal_Matrix_Element($this->locationID(), $element);
            
        }else{

            $this->classes[] = new Nookal_Matrix_Element($this->locationID(), $element);
            
        }
        

    }

    public function locationID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }
    
}

class Nookal_Matrix_Element extends Nookal_Base {
    
    public function __construct($locationID, $element)
    {
        
        $this->locationID($locationID);
        if(!empty($element['id'])){

            $this->id($element['id']);

        }
        if(!empty($element['providers'])){
            
            $this->providerIDs($element['providers']);
            
        }
        
    }

    public function id($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }
    
    public function locationID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }
    
    public function providerIDs($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }
    
}