<?php
/**
 * Created by PhpStorm.
 * User: James Fulton
 * Date: 8/12/2017
 * Time: 11:16 AM
 */

class Nookal_Appointment_Availabilities extends Nookal_Response {
    
    public function __construct($config = NULL)
    {
        
        parent::__construct($config);
        
        if(!empty($config['data']['results'])){
            
            $this->dateFrom($config['data']['results']['date_from']);
            $this->dateTo($config['data']['results']['date_to']);
            $this->availabilities($config['data']['results']['availabilities']);
            $this->locationID($config['data']['results']['location_id']);
            $this->practitionerID($config['data']['results']['practitioner_id']);
            
        }
        
    }
    
    public function dateFrom($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function dateTo($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function availabilities($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function locationID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function practitionerID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }
    
}

class Nookal_Class_Availabilities extends Nookal_Response {

    private $availabilities = array();
    
    public function __construct($config = NULL){

        parent::__construct($config);
        

        if(!empty($config['data']['results'])){

            $this->dateFrom($config['data']['results']['date_from']);
            $this->dateTo($config['data']['results']['date_to']);
            $this->addChildren($config['data']['results']['availabilities']);
            $this->locationID($config['data']['results']['location_id']);
            $this->practitionerID($config['data']['results']['practitioner_id']);

        }

    }

    public function dateFrom($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function dateTo($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function addChildren($locations){

        if(!empty($locations)){

            foreach($locations as $key=>$value){

                $this->addChild($value);

            }

        }

    }

    private function addChild($location){

        $this->availabilities[] = new Nookal_Appointment($location);

    }

    public function availabilities(){

        return $this->availabilities;

    }

    public function count(){

        return count($this->availabilities);

    }
    
    public function locationID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function practitionerID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

}