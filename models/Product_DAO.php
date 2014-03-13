<?php

include_once("libs/SqlQueryBuilder.class.php");

/**
 * Description of Product
 *
 * @author Rafa Blasco
 */

class Product_DAO {

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
        } catch (Exception $e) {
            echo "Error " . $e . ": Connecting_DB_Thresholds";
        }
        $thresholds_data = array();
        if ($thresholds instanceof mysqli_result) {
            while ($row = $thresholds->fetch_assoc()) {
                $thresholds_data[$row["units"]] = $row["price"];
            }
        } else {
            echo "The query doesn't return a valid resultset";
        }
        return $thresholds_data;
    }

    public function add_Product_DAO($id, $db) {

        $query = new SqlQueryBuilder("insert");
        $query->setTable("products");

        $query->addColumn("");
        $query->addColumn("");
        $query->addColumn("");
        $query->addColumn("");
        $query->addColumn("");
        $query->addColumn("");

        $query->setLimit(1);

        $data = $db->run($query->buildQuery())->fetch_assoc();
        if ($db->connect_error) {
            die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
        }

      	try {
            $db->run($query->buildQuery());
        } catch (Exception $e) {
            echo "Error " . $e . ": Connecting_DB_Products";
            return false;
        }
        return true;
    }

    public function add_Product_Thresholds_DAO($product, $db) {
        $query = new SqlQueryBuilder("insert");
        $query->setTable("threshold");

        $query->addColumn("idprov");
        $query->addColumn("idprod");
        $query->addColumn("units");
        $query->addColumn("price");

        $query->addValue(0);
        $query->addValue($product->_id);
        $query->addValue("units");
        $query->addValue("price");

        if ($db->connect_error) {
            die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
        }

        try {
            $db->run($query->buildQuery());
        } catch (Exception $e) {
            echo "Error " . $e . ": Connecting_DB_Thresholds";
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
