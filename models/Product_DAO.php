<?php
include_once("libs/SqlQueryBuilder.class.php");
//include_once("SqlQueryBuilder.class.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function save_Product() {
    
}

function get_DB_data_DAO($id, $db) {
    $query = new SqlQueryBuilder("select");
    $query->setTable("products");

    $query->addColumn("*");
    $query->setWhere("idprod = '$id'");

    $query->setLimit(1);
    
    //$data = $db->run($query->buildQuery())->fetch_assoc();
    //
    $product_data = ["_name"=>"Samsung Galaxy S5", 
        "_description" => "products/10011/description.xml", 
        "_image_path" => "products/10011/main.png", 
        "_slider_path" => "products/10011/slider", 
        "_finish_date" => "3th May 2014", 
        "_thresholds" =>["1500" => "450", "2500" => "420", "5000" => "350"]];
    return $product_data;
}

