<?php
/**
 * Ordr.In PHP Wrapper for the API
 * This is a self-encompasing
 */

class Ordrin {
    private
        $_api_data;

    protected
        $_num_re = "^\s*\d+\s*$",
        $_email_re = "^[a-zA-Z0-9._%-+]+@[a-zA-Z0-9._%-]+.[a-zA-Z]{2,6}$",
        $_cc_re = "^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$";

    static 
        $_errors;

    function __construct($key, $url) {
        $this->__set('_url', $url);
        $this->__set('_key', $key);
    }

    function setCurrAcct($email, $pass) {
    }

    
    /** -- Magic Functions -- **/
    function __set($name, $value) {
        echo "DEBUG: setting $name as $value\n";
        $this->_api_data[$name] = $value;
    }

    function __get($name) {
        echo "DEBUG: getting $name\n";
        return $this->_api_data[$name];
    }


    /* Protected Functions */
    protected  function _request($data) {
        echo "DEBUG :: Request started.. \n";
        echo "---------------------------------------------\n";
        echo print_r($data);
        echo "---------------------------------------------\n";
        echo "DEBUG :: Request ended.. \n";
    }

    /* Private Functions */
}

/* Money Class */
class Money extends Ordrin {
    private $amount = 0;

    function __construct($amt) {
        echo "DEBUG: in constructor\n";
        if (!is_numeric($amt)) {
            echo "DEBUG: not numeric\n";
            parent::$_errors[]= "Money - Validation - must be a number, we got ($amt)";
        } else {
            $this->amount = $amt;
        }
    }

    function _convertForAPI() {
        return $this->amount * 100.00;
    }
}

/* Order API */
class Order extends Ordrin {
    function __construct() {

    }
    
    function submit($id) {

    }
}

/* Address Class */
class Address extends Ordrin {
    private
        $nick,
        $street,
        $street2,
        $city,
        $zip,
        $state,
        $phone;

    function __construct($street, $city, $zip, $street2, $state, $phone, $nick) {
        $this->__set('street', $street);
        $this->__set('city', $city);
        $this->__set('zip', $zip);
        $this->__set('street2', $street2);
        $this->__set('state', $state);
        $this->__set('phone', $phone);
        $this->__set('nick', $nick);
    }

    function validate($element = "all") {
        
    }

    function __set($name, $value) {
        $this->$name = $value;
    }

    function __get($name) {
        return $this->$name;
    }
}

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
        if (!preg_match($this->_num_re, $rID)) {
            parent::$_errors[] = "Restaurant DeliveryCheck - Validation - restaurant ID (invalid, must be numeric) we got ($rID)";
        }

        $addr->validate();
        $this->_request(array(
                             'type' => 'GET',
                             'method' => 'dc',
                             'id' => $rID,
                             'dt', $dT->convertForAPI(),
                             'address' => $addr
                        ));
    }

    function deliveryFee($rID, $subtotal, $tip, $dT, $addr) {
        //TODO: Valdation
        // - some psudeo code
        if (!preg_match($this->_num_re, $rID)) {
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

        if (!preg_match($this->_num_re, $rID)) {
            parent::$_errors[] = "Restaurant DeliveryCheck - Validation - restaurant ID (invalid, must be numeric) we got ($rID)";
        }

        $this->_request(array(
                             'type' => 'GET',
                             'method' => 'rd',
                             'id' => $rID
                        ));
    }
}


/* Date and Time Class */

class dT extends Ordrin {
    private
        $_asap = false,
        $_date;

    function __construct() {
        $this->_date = getdate(); // NOW
    }

    function asap () {
        $this->_asap = true;
    }

    function _strAPI($element) {
        switch ($element) {
            case 'month':
                if ($this->_date['mon'] < 10) return "0" . $this->_date['mon'];
                break;
            case 'day':
                if ($this->_date['mday'] < 10) return "0" . $this->_date['mday'];
                break;
            case 'hour':
                if ($this->_date['hours'] < 10) return "0" . $this->_date['hours'];
                break;
            case 'minute':
                if ($this->_date['minutes'] < 10) return "0" . $this->_date['minutes'];
                break;
            default:
                return 0;
        }

        return 0; // Secondary Default
    }

    function _convertForAPI() {
        if ($this->_asap) return "ASAP";

        return $this->_date['mon'] . "-" . $this->_date['mday'] . "+" . $this->_date['hours'] . ':' . $this->_date['minutes'];
    }
}