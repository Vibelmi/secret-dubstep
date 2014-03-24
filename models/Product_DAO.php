<?php

include_once("libs/SqlQueryBuilder.class.php");

/**
 * Description of Product
 *
 * @author Rafa Blasco
 */
class Product_DAO {

    private $_instance;

    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function get_DB_data_DAO($id, $db) {

        $query = new SqlQueryBuilder("select");
        $query->setTable("products");

        $query->addColumn("*");
        $query->setWhere("idprod = '$id'");

        $query->setLimit(1);

        $data = $db->run($query->buildQuery())->fetch_assoc();
        if ($db->connect_error) {
            die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
        }

        $product_data = array("_name" => $data["name"],
            "_description" => $data["description"],
            "_image_path" => $data["image"],
            "_slider_path" => $data["slider_path"],
            "_finish_date" => $data["finish_date"]);

        return $product_data;
    }

    public function get_Product_Thresholds_DAO($id, $db) {
        $query = new SqlQueryBuilder("select");
        $query->setTable("threshold");

        $query->addColumn("units");
        $query->addColumn("price");

        $query->setWhere("idprod = '$id'");

        if ($db->connect_error) {
            die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
        }

        try {
            $thresholds = $db->run($query->buildQuery());
            $thresholds_data = array();
            if ($thresholds instanceof mysqli_result) {
                while ($row = $thresholds->fetch_assoc()) {
                    $thresholds_data[$row["units"]] = $row["price"];
                }
            } else {
                echo "The query doesn't return a valid resultset";
            }
            return $thresholds_data;
        } catch (Exception $e) {
            echo "Error " . $e . ": Connecting_DB_Getting_Thresholds";
            return false;
        }
    }

    public function add_new_Product_DAO($product, $db) {

        $query = new SqlQueryBuilder("insert");
        $query->setTable("products");

        $query->addColumn("idprod");
        $query->addColumn("name");
        $query->addColumn("description");
        $query->addColumn("image");
        $query->addColumn("slider_path");
        $query->addColumn("finish_date");
        $query->addColumn("visible");

        $query->addValue($product->_id);
        $query->addValue($product->_name);
        $query->addValue($product->_description_path);
        $query->addValue($product->_image_path);
        $query->addValue($product->_slider_path);
        $query->addValue($product->_finish_date);
        $query->addValue(1);

        if ($db->connect_error) {
            die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
        }

        try {
            $db->run($query->buildQuery());
        } catch (Exception $e) {
            echo "Error " . $e . ": Connecting_DB_Adding_Products";
            return false;
        }
        return true;
    }

    public function add_Product_Thresholds_DAO($product, $db) {
        foreach ($product->_thresholds as $threshold) {
            $query = new SqlQueryBuilder("insert");
            $query->setTable("threshold");

            $query->addColumn("idprov");
            $query->addColumn("idprod");
            $query->addColumn("units");
            $query->addColumn("price");

            $query->addValue($product->_id_prov);
            $query->addValue($product->_id);
            $query->addValue($threshold["units"]);
            $query->addValue($threshold["price"]);

            if ($db->connect_error) {
                die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
            }

            try {
                $db->run($query->buildQuery());
            } catch (Exception $e) {
                echo "Error " . $e . ": Connecting_DB_Adding_Thresholds";
                return false;
            }
        }
        return true;
    }

    public function modify_Product_DAO($product, $db) {

        $query = new SqlQueryBuilder("update");
        $query->setTable("products");
        $query->setWhere("idprod =" . $product->_id);

        $query->addColumn("name");
        $query->addColumn("description");
        $query->addColumn("image");
        $query->addColumn("slider_path");
        $query->addColumn("finish_date");

        $query->addValue($product->_name);
        $query->addValue($product->_description_path);
        $query->addValue($product->_image_path);
        $query->addValue($product->_slider_path);
        $query->addValue($product->_finish_date);

        if ($db->connect_error) {
            die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
        }

        try {
            $db->run($query->buildQuery());
        } catch (Exception $e) {
            echo "Error " . $e . ": Connecting_DB_Adding_Products";
            return false;
        }
        return true;
    }

    public function delete_Thresholds_DAO($product, $db) {

        $query = new SqlQueryBuilder("delete");
        $query->setTable("threshold");
        $query->setWhere("idprod =" . $product->_id);
        $query->addColumn("*");

        if ($db->connect_error) {
            die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
        }

        try {
            $db->run($query->buildQuery());
        } catch (Exception $e) {
            echo "Error " . $e . ": Connecting_DB_Deleting_Thresholds";
            return false;
        }
        return true;
    }

    public function get_next_ID_DAO($db) {
        $query = new SqlQueryBuilder("query");
        $query->setQuery("SHOW TABLE STATUS LIKE 'products'");
        if ($db->connect_error) {
            die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
        }
        try {
            $data = $db->run($query->buildQuery())->fetch_assoc();
        } catch (Exception $e) {
            echo "Error " . $e . ": Connecting_DB_Thresholds";
            return false;
        }
        return $data['Auto_increment'];
    }

}
