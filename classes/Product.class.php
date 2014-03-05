<?php

include_once("models/Product_BLL.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author Rafa Blasco
 */
class Product {

    private $_id;
    private $_name;
    private $_description;
    private $_image_path;
    private $_slider_path;
    private $_finish_date;
    private $_thresholds;

    public function __construct($id) {
        $this->_id = $id;
        $this->_get_DB_data($id);
        /* $this->_name = $name;
          $this->_description = $description;
          $this->_image_path = $image_path;
          $this->_slider_path = $slider_path;
          $this->_finish_date = $finish_date; */
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

    public function _get_DB_data($id) {
        $data = get_DB_data_BLL($id);
        $this->_name = $data["_name"];
        $this->_description = $data["_description"];
        $this->_image_path = $data["_image_path"];
        $this->_slider_path = $data["_slider_path"];
        $this->_finish_date = $data["_finish_date"];
        $this->_thresholds = $data["_thresholds"];
        echo "<pre>";
        print_r($this);
        echo "</pre>";
    }
    
    public function _add_to_DB(){}
    public function _modify_in_DB(){}

}
