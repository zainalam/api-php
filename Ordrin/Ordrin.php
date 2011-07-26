<?php
/**
 * Ordr.In PHP Wrapper for the API
 * This is a self-encompasing
 */

class Ordrin {
    private
        $_api_data;

    protected
//        $_email_re = "/^[a-zA-Z0-9._%-+]+@[a-zA-Z0-9._%-]+.[a-zA-Z]{2,6}$/",
//        $_email_re = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$",
        $_email_re = '/^(?!(?>\x22?(?>\x22\x40|\x5C?[\x00-\x7F])\x22?){255,})(?!(?>\x22?\x5C?[\x00-\x7F]\x22?){65,}@)(?>[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+|(?>\x22(?>[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|\x5C[\x00-\x7F])*\x22))(?>\.(?>[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+|(?>\x22(?>[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|\x5C[\x00-\x7F])*\x22)))*@(?>(?>(?!.*[^.]{64,})(?>(?>xn--)?[a-z0-9]+(?>-[a-z0-9]+)*\.){0,126}(?>xn--)?[a-z0-9]+(?>-[a-z0-9]+)*)|(?:\[(?>(?>IPv6:(?>(?>[a-f0-9]{1,4}(?>:[a-f0-9]{1,4}){7})|(?>(?!(?:.*[a-f0-9][:\]]){8,})(?>[a-f0-9]{1,4}(?>:[a-f0-9]{1,4}){0,6})?::(?>[a-f0-9]{1,4}(?>:[a-f0-9]{1,4}){0,6})?)))|(?>(?>IPv6:(?>(?>[a-f0-9]{1,4}(?>:[a-f0-9]{1,4}){5}:)|(?>(?!(?:.*[a-f0-9]:){6,})(?>[a-f0-9]{1,4}(?>:[a-f0-9]{1,4}){0,4})?::(?>[a-f0-9]{1,4}(?>:[a-f0-9]{1,4}){0,4}:)?)))?(?>25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])(?>\.(?>25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])){3}))\]))$/isD',
        $_cc_re = "/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/";

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
        echo print_r($data,true);
        echo "---------------------------------------------\n";
        echo "DEBUG :: Request ended.. \n";
    }

    /* Private Functions */
}





