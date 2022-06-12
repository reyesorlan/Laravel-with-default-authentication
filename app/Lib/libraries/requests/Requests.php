<?php

/**
 * Created by PhpStorm.
 * User: James Fulton
 * Date: 7/12/2017
 * Time: 4:00 PM
 */

class Nookal_Requests extends Nookal_Request
{

    private $baseUrl        = '';
    public $requestUrls    = array(
        //Basic Verification Tools
        'version'                   => '/production/v2/version',
        'verify'                    => '/production/v2/verify',
        //Basic Retrieval tools (locations, practitioners)
        'locations'                 => '/production/v2/getLocations',
        'practitioners'             => '/production/v2/getPractitioners',
        //Retrieve Services/Stock/Inventory elements
        'classTypes'                => '/production/v2/getClassTypes',
        'serviceTypes'              => '/production/v2/getAppointmentTypes',
        'stockList'                 => '/production/v2/getStockList',
        //Get Availabilities
        'appointmentAvailability'   => '/production/v2/getAppointmentAvailabilities',
        'classAvailability'         => '/production/v2/getClassAvailabilities',
        'getClassParticipants'      => '/production/v2/getClassParticipants',
        //Add/Modify Bookings
        'addBooking'                => '/production/v2/addAppointmentBooking',
        'addClassBooking'           => '/production/v2/addClassBooking',
        'cancelAppointment'         => '/production/v2/cancelAppointment',
        'rebookAppointment'         => '/production/v2/rebookAppointment',
        //Patient Tools
        'patients'                  => '/production/v2/getPatients',
        'searchPatients'            => '/production/v2/searchPatients',
        'addPatient'                => '/production/v2/addPatient',
        'editPatient'               => '/production/v2/editPatient',
        'addTreatmentNote'          => '/production/v2/addTreatmentNote',
        'invoices'                  => '/production/v2/getInvoices',
        'treatmentNotes'            => '/production/v2/getTreatmentNotes',
        'cases'                     => '/production/v2/getCases',
        'allCases'                     => '/production/v2/getAllCases',
        'files'                     => '/production/v2/getPatientFiles',
        'fileUrl'                   => '/production/v2/getFileUrl',
        'addCase'                   => '/production/v2/addCase',
        'editCase'                  => '/production/v2/editCase',
        //File uploading components (requires both calls to make the file go live)
        'upload'                    => '/production/v2/uploadFile',
        'activateFile'              => '/production/v2/setFileActive',
        //Logos
        'locationLogo'              => '/production/v2/getLocationLogo',
        'practitionerPhoto'         => '/production/v2/getPractitionerPhoto',
        //Large pull requests (site backup requests)
        'appointments'              => '/production/v2/getAppointments',
        'classes'                   => '/production/v2/getClasses',
        'allTreatmentNotes'         => '/production/v2/getAllTreatmentNotes',
        'allInvoices'               => '/production/v2/getAllInvoices',
        //Custom Requests (requires special API on the Nookal interface side)
        'practitionerTypes'         => '/production/v2/getPractitionerAppointmentTypes',
        'serviceMatrix'             => '/production/v2/getServiceMatrix',
        //Invoices
        'addInvoice'                => '/production/v2/addInvoice',
        'addAccountCredit'          => '/production/v2/addAccountCredit',
        'addItemToInvoice'          => '/production/v2/addItemToInvoice',
        'addPaymentToInvoice'       => '/production/v2/addPaymentToInvoice',
        'deleteItemFromInvoice'     => '/production/v2/deleteItemFromInvoice',
        'deletePaymentFromInvoice'  => '/production/v2/deletePaymentFromInvoice',
        'deleteInvoice'             => '/production/v2/deleteInvoice',
        'getInvoice'                => '/production/v2/getInvoice',
        'getExtras'                 => '/production/v2/getExtras',
        'addExtra'                  => '/production/v2/addPatientExtra'

    );
    /**
     * @var Nookal_API
     */
    private $config;

    /**
     * Nookal_Requests constructor.
     * @param Nookal_API $config
     */
    public function __construct(Nookal_API $config)
    {
        if (is_array($config)) {
            $config = new Nookal_API($config);
        }
        $this->config = $config;
        $this->baseUrl = Nookal_API::url();
    }

    public function testApiKey()
    {

        return Nookal_API::getApiKey();
    }

    /**
     * @param array $config
     * @return array
     * @throws Exception
     */
    private function prepareConfig($config = array())
    {

        $key = Nookal_API::getApiKey();

        if (empty($key)) {

            throw new Exception('API Key required');
        }

        if (empty($config)) {

            $config = array();
        }

        $config['api_key'] = $key;

        return $config;
    }

    /**
     * @param array $config
     * @return Nookal_Verify
     * @throws Exception
     */
    public function verify($config = array())
    {

        return new Nookal_Verify(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['verify']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Services
     * @throws Exception
     */
    public function appointmentTypes($config = array())
    {

        return new Nookal_Services(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['serviceTypes']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Classes
     * @throws Exception
     */
    public function classTypes($config = array())
    {

        return new Nookal_Classes(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['classTypes']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Locations
     * @throws Exception
     */
    public function locations($config = array())
    {

        return new Nookal_Locations(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['locations']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Practitioners
     * @throws Exception
     */
    public function practitioners($config = array())
    {

        return new Nookal_Practitioners(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['practitioners']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Appointment_Availabilities
     * @throws Exception
     */
    public function appointmentAvailabilities($config = array())
    {

        return new Nookal_Appointment_Availabilities(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['appointmentAvailability']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Class_Availabilities
     * @throws Exception
     */
    public function classAvailabilities($config = array())
    {

        return new Nookal_Class_Availabilities(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['classAvailability']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Practitioner_Types
     * @throws Exception
     */
    public function practitionerAppointmentTypes($config = array())
    {

        return new Nookal_Practitioner_Types(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['practitionerAppointmentTypes']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Patients
     * @throws Exception
     */
    public function patients($config = array())
    {

        return new Nookal_Patients(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['patients']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Patients
     * @throws Exception
     */
    public function patientSearch($config = array())
    {

        return new Nookal_Patients(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['searchPatients']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Booking
     * @throws Exception
     */
    public function addBooking($config = array())
    {

        return new Nookal_Booking(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['addBooking']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Booking
     * @throws Exception
     */
    public function addClassBooking($config = array())
    {

        return new Nookal_Booking(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['addClassBooking']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Patient_Response
     * @throws Exception
     */
    public function addPatient($config = array())
    {

        return new Nookal_Patient_Response(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['addPatient']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Patient_Response
     * @throws Exception
     */
    public function editPatient($config = array())
    {

        return new Nookal_Patient_Response(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['editPatient']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Appointments
     * @throws Exception
     */
    public function appointments($config = array())
    {

        return new Nookal_Appointments(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['appointments']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Appointments
     * @throws Exception
     */
    public function classes($config = array())
    {

        return new Nookal_Appointments(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['classes']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Invoices
     * @throws Exception
     */
    public function invoices($config = array())
    {

        return new Nookal_Invoices(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['invoices']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Invoices
     * @throws Exception
     */
    public function allInvoices($config = array())
    {

        return new Nookal_Invoices(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['allInvoices']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Treatment_Notes
     * @throws Exception
     */
    public function treatmentNotes($config = array())
    {

        return new Nookal_Treatment_Notes(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['treatmentNotes']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Treatment_Note_Response
     * @throws Exception
     */
    public function addTreatmentNote($config = array())
    {

        return new Nookal_Treatment_Note_Response(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['addTreatmentNote']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Treatment_Notes
     * @throws Exception
     */
    public function allTreatmentNotes($config = array())
    {

        return new Nookal_Treatment_Notes(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['allTreatmentNotes']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Cases
     * @throws Exception
     */
    public function cases($config = array())
    {

        return new Nookal_Cases(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['cases']
            )
        );
    }

    public function allCases($config = array())
    {

        return new Nookal_Cases(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['allCases']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Cases
     * @throws Exception
     */
    public function addCase($config = array())
    {

        return new Nookal_Cases(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['addCase']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Cases
     * @throws Exception
     */
    public function editCase($config = array())
    {

        return new Nookal_Cases(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['editCase']
            )
        );
    }


    /**
     * @param array $config
     * @return Nookal_Files
     * @throws Exception
     */
    public function files($config = array())
    {

        return new Nookal_Files(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['files']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_File_URL
     * @throws Exception
     */
    public function fileURL($config = array())
    {

        //fileUrl
        return new Nookal_File_URL(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['fileUrl']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Location_Logo
     * @throws Exception
     */
    public function locationLogo($config = array())
    {

        //fileUrl
        return new Nookal_Location_Logo(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['locationLogo']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Practitioner_Photo
     * @throws Exception
     */
    public function practitionerPhoto($config = array())
    {

        //fileUrl
        return new Nookal_Practitioner_Photo(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['practitionerPhoto']
            )
        );
    }


    /**
     * @param array $config
     * @return Nookal_File_Upload|Nookal_Upload|S3_Response
     * @throws Exception
     */
    public function uploadFile($config = array())
    {

        if (empty($config['file_path']) || !file_exists($config['file_path'])) {

            exit('Error: File could not be found');
        }

        $upload = new Nookal_Upload(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['upload']
            )
        );

        $id = $upload->ID();
        if ($upload->status() && !empty($id)) {

            $status = new S3_Response(
                Nookal_Request::s3Upload(
                    $upload->url(),
                    $config['file_path']
                )
            );

            if ($status->status()) {

                return $this->activateFile(
                    [
                        'patient_id' => $config['patient_id'],
                        'file_id'    => $upload->ID()
                    ]
                );
            } else {

                return $status;
            }
        } else {

            return $upload;
        }
    }

    /**
     * @param array $config
     * @return Nookal_File_Upload
     * @throws Exception
     */
    private function activateFile($config = array())
    {

        return new Nookal_File_Upload(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['activateFile']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Matrix
     * @throws Exception
     */
    public function serviceMatrix($config = array())
    {

        //fileUrl
        return new Nookal_Matrix(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['serviceMatrix']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Stock_List
     * @throws Exception
     */
    public function stockList($config = array())
    {

        return new Nookal_Stock_List(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['stockList']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Cancel_Appointment
     * @throws Exception
     */
    public function cancelAppointment($config = array())
    {

        return new Nookal_Cancel_Appointment(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['cancelAppointment']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Cancel_Appointment
     * @throws Exception
     */
    public function rebookAppointment($config = array())
    {

        return new Nookal_Cancel_Appointment(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['rebookAppointment']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Invoice
     * @throws Exception
     */
    public function addInvoice($config = array())
    {

        return new Nookal_Invoice(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['addInvoice']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Invoice
     * @throws Exception
     */
    public function addAccountCredit($config = array())
    {

        return new Nookal_Invoice(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['addInvoice']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Invoice
     * @throws Exception
     */
    public function addPaymentToInvoice($config = array())
    {

        return new Nookal_Invoice(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['addPaymentToInvoice']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Invoice
     * @throws Exception
     */
    public function addItemToInvoice($config = array())
    {

        return new Nookal_Invoice(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['addItemToInvoice']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Invoice
     * @throws Exception
     */
    public function getInvoice($config = array())
    {

        return new Nookal_Invoice(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['getInvoice']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Invoice
     * @throws Exception
     */
    public function deleteItemFromInvoice($config = array())
    {

        return new Nookal_Invoice(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['deleteItemFromInvoice']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Invoice
     * @throws Exception
     */
    public function deletePaymentFromInvoice($config = array())
    {

        return new Nookal_Invoice(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['deletePaymentFromInvoice']
            )
        );
    }

    /**
     * @param array $config
     * @return Nookal_Invoice
     * @throws Exception
     */
    public function deleteInvoice($config = array())
    {

        return new Nookal_Invoice(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['deleteInvoice']
            )
        );
    }

    public function getExtras($config = array())
    {

        return new Nookal_Extras(
            $result = Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['getExtras']
            )
        );
    }

    public function addExtra($config = array())
    {

        return new Nookal_Patients(
            Nookal_Request::request(
                $this->prepareConfig($config),
                $this->baseUrl . $this->requestUrls['addExtra']
            )
        );
    }
}
