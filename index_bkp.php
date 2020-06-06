<?php
require 'vendor/autoload.php';
$breadcrumbs = 'Home';

include('layout/header.php');
include('lib/connection.php');
include_once('lib/check_language.php');
?>

<div id="content">
    <h2>Produtos</h2>

<?php include('mais_vendidos.php'); ?>

<?php

if ($lang == 'pt') {
	$sql = "SELECT id, name_pt name, price_pt price, sale_start, sale_end, sale_price_pt sale_price FROM products";
} elseif ($lang == 'fr') {
	$sql = "SELECT id, name_fr name, price_fr price, sale_start, sale_end, sale_price_fr sale_price FROM products";
} else {
	$sql = "SELECT id, name_en name, price_en price, sale_start, sale_end, sale_price_en sale_price FROM products";
}

?>

<div style="display: block;position: relative">
	<h3>Todos os produtos </h3>
<?php

$result = mysqli_query($sql);

// if exists data
if (mysqli_num_rows($result) > 0) {

    // result each row in array
    while($a = mysqli_fetch_assoc($result))
    {
	    $price =  $a['price'];
		$off_price = '';

	    if (!empty($a['sale_start'])) {

	    	$DateStart = strtotime($a['sale_start']);
	    	$DateEnd = strtotime($a['sale_end']);

	    	$now = time();

	    	if ($DateStart <= $now && $now <= $DateEnd) {
	    		$price = $a['sale_price'];

	    		$off_price = $a['price'] - $a['sale_price'];
	    	}
	    }
?>

	<div class="product_item">
    	<span class="name"> <?php echo $a['name']; ?></span>
    	<span class="price"> <?php echo number_format($price, 2); ?></span>
    	<?php if (!empty($off_price)) { ?>
    	<span class='sale'><?php echo number_format($off_price); ?> off </span>
    	<?php } ?>
    	<a href="#" onclick="comprar_item('buy_item.php?id=<?php echo $a['id']?>', <?php echo $price; ?>)">Buy</a>
	</div>
<?php
    }
} else {
    echo "0 results";
}

mysqli_close($conn);

// Todos produtos
?>
	</div>
</div>
<?php
include('layout/footer.php');