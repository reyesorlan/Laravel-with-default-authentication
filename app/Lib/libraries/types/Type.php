<?php
/**
 * Created by PhpStorm.
 * User: James Fulton
 * Date: 7/12/2017
 * Time: 3:39 PM
 */

class Nookal_Type extends Nookal_Response {

    public function ID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function name($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function duration($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function type($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function description($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function price($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function hasTax($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function locations($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

}

class Nookal_Types extends Nookal_Response {

    private $children = array();

    public function children(){

        return $this->children;

    }

    public function child($id){

        if(isset($this->children[$id])){

            return $this->children[$id];

        }

        return NULL;

    }

    public function setChild($id, $child){

        $this->children[$id] = $child;

    }

}