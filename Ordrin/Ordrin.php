<?php
/**
 * Ordr.In PHP Wrapper for the API
 * This is a self-encompasing
 */

/* This is the lazy loading portion */
function __autoload($name) {
    require_once($name . '.php');
}

class Ordrin {
    private
        $_staticVars = array('email','password'),
        $_api_data;

    protected
        $_cc_re = "/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/";

    static
        $_email,
        $_password,
        $_errors;

    function __construct($key, $url) {
        $this->__set('_url', $url);
        $this->__set('_key', $key);
    }

    function setCurrAcct($email, $pass) {
//        if (!preg_match($this->_email_re, $email)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            // Not Found
            self::$_errors[] = "Ordrin.php setCurrAcct - validation - email invalid ($email)";
        } else {
            $this->__set('email', $email);
            $this->__set('password', $pass);
        }
    }

    
    /** -- Magic Functions -- **/
    function __set($name, $value) {

        echo "DEBUG: setting $name as $value\n";
        if (in_array($name, $this->_staticVars)) {
            echo 'Debug :: Static Var ' . $name . "\n";
            switch ($name) {
                case 'email':
                    self::$_email = $value;
                    break;
                case 'password':
                    self::$_password = $value;
                    break;
            }
        } else
            $this->_api_data[$name] = $value;
    }

    function __get($name) {
        echo "DEBUG: getting $name\n";
        if (in_array($name, $this->_staticVars)) {
            echo 'Debug :: Static Var ' . $name . "\n";
            switch ($name) {
                case 'email':
                    return self::$_email;
                    break;
                case 'password':
                    return self::$_password;
                    break;
            }
        } else
            return $this->_api_data[$name];
    }


    /* Protected Functions */
    protected  function _request($data) {
        echo "DEBUG :: Request started.. \n";
        echo "---------------------------------------------\n";
        echo print_r($data,true);
        echo "---------------------------------------------\n";
        echo "DEBUG :: Request ended.. \n";
    }

    /* Private Functions */
}





