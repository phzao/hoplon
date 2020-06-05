<?php

include_once('lib/check_language.php');

$sql = "select product_id, count(id) vezes from history where language = '$lang' group by product_id";

$result = mysqli_query($sql);

if (mysqli_num_rows($result) > 0) {

    $produto = 0;
    $vezes = 0;
    while($a = mysqli_fetch_assoc($result)) {
		$qtd = $a['vezes'];
		$productId = $a['product_id'];

		if ($qtd > $vezes) {
			$vezes = $qtd;
			$produto = $productId;
		}
	}

	$sql = "select * from products where id = " . $produto;

	$result = mysqli_query($sql);
	$a = mysqli_fetch_assoc($result);

    if ($lang == 'PT') {
    	$price =  $a['price_pt'];
    	$sale_price = $a['sale_price_pt'];
    	$name = $a['name_pt'];
    } elseif ($lang == 'FR') {
    	$price =  $a['price_fr'];
    	$sale_price = $a['sale_price_fr'];
    	$name = $a['name_fr'];
    } else {
    	$price =  $a['price_en'];
    	$sale_price = $a['sale_price_en'];
    	$name = $a['name_en'];
    }
    
	$off_price = '';

    if (!empty($a['sale_start'])) {

    	$DateStart = strtotime($a['sale_start']);
    	$DateEnd = strtotime($a['sale_end']);

    	$now = time();
    	
    	if ($DateStart <= $now && $now <= $DateEnd) {
    		$price = $sale_price;

    		$off_price = $price - $sale_price;
    	}
    }
	

?>
<div style="display: block;position: relative">
	<h3>Produto mais vendido</h3>
	<div class="product_item" style="float: none">
		<span class="name"> <?php echo $name; ?></span>
		<span class="price"> <?php echo number_format($price, 2); ?></span>
		<?php if (!empty($off_price)) { ?>
		<span class='sale'><?php echo number_format($off_price); ?> off </span>
		<?php } ?>
		<a href="#" onclick="comprar_item('buy_item.php?id=<?php echo $a['id']?>', <?php echo $price; ?>)">Buy</a>
	</div>
</div>
 <?php 
}