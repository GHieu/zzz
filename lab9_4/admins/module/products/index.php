<?php
$products = new Product();
$ac = getIndex("ac", "list");
if ($ac == "list")
	include "module/products/list.php";
else if ($ac == "add")
	include "module/products/add.php";
elseif ($ac == "delete")
	include "module/products/delete.php";
elseif ($ac == "update")
	include "module/products/update.php";
?>