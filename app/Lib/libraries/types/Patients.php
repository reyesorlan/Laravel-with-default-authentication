<?php
/**
 * Created by PhpStorm.
 * User: James Fulton
 * Date: 8/12/2017
 * Time: 11:30 AM
 */
class Nookal_Patient extends Nookal_Base{
    
    private $address, $postalAddress;
    
    public function __construct($config = NULL)
    {
        if(!empty($config['ID'])){
            
            $this->ID($config['ID']);
            $this->title($config['Title']);
            $this->firstName($config['FirstName']);
            $this->middleName($config['MiddleName']);
            $this->nickName($config['Nickname']);
            $this->lastName($config['LastName']);
            $this->DOB($config['DOB']);
            $this->notes($config['Notes']);
            $this->alerts($config['Alerts']);
            $this->gender($config['Gender']);

            $this->consent($config['consent']);
            $this->occupation($config['Occupation']);
            $this->employer($config['Employer']);
            $this->category($config['category']);
            $this->locationID($config['LocationID']);
            $this->allowOnlineBookings($config['allowOnlineBookings']);
            // $this->healthFundData($config['healthFundData']);

            $this->privateHealthNo($config['PrivateHealthNo']);
            $this->privateHealthType($config['PrivateHealthType']);
            $this->pensionNo($config['PensionNo']);
            $this->allergies($config['allergies']);

            $this->active($config['active']);
            $this->deceased($config['deceased']);
            //Contacts
            $this->email($config['Email']);
            $this->mobile($config['Mobile']);
            $this->home($config['Home']);
            $this->work($config['Work']);
            $this->fax($config['Fax']);

            $this->addAddress(
                $config['Addr1'], 
                $config['Addr2'], 
                $config['Addr3'],
                $config['City'],
                $config['State'],
                $config['Country'],
                $config['Postcode']
            );

            $this->addPostalAddress(
                $config['Postal_Addr1'],
                $config['Postal_Addr2'],
                $config['Postal_Addr3'],
                $config['Postal_City'],
                $config['Postal_State'],
                $config['Postal_Country'],
                $config['Postal_Postcode']
            );

            $this->dateCreated($config['DateCreated']);
            $this->dateModified($config['DateModified']);
            $this->onlineCode($config['onlineQuickCode']);
            
            if(!empty($config['extras'])){
                $this->extras(new Nookal_Patient_Extras($config['extras']));
            }
            
        }
        
    }

    public function active($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function deceased($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function ID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function onlineCode($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function home($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function work($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function fax($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function privateHealthType($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function privateHealthNo($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function pensionNo($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function allergies($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }


    public function title($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function healthFundData($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function consent($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function occupation($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function employer($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function category($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function locationID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function allowOnlineBookings($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function firstName($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function middleName($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function nickName($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function lastName($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function DOB($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function gender($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function email($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function mobile($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function extras($value = NULL){
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

    private function addPostalAddress($line1, $line2, $line3, $city, $state, $country, $postcode){

        $this->postalAddress = new Nookal_Address(
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

    public function postalAddress(){

        return $this->postalAddress;

    }

    public function notes($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function alerts($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function dateCreated($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function dateModified($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }
    
}

class Nookal_Patients extends Nookal_Response {
     
    private $patients = array();
    
    public function __construct($config = NULL)
    {
        
        parent::__construct($config);
        
        if(!empty($config['data']['results']['patients'])){
            
            $this->addChildren($config['data']['results']['patients']);
            
        }
        
    }

    public function addChildren($patients){

        if(!empty($patients)){

            foreach($patients as $key=>$value){

                $this->addChild($value);

            }

        }

    }

    private function addChild($patient){

        $this->patients[] = new Nookal_Patient($patient);

    }

    /**
     * @return array (Nookal_Patient)
     */
    public function children(){

        return $this->patients;

    }

    public function count(){

        return count($this->patients);

    }


}

class Nookal_Patient_Response extends Nookal_Response {
    
    public function __construct($config = NULL)
    {
        
        parent::__construct($config);
        
        if(!empty($config['data']['results']['patient_id'])){
            
            $this->patientID($config['data']['results']['patient_id']);
            
        }
        
    }
    

    public function patientID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

}

class Nookal_Patient_Extras extends Nookal_Base {
    
    public $extras = array();

    public function __construct($config = NULL)
    {

        if(!empty($config)){
            
            foreach($config as $key=>$value){
                
                $this->extras[] = new Nookal_Patient_Extra($value['name'], $value['answers']);
                
            }
            
        }

    }
    
    public function count(){
        
        return count($this->extras);
        
    }
    
    public function extras(){
        
        return $this->extras;
        
    }
    
}

class Nookal_Patient_Extra extends Nookal_Base {

    public function __construct($name, $answers)
    {
        $this->name($name);
        $this->answers($answers);
    }

    public function name($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }
    
    public function answers($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }
    
}