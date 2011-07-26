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
        $this->__set('street', urlencode($street));
        $this->__set('city', urlencode($city));
        $this->__set('zip', $zip);
        $this->__set('street2', urlencode($street2));
        $this->__set('state', $state);
        $this->__set('phone', $phone);
        $this->__set('nick', $nick);
    }

    function validate($element = "all") {
        echo "DEBUG:: Address validate for $element\n";
        if ($element == 'zip' && !preg_match('/(^\d{5}$)|(^\d{5}-\d{4}$)/', $this->__get($element))) {
            parent::$_errors[] = 'Address - validation - zip code (invalid) (' . $this->__get($element) . ')';
        } elseif ($element == 'phone' && !preg_match('/(^\(?(\d{3})\)?[- .]?(\d{3})[- .]?(\d{4})$)/', $this->__get($element))) {
            parent::$_errors[] = 'Address - validation - phone number (invalid) (' . $this->__get($element) . ')';
        } elseif ($element == 'city' && !preg_match('/[A-z.-]/', $this->__get($element))) {
            parent::$_errors[] = 'Address - validation - city (invalid, only letters/spaces allowed) (' . $this->__get($element) . ')';
        } elseif ($element == 'state' && !preg_match('/^([A-z]){2}$/', $this->__get($element))) {
            parent::$_errors[] = 'Address - validation - state (invalid, only letters allowed and must be passed as two-letter abbreviation) (' . $this->__get($element) . ')';
        } else {
            // do ALL validation
            if (!preg_match('/(^\d{5}$)|(^\d{5}-\d{4}$)/', $this->__get('zip'))) {
                parent::$_errors[] = 'Address - validation - zip code (invalid) (' . $this->__get('zip') . ')';
            } elseif (!preg_match('/(^\(?(\d{3})\)?[- .]?(\d{3})[- .]?(\d{4})$)/', $this->__get('phone'))) {
                parent::$_errors[] = 'Address - validation - phone number (invalid) (' . $this->__get('phone') . ')';
            } elseif (!preg_match('/[A-z.-]/', $this->__get('city'))) {
                parent::$_errors[] = 'Address - validation - city (invalid, only letters/spaces allowed) (' . $this->__get('city') . ')';
            } elseif (!preg_match('/^([A-z]){2}$/', $this->__get('state'))) {
                parent::$_errors[] = 'Address - validation - state (invalid, only letters allowed and must be passed as two-letter abbreviation) (' . $this->__get('state') . ')';
            }
        }
    }

    function _convertForAPI() {
        return $this->__get('zip') . '/' . $this->__get('city') . '/' . $this->__get('street');
    }

    function __set($name, $value) {
        $this->$name = $value;
    }

    function __get($name) {
        return $this->$name;
    }
}
