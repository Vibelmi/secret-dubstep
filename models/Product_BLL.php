<?php

include_once("models/Product_DAO.php");
/**
 * Description of Product
 *
 * @author Rafa Blasco
 */

class Product_BLL {
    
    private $_db;
    private $_product_dao;
    private $_instance;
    
    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    
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
            $this->_product_dao = Product_DAO::getInstance();
            return $this->_product_dao->get_DB_data_DAO($id, $this->_db);
        } else {
            echo "Error _get_DB_data_BLL at DB_instance";
        }
    }

    public function get_Product_Thresholds_BLL($id) {
        if ($this->_db) {
            $this->_product_dao = Product_DAO::getInstance();
            return $this->_product_dao->get_Product_Thresholds_DAO($id, $this->_db);            
        } else {
            echo "Error _get_Product_Thresholds_BLL at DB_instance";
        }
    }


    public function add_new_Product_BLL($product) {
        if ($this->_db) {
            $this->_product_dao = Product_DAO::getInstance();
            return $this->_product_dao->add_new_Product_DAO($product, $this->_db);            
        } else {
            echo "Error _add_new_Product_DAO at DB_instance";
        }
    }

    public function add_Product_Thresholds_BLL($product) {
        if ($this->_db) {
            $this->_product_dao = Product_DAO::getInstance();
            return $this->_product_dao->add_Product_Thresholds_DAO($product, $this->_db);            
        } else {
            echo "Error add_Product_Thresholds_DAO at DB_instance";
        }
    }
    
        public function modify_Product_BLL($product) {
        if ($this->_db) {
            $this->_product_dao = Product_DAO::getInstance();
            return $this->_product_dao->modify_Product_DAO($product, $this->_db);            
        } else {
            echo "Error _add_new_Product_DAO at DB_instance";
        }
    }

    public function modify_Thresholds_BLL($product) {
        if ($this->_db) {
            $this->_product_dao = Product_DAO::getInstance();
            $deleted_thresholds = $this->_product_dao->delete_Thresholds_DAO($product, $this->_db);
            if(!$deleted_thresholds){
                return false;
            }
            return $this->_product_dao->add_Product_Thresholds_DAO($product, $this->_db);            
        } else {
            echo "Error add_Product_Thresholds_DAO at DB_instance";
        }
    }

    public function get_next_ID_BLL(){
        if ($this->_db) {
            $this->_product_dao = Product_DAO::getInstance();
            return $this->_product_dao->get_next_ID_DAO($this->_db);            
        } else {
            echo "Error _get_Product_Thresholds_BLL at DB_instance";
        }
    }

}
