<?php
/**
 * Created by PhpStorm.
 * User: James Fulton
 * Date: 8/12/2017
 * Time: 12:07 PM
 */
class Nookal_Booking extends Nookal_Response {
    
    public function __construct($config = NULL)
    {
        
        parent::__construct($config);

        if(!empty($config['data']['results']['appointment_id'])){

            $this->appointmentID($config['data']['results']['appointment_id']);

        }
        
    }
    
    public function appointmentID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

}