<?php
/**
 * Created by PhpStorm.
 * User: James Fulton
 * Date: 7/12/2017
 * Time: 3:38 PM
 */

class Nookal_Service extends Nookal_Type {

    public function __construct($config = NULL)
    {
        
        if(!empty($config['ID'])){ 
            
            parent::ID($config['ID']);
            parent::name($config['Name']);
            parent::description($config['Description']);
            parent::duration($config['Duration']);
            parent::price($config['Price']);
            parent::hasTax((!empty($config['hasTax']) ? true : false));
            parent::type('Consultation');
            parent::locations($config['Locations']);
            
        }
        
    }

}

class Nookal_Services extends Nookal_Types {

    public function __construct($config = NULL)
    {

        parent::__construct($config);

        if(!empty($config['data']['results']['services'])){

            $this->addChildren($config['data']['results']['services']);

        }

    }

    public function addChildren($services){

        if(!empty($services)){

            foreach($services as $key=>$value){

                $this->addChild($value);

            }

        }

    }

    private function addChild($config){

        $child = new Nookal_Service($config);
        parent::setChild($child->ID(), $child);

    }
    
    public function count(){
        
        return count(parent::children());
        
    }

}