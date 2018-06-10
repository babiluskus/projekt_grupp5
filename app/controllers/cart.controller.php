<?php

/**
* 
*/
class Cart extends Base_Controller
{
	
	public function index() 
	{
		// instansiate new model using the function built in from the Base Controller
        $this->initModel('Cart_model');

        //We instansiate cartItems method where we save the new array from session
        $data = $this->modelObj->showCart();

        //This will be shown on our cart page
        $this->reqView('Cart', $data);
	}

	public function add() {
		
		$this->initModel('Cart_model');
		
		$this->modelObj->add();

		$data = $this->modelObj->showCart();
		header("Location: {$_SERVER['HTTP_REFERER']}");

		//$this->reqView('Cart', $data);
	}

	public function removeItem($sku, $amount)
	{
		$this->initModel('Cart_model');

		//We instansiate cartItems method where we save the new array from session
        $this->modelObj->removeItem($sku, $amount);

        $data = $this->modelObj->showCart();
		header("Location: {$_SERVER['HTTP_REFERER']}");
	}

	public function emptyCart($sku, $amount)
	{
		$this->initModel('Cart_model');

		//We instansiate cartItems method where we save the new array from session
        $this->modelObj->emptyCart($sku, $amount);

        $data = $this->modelObj->showCart();
		header("Location: {$_SERVER['HTTP_REFERER']}");
	}
}

