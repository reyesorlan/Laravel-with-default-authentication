<?php
namespace App\Lib;
/**
 * Created by PhpStorm.
 * User: James Fulton
 * Date: 7/12/2017
 * Time: 3:24 PM
 */

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

require_once 'libraries/Base.php';
require_once 'libraries/Request.php';
require_once 'libraries/requests/Requests.php';
require_once 'libraries/requests/Response.php';
require_once 'libraries/types/Type.php';
require_once 'libraries/types/Class.php';
require_once 'libraries/types/Service.php';
require_once 'libraries/types/Patients.php';
require_once 'libraries/types/Practitioner.php';
require_once 'libraries/types/PractitionerTypes.php';
require_once 'libraries/types/Locations.php';
require_once 'libraries/types/Address.php';
require_once 'libraries/types/Contacts.php';
require_once 'libraries/types/Invoices.php';
require_once 'libraries/types/Appointments.php';
require_once 'libraries/types/Verify.php';
require_once 'libraries/types/TreatmentNotes.php';
require_once 'libraries/types/Cases.php';
require_once 'libraries/types/Booking.php';
require_once 'libraries/types/Availability.php';
require_once 'libraries/types/Files.php';
require_once 'libraries/types/Upload.php';
require_once 'libraries/types/Matrix.php';
require_once 'libraries/types/Stock.php';
require_once 'libraries/types/S3.php';
require_once 'libraries/types/Extras.php';
require_once 'libraries/API.php';

if (version_compare(PHP_VERSION, '5.4.0', '<')) {
    throw new Exception('PHP version >= 5.4.0 required');
}


function requireDependencies() {
    $requiredExtensions = array('curl');
    foreach ($requiredExtensions AS $ext) {
        if (!extension_loaded($ext)) {
            throw new Exception('The Nookal SDK requires the ' . $ext . ' extension.');
        }
    }
}

requireDependencies();
