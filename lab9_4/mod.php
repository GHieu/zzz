<?php
$mod = getIndex("mod", "main");

if ($mod == "main")
	include "include/main.php";
if ($mod == "news")
	include "module/news/index.php";
if ($mod == "cart")
	include "module/cart/index.php";
?>