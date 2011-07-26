<?php

/* Restuarant API */
class Restaurant extends Ordrin {

    function __construct() {
        // reserved
    }

    function deliveryList($dt, $addr) {
        $addr->validate();

        $this->_request(array(
                             'type' => 'GET',
                             'method' => 'dl',
                             $dt->_convertForAPI(),
                             $addr->__get('zip'),
                             $addr->__get('city'),
                             $addr->__get('street')
                        ));
    }

    function deliveryCheck($rID, $dT, $addr) {
        //TODO: Check nums here
        // - some psudeo code
        if (!is_numeric($rID)) {
            parent::$_errors[] = "Restaurant DeliveryCheck - Validation - restaurant ID (invalid, must be numeric) we got ($rID)";
        }

        $addr->validate();
        $this->_request(array(
                             'type' => 'GET',
                             'method' => 'dc',
                             'id' => $rID,
                             'dt', $dT->_convertForAPI(),
                             'address' => $addr
                        ));
    }

    function deliveryFee($rID, $subtotal, $tip, $dT, $addr) {
        //TODO: Valdation
        // - some psudeo code
        if (!is_numeric($rID)) {
            parent::$_errors[] = "Restaurant DeliveryCheck - Validation - restaurant ID (invalid, must be numeric) we got ($rID)";
        }

        $addr->validate();
        $this->_request(array(
                             'type' => 'GET',
                             'method' => 'fee',
                             'id' => $rID,
                             'subtotal' => $subtotal->_convertForAPI(),
                             'tip' => $tip->_convertForAPI(),
                             'dt' => $dT->_convertForAPI(),
                             'address' => $addr /* Push in the whole object so it's easier */
                        ));
    }

    function details($rID) {
        //TODO: Validation
        // - some psudeo code

        if (!is_numeric($rID)) {
            parent::$_errors[] = "Restaurant DeliveryCheck - Validation - restaurant ID (invalid, must be numeric) we got ($rID)";
        }

        $this->_request(array(
                             'type' => 'GET',
                             'method' => 'rd',
                             'id' => $rID
                        ));
    }
}
