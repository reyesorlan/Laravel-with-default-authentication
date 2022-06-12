<?php

class Nookal_Extras extends Nookal_Base {

    public function __construct($config = NULL)
    {

        if(!empty($config['_id'])){

            $this->ID($config['_id']);
            $this->locations($config['locations']);
            $this->name($config['fieldName']);
            $this->type($config['fieldType']);
            $this->rules($config['fieldRules']);
            $this->active($config['active']);
            $this->dateAdded($config['dateAdded']);
            $this->lastModified($config['lastModified']);

        }

    }

    public function ID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function locations($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function name($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function type($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function rules($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }
    public function active($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }
    public function dateAdded($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }
    public function lastModified($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

}