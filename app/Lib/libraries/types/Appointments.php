<?php
/**
 * Created by PhpStorm.
 * User: James Fulton
 * Date: 8/12/2017
 * Time: 1:15 PM
 */


class Nookal_Appointment extends Nookal_Base {

    public function __construct($config = NULL)
    {

        if(!empty($config['ID'])){

            $this->ID($config['ID']);

            if(!empty($config['patientID'])){
                $this->patientID($config['patientID']);
                $this->arrived($config['arrived']);
                $this->invoiceGenerated($config['invoiceGenerated']);
            }else{
                print_r($config);die();
            }


            $this->date($config['appointmentDate']);
            $this->startTime($config['appointmentStartTime']);
            $this->endTime($config['appointmentEndTime']);
            $this->locationID($config['locationID']);
            $this->type($config['appointmentType']);
            $this->typeID($config['appointmentTypeID']);
            $this->practitionerID($config['practitionerID']);
            $this->emailReminderSent($config['emailReminderSent']);
            $this->DNA($config['DNA']);
            $this->cancelled($config['cancelled']);
            $this->cancellationDate($config['cancellationDate']);
            $this->notes($config['Notes']);
            $this->dateModified($config['lastModified']);
            $this->dateCreated($config['dateCreated']);


        }

    }

    public function ID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function patientID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function date($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function startTime($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function endTime($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function locationID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function type($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function typeID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function practitionerID($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function emailReminderSent($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function arrived($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function DNA($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function cancelled($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function cancellationDate($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function notes($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function dateModified($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function dateCreated($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function invoiceGenerated($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function participants($value = NULL){
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

}

class Nookal_Class_Participant extends Nookal_Response
{

    public function __construct($config = NULL)
    {

        parent::__construct($config);

        if (!empty($config['patientID'])) {

            $this->patientID($config['patientID']);
            $this->arrived($config['arrived']);
            $this->DNA($config['DNA']);
            $this->cancelled($config['cancelled']);
            $this->cancellationDate($config['cancellationDate']);
            $this->lastModified($config['lastModified']);
            $this->invoiceGenerated($config['invoiceGenerated']);
            $this->caseID($config['caseID']);

        }

    }

    public function patientID($value = NULL)
    {
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function arrived($value = NULL)
    {
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function DNA($value = NULL)
    {
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function cancelled($value = NULL)
    {
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function cancellationDate($value = NULL)
    {
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function lastModified($value = NULL)
    {
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function invoiceGenerated($value = NULL)
    {
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }


    public function caseID($value = NULL)
    {
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

}


class Nookal_Appointments extends Nookal_Response {

    private $appointments = array();

    public function __construct($config = NULL)
    {

        parent::__construct($config);

        if(!empty($config['data']['results']['appointments'])){

            $this->addChildren($config['data']['results']['appointments']);

        }else if(!empty($config['data']['results']['classes'])){

            $this->addChildren($config['data']['results']['classes']);

        }

    }

    public function addChildren($appointments){

        if(!empty($appointments)){

            foreach($appointments as $key=>$value){

                $this->addChild($value);

            }

        }

    }

    private function addChild($appointment){

        $this->appointments[] = new Nookal_Appointment($appointment);

    }

    public function children(){

        return $this->appointments;

    }

    public function count(){

        return count($this->appointments);

    }

}

class Nookal_Cancel_Appointment extends Nookal_Response
{

    public function __construct($config = NULL)
    {

        parent::__construct($config);

        if (!empty($config['ID'])) {

            $this->ID($config['ID']);
            $this->patientID($config['patientID']);

        }

    }

    public function ID($value = NULL)
    {
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function patientID($value = NULL)
    {
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

}

class Nookal_Rebook_Appointment extends Nookal_Response
{

    public function __construct($config = NULL)
    {

        parent::__construct($config);

        if (!empty($config['ID'])) {

            $this->ID($config['ID']);
            $this->patientID($config['patientID']);

        }

    }

    public function ID($value = NULL)
    {
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

    public function patientID($value = NULL)
    {
        return $this->__build(__METHOD__, __FUNCTION__, $value);
    }

}
