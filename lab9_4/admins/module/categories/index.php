<?php
$categories = new Category();
$ac = getIndex("ac", "list");
if ($ac == "list")
    include "module/categories/list.php";
else if ($ac == "add")
    include "module/categories/add.php";
elseif ($ac == "delete")
    include "module/categories/delete.php";
elseif ($ac == "update")
    include "module/categories/update.php";
?>