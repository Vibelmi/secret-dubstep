<?php

include_once("models/Product_BLL.php");

/**
 * Description of Product
 *
 * @author Rafa Blasco
 */
class Product {

    private $_id;
    private $_name;
    private $_description_path;
    private $_descriptions;
    private $_image_path;
    private $_slider_path;
    private $_finish_date;
    private $_thresholds;
    private $_id_prov = 0; 
    private $_product_bll;

    public function __construct($id = NULL) {
        $args = func_num_args();
        if ($args === 0) {
            $this->_id = $this->_get_next_ID_DB();
        } else {
            $this->_id = $id;
        }
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
        $this->_product_bll = Product_BLL::getInstance();
        $data = $this->_product_bll->get_DB_data_BLL($id);
        $this->_name = $data["_name"];
        $this->_description_path = $data["_description"];
        $this->_image_path = $data["_image_path"];
        $this->_slider_path = $data["_slider_path"];
        $this->_finish_date = $data["_finish_date"];
    }

    public function _get_Product_Thresholds($id) {
        $this->_product_bll = Product_BLL::getInstance();
        $this->_thresholds = $this->_product_bll->get_Product_Thresholds_BLL($id);
    }

    public function _charge_descriptions() {
        $xml = new xmlRead($this->_description_path);
        $var = $xml->getXml();
        foreach ($var->description as $desc) {
            $field["language"] = (string) ($desc["language"]);
            $field["short"] = (string) ($desc->short);
            $field["spec"] = (string) ($desc->spec);
            $this->_descriptions[] = $field;
        }
    }

    public function _select_description_by_lang($lang) {
        foreach ($this->_descriptions as $desc) {
            if ($desc["language"] === $lang) {
                return Array("spec" => $desc["spec"], "short" => $desc["short"]);
            }
        }
    }

    public function _view_Content() {
        echo "<pre>";
        print_r($this);
        echo "</pre>";
    }

    public function _add_new_Product() {
        $this->_product_bll = Product_BLL::getInstance();
        $this->_product_bll->add_new_Product_BLL($this);
        $this->_product_bll->add_Product_Thresholds_BLL($this);
    }

    public function _modify_Product() {
        $this->_product_bll = Product_BLL::getInstance();
        $this->_product_bll->modify_Product_BLL($this);
        $this->_product_bll->modify_Thresholds_BLL($this);
    }

    public function _get_next_ID_DB() {
        $product_BLL = new Product_BLL();
        return $product_BLL->get_next_ID_BLL();
    }

    private function error($message) {
        if ($this->_show_errors) {
            print "<p>Product Class Error</p>";
            print "<p>$message</p>";
        }
        return false;
    }

}
