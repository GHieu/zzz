<?php
$mod = getIndex("mod", "products");

if ($mod == "products")
	include "module/products/index.php";
elseif ($mod == "categories")
	include "module/categories/index.php";
elseif ($mod == "login")
	include "home.html";
?>