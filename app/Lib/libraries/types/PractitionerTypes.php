<?php
/**
 * Created by PhpStorm.
 * User: James Fulton
 * Date: 8/12/2017
 * Time: 10:46 AM
 */

class Nookal_Practitioner_Types extends Nookal_Response {
    
    private $practitionerID;
    private $services;
    private $classes;
    
    public function __construct($config = NULL)
    {
        
        parent::__construct($config);
        
        if(!empty($config['data']['results'])){
            
            $this->practitionerID($config['data']['results']['practitioner_id']);
            $this->addServices($config['data']['results']['services']);
            $this->addClasses($config['data']['results']['classes']);
            
        }
        
    }
    
    public function practitionerID($practitionerID = NULL){

        if($practitionerID == NULL){
            return $this->practitionerID;
        }

        $this->practitionerID = $practitionerID;
        return $this->practitionerID();

    }

    private function addServices($services){

        if(!empty($services)){

            $ns = new Nookal_Services();
            $ns->addChildren($services);
            $this->services($ns);

        }

    }

    private function addClasses($classes){

        if(!empty($classes)){

            $nc = new Nookal_Classes();
            $nc->addChildren($classes);
            $this->services($nc);

        }

    }
    
    public function services($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function classes($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

}