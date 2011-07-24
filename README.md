Ordr.in PHP API
======================

A PHP wrapper for the Restaurant, User, and Order APIs provided by Ordr.in.

Usage
-----
	require_once('Ordrin.php');
	
	Ordrin.api.initialize("shds1d6c4BGDGs8", "http://localhost") # developer key and site where hosted
	
	place = Ordrin.Address("1 Main St", "College Station", "77840", "Suite 200", "Texas", "4044099661", "Home") # street, city, zip, street2, state, phone, nickname
	when = Ordrin.dTime.now()
	Ordrin.when.asap()
	
	subT = Ordrin.Money(100)
	tip = Ordrin.Money(15)
	
	Ordrin.r.deliveryList(when, place) # time, location
	Ordrin.r.def deliveryCheck("142", when, place) # subtotal, time, location
	Ordrin.r.deliveryFee("142", subT, tip, when, place) # restaurant ID, subtotal, tip, time, location
	Ordrin.r.details("142") # restaurant ID

	Ordrin.u.makeAcct("test@test.com", "pass", "John", "Doe")

	Ordrin.api.setCurrAcct("test@test.com", "pass") # user and pass required to be set before using rest of User API
	
	Ordrin.u.updateAddress(place) # sets address with such a nickname if it does not yet exists, updates it if otherwise
	Ordrin.u.getAddress("home") # returns details on address with given nickname
	Ordrin.src.u.deleteAddress("home") # deletes address with nickname
	
	Ordrin.u.updateCard("personal", "John Doe", "4111111111111111", "444", "02", "12", place) # sets card with such a nickname if it does not yet exists, updates it if otherwise
	Ordrin.u.getCard("personal") # returns details on card with given nickname
	Ordrin.u.deleteCard("personal") # deletes card with nickname
	
	Ordrin.u.orderHistory("12") # returns previous order; if no ID given, all previous orders listed
	
	Ordrin.u.updatePassword("newPassword") # sets new password
	
	Ordrin.o.submit("142", tray, tip, when, "test@testing.com", "John", "Doe", place, "John Doe", "4111111111111111", "444", "0212", place) # tray as [item ID][quantity][options]-[item ID-2][quantity]
       
Notes
----- 
API docs available at http://www.ordr.in/developers/api.