<?php

class Admin extends Base_controller
{
    
    public function Index()
    {
        
        $this->reqView('AdminPanel');
    }

    public function addProduct()
    {

        // require view with form for new product
        if (!isset($_POST['newProd'])) {
            
            $this->reqView('AddProduct');

        } else {
            
            // instantiate admin model
            $this->initModel('NewProduct_model');
            
            // call addProduct method in model and check if the model successfuly added a new product to database
            if($this->modelObj->addProduct() || $_POST['newProdStatus'] == 'success')
            {

                // require the add product view
                $this->reqView('AddProduct');
                
            } else {

                echo 'Error, contact site administrator';
            }
        }
        
    }

    public function addVariant()
    {
        $this->initModel('AddVariant_model');
        
        if($this->modelObj->addVariant())
        {
            $_POST['addVariant'] = [];
            $this->reqView('AdminPanel');
        } else {
            echo 'failed';
        }
        
        
    }


}