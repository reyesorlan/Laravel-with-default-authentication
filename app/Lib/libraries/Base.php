<?php
/**
 * Created by PhpStorm.
 * User: James Fulton
 * Date: 7/12/2017
 * Time: 3:34 PM
 */


define('NOOKAL_SDK_VERSION', '0.1.1');

/**
 * Base functionality for library classes
 */
abstract class Nookal_Base
{
    
    public $_attributes = array();
    
    /**
     * Disable the default constructor
     *
     * Objects that inherit from Braintree_Base should be constructed with
     * the static factory() method.
     *
     * @ignore
     */
    protected function __construct()
    {
    }

    /**
     * Disable cloning of objects
     *
     * @ignore
     */
    protected function __clone()
    {
    }

    /**
     * Accessor for instance properties stored in the private $_attributes property
     *
     * @ignore
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->_attributes)) {
            return $this->_attributes[$name];
        }
        else {
            trigger_error('Undefined property on ' . get_class($this) . ': ' . $name, E_USER_NOTICE);
            return null;
        }
    }

    /**
     * Checks for the existance of a property stored in the private $_attributes property
     *
     * @ignore
     * @param string $name
     * @return boolean
     */
    public function __isset($name)
    {
        return array_key_exists($name, $this->_attributes);
    }

    /** 
     * Mutator for instance properties stored in the private $_attributes property
     *
     * @ignore
     * @param string $master
     * @param string $key
     * @param mixed $value
     */
    public function _set($master, $key, $value)
    {
        $this->_attributes[$master][$key] = $value;
    }

    /**
     * @param $master
     * @param $key 
     * @param null $value
     * @return null
     */
    public function __build($master, $key, $value = NULL){
        
        if($value != NULL){
            $this->_set($master, $key, $value);
        }
        
        if (array_key_exists($master, $this->_attributes)) {
            if (array_key_exists($key, $this->_attributes[$master])) {
                return $this->_attributes[$master][$key];
            }
        }
        
        return $value;
        
    }
    
}