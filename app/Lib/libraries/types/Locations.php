<?php
/**
 * Created by PhpStorm.
 * User: James Fulton
 * Date: 8/12/2017
 * Time: 10:54 AM
 */

class Nookal_Location extends Nookal_Base{
    
    private $address;
    
    public function __construct($config = NULL)
    {
        
        if(!empty($config['ID'])){
            
            $this->ID($config['ID']);
            $this->name($config['Name']);
            $this->addAddress(
                $config['AddressLine1'],
                $config['AddressLine2'],
                $config['AddressLine3'],
                $config['City'],
                $config['State'],
                $config['Country'],
                $config['Postcode']
            );
            $this->timezone($config['Timezone']);
        }
        
    }

    public function ID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function name($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }
    
    public function timezone($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }
    
    private function addAddress($line1, $line2, $line3, $city, $state, $country, $postcode){
        
        $this->address = new Nookal_Address(
            array(
                'AddressLine1'  => $line1,
                'AddressLine2'  => $line2,
                'AddressLine3'  => $line3,
                'City'          => $city,
                'State'         => $state,
                'Country'       => $country,
                'Postcode'      => $postcode,
            )
        );
        
    }

    public function address(){
        
        return $this->address;

    }

}

class Nookal_Locations extends Nookal_Response {

    /**
     * @var array (Nookal_Location)
     */
    private $locations = array();
    
    public function __construct($config = NULL)
    {
        
        parent::__construct($config);

        if(!empty($config['data']['results']['locations'])){

            $this->addChildren($config['data']['results']['locations']);

        }

    }

    public function addChildren($locations){

        if(!empty($locations)){

            foreach($locations as $key=>$value){

                $this->addChild($value);

            }

        }

    }
    
    private function addChild($location){
        
        $this->locations[] = new Nookal_Location($location);
        
    }
    
    public function children(){
        
        return $this->locations;
        
    }
    
    public function count(){
        
        return count($this->locations);
        
    }

}

class Nookal_Location_Logo extends Nookal_Response
{

    public function __construct($config = NULL)
    {

        parent::__construct($config);
        
        if(!empty($config['file_url'])){

            $this->url($config['file_url']);

        }

    }

    public function url($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

}