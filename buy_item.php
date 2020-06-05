<?php

include('lib/connection.php');

include_once('lib/check_language.php');

$id = $_GET['id'];

$sql = "SELECT id, name_pt name, price_pt price, sale_start, sale_end, sale_price_pt sale_price FROM products WHERE id = $id";

$result = mysql_query($sql);

// if exists data
if (mysql_num_rows($result) > 0) {

	// result each row in array
	$a = mysql_fetch_assoc($result);


    $price =  $a['price'];
	$off_price = '';
	$sale = '0';

    if (!empty($a['sale_start'])) {

    	$DateStart = strtotime($a['sale_start']);
    	$DateEnd = strtotime($a['sale_end']);

    	$now = time();
    	
    	if ($DateStart <= $now && $now <= $DateEnd) {
    		$price = $a['sale_price'];

    		$off_price = $a['price'] - $a['sale_price'];
    		$sale = '1';
    	}
    }


	$sql  = "INSERT INTO history (product_id, language, price, sale, date)  ";
	$sql .= "VALUES(".$a['id'].",'" . $lang . "','" . $price . "'," . $sale . ",'" . date('Y-m-d H:i:s') . "')";

	mysql_query($sql);
}

mysql_close($conn);

$breadcrumbs = "Home > Store";

include "layout/header.php";
?>

<h2>Item comprado com sucesso!</h2>

<a href="index.php">Voltar</a>