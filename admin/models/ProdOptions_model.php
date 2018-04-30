<?php

class ProdOptions_model extends Base_model
{
    // fetch all products, used in <select> tag to be able to show
    // options for chosen product
    public function getProducts()
    {
        $this->sql = "SELECT pid, title FROM product";

        $this->prepQuery($this->sql);

        $products = $this->getAll();

        return $products;
    }
    
    // fetch options and types for specific (chosen) product
    public function getOptions()
    {
        $this->sql = 
        "SELECT title, product_id, product_options.option_id, option_name FROM product_options
        JOIN projekt_klon.option_type ON 
        product_options.option_id = option_type.option_id
        JOIN product ON product_options.product_id = product.pid WHERE product_id = :pid ORDER BY product_id, option_id";

        $pid = isset($_POST['products']) ? $_POST['products'] : null;
        $paramBinds = [':pid' => $pid];
        $this->prepQuery($this->sql, $paramBinds);

        $data = $this->getAll();

        return $data;
        unset($_POST['products']);
    }

    // get all options available in option_type in DB
    public function getOptionType()
    {
        $this->sql = "SELECT * FROM option_type";

        $this->prepQuery($this->sql);

        $data = $this->getAll();

        return $data;

    }

    // insert new option
    public function insertOption()
    {
        $value = isset($_POST['optiontype']['new']) ? $_POST['optiontype']['new'] : null;
        $this->sql = "INSERT INTO option_type (option_name) VALUES (:option_name)";
        $paramBinds = [':option_name' => $value];

        $this->prepQuery($this->sql, $paramBinds) ? $_POST['optiontype']['status'] = 'true' : $_POST['optiontype']['status'] = 'false';

    }
}