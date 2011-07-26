<?php

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
