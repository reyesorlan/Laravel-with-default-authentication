<?php
/**
 * Created by PhpStorm.
 * User: James Fulton
 * Date: 8/12/2017
 * Time: 1:39 PM
 */
class Nookal_Contact extends Nookal_Base {
    
    public function __construct($config = NULL)
    {
        
        if(!empty($config['ID'])){
            
            $this->ID($config['ID']);
            $this->title($config['title']);
            $this->firstName($config['firstName']);
            $this->lastName($config['lastName']);
            $this->company($config['company']);
            
        }
        
    }
    
    public function ID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function company($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function firstName($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function lastName($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function title($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }
    
}