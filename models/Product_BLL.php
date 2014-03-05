<?php
include_once("models/Product_DAO.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 function get_DB_data_BLL($id){
     /*$db = Db::getInstance();
     if($db){
         return get_DB_data_DAO($id, $db);
     }else{
         echo "Error _get_DB_data_BLL at DB_instance";
     }     */
     return get_DB_data_DAO($id, 0);
 }

