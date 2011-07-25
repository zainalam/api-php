<?php
/**
 * Ordr.In PHP Wrapper for the API
 * This is a self-encompasing
 */

class Ordrin {
    private
        $_api_data;

    var
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


    /* Private Functions */
}

/* Money Class */
class Money  extends Ordrin {
    private $amount = 0;

    function __construct($amt) {
        if (!is_numeric($amt)) {
            $this->_errors[] = "Money - Validation - must be a number, we got ($amt)";
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