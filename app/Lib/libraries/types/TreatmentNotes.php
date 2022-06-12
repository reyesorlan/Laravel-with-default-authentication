<?php
/**
 * Created by PhpStorm.
 * User: James Fulton
 * Date: 11/12/2017
 * Time: 9:38 AM
 */

class Nookal_Treatment_Note extends Nookal_Base {

    public function __construct($config = NULL)
    {

        if(!empty($config['noteID'])){

            if(empty($config['html'])){
                $config['html'] = '';
            }
            $this->ID($config['noteID']);
            $this->patientID($config['clientID']);
            $this->caseID($config['caseID']);
            $this->practitionerID($config['practitionerID']);
            $this->html($config['html']);
            $this->answers($config['answers']);
            $this->template($config['template']);
            
        }

    }

    public function ID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function patientID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }


    public function practitionerID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function caseID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function html($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function answers($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function template($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }
    
}

class Nookal_Treatment_Notes extends Nookal_Response
{

    /**
     * @var array (Nookal_Location)
     */
    private $notes = array();

    public function __construct($config = NULL)
    {

        parent::__construct($config);
        
        if(!empty($config['data']['results']['notes'])){

            $this->addChildren($config['data']['results']['notes']);

        }

    }

    public function addChildren($notes){

        if(!empty($notes)){

            foreach($notes as $key=>$value){

                $this->addChild($value);

            }

        }

    }

    private function addChild($note){

        $this->notes[] = new Nookal_Treatment_Note($note);

    }

    public function children(){

        return $this->notes;

    }

    public function count(){

        return count($this->notes);

    }


}

class Nookal_Treatment_Note_Response extends Nookal_Response {

    public function __construct($config = NULL)
    {

        parent::__construct($config);

        if(!empty($config['data']['results']['note_id'])){

            $this->noteID($config['data']['results']['note_id']);

        }

    }

    public function noteID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

}