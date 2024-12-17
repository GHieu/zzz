<?php
$id = Utils::getIndex("id");
$r = $category->getById($id);
$ac2= "saveEdit";
$info ="Sửa danh mục!";
if (Count($r)==0) //khong co -> them moi
{
	$ac2="saveAdd";
	$info ="Thêm Mới danh mục";
	$r["id"]="";
	$r["name"]="";
}
?>
<form action="index.php?mod=product&group=cat&ac=<?php echo $ac2;?>" method="post">
    <fieldset>
        <legend><?php echo $info;?></legend>
        <table width="50%" border="1" cellspacing="3">
            <tr>
                <td width="23%">Mã loại danh mục</td>
                <td width="77%"><input type="text" name="id" value="<?php echo $r["id"];?>"></td>
            </tr>
            <tr>
                <td>Tên Loại danh mục</td>
                <td><input type="text" name="name" value="<?php echo $r["name"];?>"></td>
            </tr>
            <tr>
                <td colspan="2">

                    <input type="Reset">
                    <input type="submit" value="Thực Hiện">
                    <?php
    
	?>
                </td>
            </tr>
        </table>
    </fieldset>
</form>