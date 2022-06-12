<?php
/**
 * Created by PhpStorm.
 * User: James Fulton
 * Date: 8/12/2017
 * Time: 1:31 PM
 */

class Nookal_Account_Credit extends Nookal_Base {

    public function __construct($config = NULL)
    {
        if (!empty($config['data']['results']['credit']['ID'])) {
            $config = $config['data']['results']['credit'];
        }
        if(!empty($config['ID'])) {

            $this->ID($config['ID']);
            $this->patientID($config['patient_id']);
            $this->invoiceID($config['invoice_id']);
            $this->date($config['date']);
            $this->locationID($config['locationID']);
            $this->amount($config['amount']);
            $this->method($config['method']);
        }
    }

    public function ID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function patientID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function method($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function amount($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function invoiceID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function date($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function locationID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

}

class Nookal_Invoice extends Nookal_Base {
    
    private $entries = array();
    private $payments = array();
    
    public function __construct($config = NULL)
    {
        if(!empty($config['data']['results']['invoice']['ID'])){
            $config = $config['data']['results']['invoice'];
        }
        
        if(!empty($config['ID'])){

            $this->ID($config['ID']);
            $this->invoiceNumber($config['invoiceNumber']);
            $this->patientID($config['patientID']);
            $this->practitionerID($config['providerID']);
            $this->dateCreated($config['dateCreated']);
            $this->locationID($config['locationID']);
            $this->isThirdPartyInvoice((!empty($config['isThirdPartyInvoice']) ? true : false));
            $this->invoiceNotes($config['invoiceNotes']);
            $this->accountNotes($config['accountNotes']);
            $this->otherNotes($config['adhocNotes']);
            
            $this->account(
                array(
                    'payments'      => $config['totalPayments'],
                    'debits'        => $config['totalDebits'],
                    'adjustments'   => $config['totalAdjustments'],
                    'discounts'     => $config['totalDiscounts'],
                    'credits'       => $config['totalCredits'],
                    'refunds'       => $config['totalRefunds'],
                    'balance'       => $config['totalBalance'],
                )
            );
            
            if(!empty($config['isThirdPartyInvoice'])){
                $this->contact(new Nookal_Contact(array(
                    'ID'        => $config['contactID'],
                    'title'     => $config['contactTitle'],
                    'firstName' => $config['contactFirstName'],
                    'lastName'  => $config['contactLastName'],
                    'company'   => $config['contactCompany'],
                )));
            }
            
            if(!empty($config['details']['entries'])){
                foreach($config['details']['entries'] as $key=>$value){
                    $this->addEntry($value);
                }
            }
            if(!empty($config['details']['payments'])){
                foreach($config['details']['payments'] as $key=>$value){
                    $this->addPayment($value);
                }
            }
        }
      
    }
    
    public function ID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function invoiceNumber($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function patientID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function practitionerID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function dateCreated($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function locationID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function isThirdPartyInvoice($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function contact($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function invoiceNotes($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function accountNotes($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function otherNotes($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }
    
    public function account($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    private function addEntry($entry){

        $this->entries[] = new Nookal_Entries($entry);

    }

    public function entries(){

        return $this->entries;

    }

    private function addPayment($payment){

        $this->payments[] = new Nookal_Payments($payment);

    }

    public function payments(){

        return $this->payments;

    }

}

class Nookal_Payments extends Nookal_Base{
    
    function __construct($config = NULL){
        
        if(!empty($config['payment_id'])){
            $this->ID($config['payment_id']);
            $this->void($config['void']);
            $this->date($config['date']);
            $this->amount($config['amount']);
            $this->group($config['group']);
            $this->method($config['method']);
        }
        
    }

    public function ID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function void($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }
    
    public function date($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function amount($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function method($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function group($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

}

class Nookal_Entries extends Nookal_Base{
    
    function __construct($config = NULL){

        if(!empty($config['entry_id'])){
            $this->ID($config['entry_id']);
            $this->void($config['void']);
            $this->date($config['date']);
            $this->name($config['name']);
            $this->description($config['description']);
            $this->qty($config['qty']);
            $this->subtotal($config['subtotal']);
            $this->tax($config['tax']);
            $this->total($config['total']);
        }

    }
    
    public function ID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function void($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function date($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function name($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function description($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function qty($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function subtotal($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function tax($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function total($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }
    
}

class Nookal_Invoices extends Nookal_Response {
    
    private $invoices;
    
    public function __construct($config)
    {
        
        parent::__construct($config);
        
        if(!empty($config['data']['results']['invoices'])){

            $this->addChildren($config['data']['results']['invoices']);

        }

    }

    public function addChildren($invoices){

        if(!empty($invoices)){

            foreach($invoices as $key=>$value){

                $this->addChild($value);

            }

        }

    }

    private function addChild($invoice){

        $this->invoices[] = new Nookal_Invoice($invoice);

    }

    public function children(){

        return $this->invoices;

    }
    
    public function count(){
        
        return count($this->invoices);
        
    }

}