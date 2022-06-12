<?php
/**
 * Created by PhpStorm.
 * User: James Fulton
 * Date: 8/12/2017
 * Time: 11:01 AM
 */

class Nookal_Address extends Nookal_Base {
    
    public function __construct($config = NULL)
    {
        
        if(!empty($config['AddressLine1'])){
            $this->addressLine1($config['AddressLine1']);
        }
        if(!empty($config['AddressLine2'])){
            $this->addressLine2($config['AddressLine2']);
        }
        if(!empty($config['AddressLine3'])){
            $this->addressLine3($config['AddressLine3']);
        }
        if(!empty($config['City'])){
            $this->city($config['City']);
        }
        if(!empty($config['State'])){
            $this->state($config['State']);
        }
        if(!empty($config['Country'])){
            $this->country($config['Country']);
        }
        if(!empty($config['Postcode'])){
            $this->postcode($config['Postcode']);
        }
        
    }

    public function addressLine1($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function addressLine2($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function addressLine3($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function city($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function state($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function country($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function postcode($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

}