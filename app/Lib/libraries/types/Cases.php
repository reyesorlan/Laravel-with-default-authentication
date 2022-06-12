<?php
/**
 * Created by PhpStorm.
 * User: James Fulton
 * Date: 11/12/2017
 * Time: 12:15 PM
 */

class Nookal_Case extends Nookal_Base {

    private $payers = array();

    public function __construct($config = NULL)
    {

        if(!empty($config['ID'])){

            $this->ID($config['ID']);
            $this->title($config['title']);
            $this->status($config['status']);

            $this->referrerDetails($config['ReferrerDetails']);
            $this->provider($config['providerName']);
            $this->referrer($config['referrerName']);
            $this->notes($config['Notes']);

            $this->addPayers($config['payers']);
            
        }

    }

    public function ID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function title($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function status($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function provider($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function referrer($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function referrerDetails($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function notes($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function addPayers($payers){
        if(!empty($payers)){
            foreach($payers as $value){
                $this->payers[] = new Nookal_Payer($value);
            }
        }
    }

    public function payers(){
        return $this->payers;
    }


}

class Nookal_Cases extends Nookal_Response {
    
    /**
     * @var array (Nookal_Location)
     */
    private $cases = array();

    public function __construct($config = NULL)
    {

        parent::__construct($config);

        if(!empty($config['data']['results']['cases'])){

            $this->addChildren($config['data']['results']['cases']);

        }

    }

    public function addChildren($cases){

        if(!empty($cases)){

            foreach($cases as $key=>$value){

                $this->addChild($value);

            }

        }

    }

    private function addChild($case){

        $this->cases[] = new Nookal_Case($case);

    }

    public function children(){

        return $this->cases;

    }

    public function count(){

        return count($this->cases);

    }

}

class Nookal_Payer extends Nookal_Base{


    public function __construct($config = NULL)
    {

        if(!empty($config['ID'])){

            $this->ID($config['ID']);
            $this->payer($config['payer']);
            $this->status($config['Status']);

            $this->referralDate($config['ReferralDate']);
            $this->reference($config['Reference']);
            $this->dateOfInjury($config['DateOfInjury']);
            $this->sessionsApproved($config['Sessions_Approved']);
            $this->sessionsCompleted($config['Sessions_Completed']);
            $this->expiry($config['ExpiryDate']);
            $this->notes($config['Notes']);

            $this->caseManager($config['caseManager']);
            $this->referrer($config['referrer']);

        }

    }

    public function ID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function payer($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function status($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function referralDate($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function reference($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function dateOfInjury($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function sessionsApproved($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function sessionsCompleted($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function expiry($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function notes($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function caseManager($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function referrer($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }


}