<?php
class User extends Ordrin {

    function __construct() {
        // Placeholder
    }
    
    function makeAcct($email, $password, $fName, $lName) {
        $this->_request(array(
                             'type' => 'POST',
                             'method' => 'uN',
                             'email' => $email,
                             'password' => $password,
                             'first_name' => $fName,
                             'last_name' => $lName
                        ));
    }

    function getAcct() {
        $this->_request(array(
                             'type' => 'GET',
                             'method' => 'u',
                             'email' => $this->__get('email')
                        ));
    }

    function getAddress($addrNick = '') {
        //TODO: What is addrs ?
        if (!empty($addrNick)) {
            $this->_request(array(
                                 'type' => 'GET',
                                 'method' => 'u',
                                 'email' => $this->__get('email'),
                                 'addrs' => '',
                                 'nick' => $addrNick
                            ));
        } else {
            $this->_request(array(
                                 'type' => 'GET',
                                 'method' => 'u',
                                 'email' => $this->__get('email'),
                                 'addrs' => ''
                            ));

        }
    }

    function updateAddress($addr) {
        $addr->validate();

        $this->_request(array(
                             'type' => 'PUT',
                             'method' => 'u',
                             'email' => $this->__get('email'),
                             'addrs' => '',
                             'address' => $addr
                        ));
    }

    function deleteAddress($addrNick) {
        $this->_request(array(
                            'type' => 'DELETE',
                            'method' => 'u',
                            'email' => $this->__get('email'),
                            'addrs' => '',
                            'nick' => $addrNick
                        ));
    }

    function getCard($cardNick = '') {
        if (!empty($cardNick)) {
            $this->_request(array(
                                 'type' => 'GET',
                                 'method' => 'u',
                                 'email' => $this->__get('email'),
                                 "ccs" => $cardNick
                            ));
        } else {
            $this->_request(array(
                                 'type' => 'GET',
                                 'method' => 'u',
                                 'email' => $this->__get('email'),
                                 "ccs" => ''
                            ));
        }
    }

    function updateCard($cardNick, $name, $number, $cvv, $expiryMonth, $expiryYear, $addr) {
        $addr->validate();

        $this->_request(array(
                             'type' => 'PUT',
                             'method' => 'u',
                             'email' => $this->__get('email'),
                             'ccs' => $cardNick,
                             'name' => $name,
                             'number' => $number,
                             'cvc' => $cvv,
                             'expiry_month' => $expiryMonth,
                             'expiry_year' => $expiryYear,
                             'bill_addr' => $addr /* Will be broken out in the request */
                        ));
    }

    function deleteCard($cardNick) {
        $this->_request(array(
                            'type' => 'DELETE',
                            'method' => 'u',
                            'email' => $this->__get('email'),
                            'ccs' => $cardNick
                        ));
    }

    function orderHistory($orderID='') {
        if (!empty($orderID)) $this->_request(array(
                                                   'type' => 'GET',
                                                   'method' => 'u',
                                                   'email' => $this->__get('email'),
                                                   'order' => $orderID
                                              ));
        else $this->_request(array(
                                  'type' => 'GET',
                                  'method' => 'u',
                                  'email' => $this->__get('email'),
                                  'orders' => true
                             ));
    }

    function updatePassword($password) {
        $this->_request(array(
                             'type' => 'PUT',
                             'method' => 'u',
                             'email' => $this->__get('email'),
                             'password' => hash('sha256', $password)
                        ));
    }
}

