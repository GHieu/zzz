<?php
$product = new Product();
$page = Utils::getIndex("page", 1);

$data = $product->getAll($page);
//$page_count = $product->getPageCount();

?>
<div class="tab-content default-tab" id="tab1">
    <!-- This is the target div. id must match the href of this div's tab -->

    <div class="notification attention png_bg">
        <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification"
                alt="close" /></a>
        <div>
            This is a Content Box. You can put whatever you want in it. By the way, you can close this notification with
            the top-right cross.
        </div>
    </div>

    <table>

        <thead>
            <tr>
                <th><input class="check-all" type="checkbox" /></th>
                <th>Tên giày</th>
                <th>Mô tả</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Loại</th>
                <th>Hình ảnh</th>
                <th>Column 5</th>
            </tr>

        </thead>

        <tfoot>
            <tr>
                <td colspan="6">
                    <div class="bulk-actions align-left">
                        <select name="dropdown">
                            <option value="option1">Choose an action...</option>
                            <option value="option2">Edit</option>
                            <option value="option3">Delete</option>
                        </select>
                        <a class="button" href="#">Apply to selected</a>
                    </div>

                    <div class="pagination">
                        <a href="#" title="First Page">&laquo; First</a><a href="#" title="Previous Page">&laquo;
                            Previous</a>
                        <?php
                        for ($i = 1; $i <= $page_count; $i++) {
                            $c = " number ";
                            if ($i == $page)
                                $c .= " current "; ?>
                        <a href="index.php?mod=product&page=<?php echo $i; ?>" class="<?php echo $c; ?>"
                            title="<?php echo $i; ?>"><?php echo $i; ?></a>
                        <?php
                        }
                        ?>
                        <a href="#" title="Next Page">Next &raquo;</a><a href="#" title="Last Page">Last &raquo;</a>
                    </div> <!-- End .pagination -->
                    <div class="clear"></div>
                </td>
            </tr>
        </tfoot>

        <tbody>
            <?php
            foreach ($data as $r) { ?>
            <tr>
                <td><input type="checkbox" /></td>
                <td><a href="#" title="title"><?php echo $r["name"]; ?>
                    </a></td>
                <td><?php echo $r["description"]; ?></td>

                <td><?php echo number_format($r["price"]); ?> VND</td>
                <td><?php echo $r["stock"]; ?></td>

                <td><?php echo $r["category_id"]; ?></td>
                <td>
                    <!-- Icons -->
                    <a href="index.php?mod=product&ac=edit&id=<?php echo $r["id"]; ?>" title="Edit"><img
                            src="resources/images/icons/pencil.png" alt="Edit" /></a>&nbsp;&nbsp;
                    <a href="index.php?mod=product&ac=delete&id=<?php echo $r["id"]; ?>" title="Delete"><img
                            src="resources/images/icons/cross.png" alt="Delete" /></a>

                </td>
            </tr>
            <?php
            }
            ?>

        </tbody>

    </table>

</div>