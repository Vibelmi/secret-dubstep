<?php

include_once("models/Product_DAO.php");
/**
 * Description of Product
 *
 * @author Rafa Blasco
 */

class Product_BLL {
    
    private $_db;
    
    public function __construct() {
        $this->_db = Db::getInstance();
    }
    
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
        return $this;
    }

    public function get_DB_data_BLL($id) {
        if ($this->_db) {
            $product_DAO = new Product_DAO();
            return $product_DAO->get_DB_data_DAO($id, $this->_db);
        } else {
            echo "Error _get_DB_data_BLL at DB_instance";
        }
    }

    public function get_Product_Thresholds_BLL($id) {
        if ($this->_db) {
            $product_DAO = new Product_DAO();
            return $product_DAO->get_Product_Thresholds_DAO($id, $this->_db);            
        } else {
            echo "Error _get_Product_Thresholds_BLL at DB_instance";
        }
    }


    public function add_new_Product_BLL($product) {
        if ($this->_db) {
            $product_DAO = new Product_DAO();
            return $product_DAO->add_new_Product_DAO($product, $this->_db);            
        } else {
            echo "Error _add_new_Product_DAO at DB_instance";
        }
    }

    public function add_Product_Thresholds_BLL($id) {
        if ($this->_db) {
            $product_DAO = new Product_DAO();
            return $product_DAO->add_Product_Thresholds_DAO($id, $this->_db);            
        } else {
            echo "Error add_Product_Thresholds_DAO at DB_instance";
        }
    }

    public function get_next_ID_BLL(){
        if ($this->_db) {
            $product_DAO = new Product_DAO();
            return $product_DAO->get_next_ID_DAO($this->_db);            
        } else {
            echo "Error _get_Product_Thresholds_BLL at DB_instance";
        }
    }

}
