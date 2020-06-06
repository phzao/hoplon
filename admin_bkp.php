<?php
$breadcrumbs = 'Home > Admin';

include('layout/header.php');

include('lib/connection.php');

$lang = 'PT';

?>
<div id="content">
	<button class="incluir_button" style="margin: 10px;" onclick="window.location.href='add_products.php'">Cadastrar</button>
	<table class="table-list" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<th>Id</th>
			<th>Name PT</th>
			<th>Name EN</th>
			<th>Name FR</th>
			<th>Price PT</th>
			<th>Price EN</th>
			<th>Price FR</th>
			<th>Action</th>
		</tr>
<?php
$sql = "SELECT * FROM products";

$result = mysql_query($sql);

// if exists data
if (mysql_num_rows($result) > 0) {

	// result each row in array
	while($a = mysql_fetch_assoc($result)) 
    { 
?>
	 <tr>
		<td style="text-align: center"><?php echo $a['id']; ?></td>
		<td><?php echo $a['name_pt']; ?></td>
		<td><?php echo $a['name_en']; ?></td>
		<td><?php echo $a['name_fr']; ?></td>
		<td style="text-align: center"><?php echo $a['price_pt']; ?></td>
		<td style="text-align: center"><?php echo $a['price_en']; ?></td>
		<td style="text-align: center"><?php echo $a['price_fr']; ?></td>
		<td style="text-align: center"><a href="edit_products.php">editar</a></td>
 	</tr>

<?php
    }
}
?>
	</table>
</div>
<?php
include('layout/footer.php');