<?php


/**
 * Created by PhpStorm.
 * User: James Fulton
 * Date: 7/12/2017
 * Time: 4:05 PM
 */
class Nookal_API extends Nookal_Base {

    /**
     * @var Nookal_API
     */
    public static $global;
    private $apiKey;

    public function __construct($attribs = array())
    {

        foreach ($attribs as $kind => $value) {
            if ($kind == 'apiKey') {
                $this->apiKey = $value;
            }
        }

    }

    public static function version(){

        return NOOKAL_SDK_VERSION;

    }

    /**
     * resets configuration to default
     * @access public
     */
    public static function reset()
    {
        self::$global = new Nookal_API();
    }

    /**
     * @return Nookal_Requests
     */
    public static function gateway()
    {
        return new Nookal_Requests(self::$global);
    }

    public static function apiKey($value=null)
    {
        if (empty($value)) {
            return self::$global->getApiKey();
        }
        self::$global->apiKey = $value;
        return self::$global->apiKey;

    }

    public static function getApiKey(){

        return self::$global->apiKey;

    }

    public static function url(){

        return 'https://api.nookal.com';

    }

}

/**
 * Initialize the Nookal_API class
 */
Nookal_API::reset();
