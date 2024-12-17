<?php
class Category extends Db
{
    public function add($arr)
    {
        $sql = "insert into categories (name) values (:name)";
        $this->exeNoneQuery($sql, $arr);
    }

    public function delete($category_id)
    {
        $sql = "delete from categories where category_id=:category_id ";
        $arr = array(":category_id" => $category_id);
        return $this->exeNoneQuery($sql, $arr);
    }

    public function Update($arr)
    {

        $sql = "update categories 
            set 
        name = :name
            WHERE 
            category_id = :category_id
        ";
        return $this->exeNoneQuery($sql, $arr);

    }

    public function getById($cat_id)
    {
        $sql = "select categories.* 
			from categories
			where  categories.category_id=:cat_id ";
        $arr = array(":cat_id" => $cat_id);
        $data = $this->exeQuery($sql, $arr);
        if (Count($data) > 0)
            return $data[0];
        else
            return array();
    }

    public function getAll()
    {
        return $this->exeQuery("select * from categories");
    }

    public function saveEdit()
    {
        $id = Utils::postIndex("category_id", "");
        $name = Utils::postIndex("name", "");
        if ($id == "" || $name == "")
            return 0;//Error
        $sql = "update categories set name=:name where category_id=:id ";
        $arr = array(":name" => $name, ":id" => $id);
        return $this->exeNoneQuery($sql, $arr);

    }
    public function saveAddNew()
    {
        $id = Utils::postIndex("category_id", "");
        $name = Utils::postIndex("name", "");
        if ($id == "" || $name == "")
            return 0;//Error
        $sql = "insert into categories(category_id, name) values(:category_id, :name) ";
        $arr = array(":category_id" => $id, ":name" => $name);
        return $this->exeNoneQuery($sql, $arr);

    }
    public function Joinproducts()
    {
        $sql = "SELECT categories.*, COUNT(products.product_id) AS quantity 
        FROM categories 
        LEFT JOIN products ON categories.category_id = products.category_id 
        GROUP BY categories.category_id";

        return $this->exeQuery($sql);
    }

    public function getAllCategories()
    {
        $sql = "SELECT category_id, name FROM categories";
        return $this->exeQuery($sql);
    }


    public function getPage($curentPage = 1, $sizePage = 5)
    {
        $offset = ($curentPage - 1) * $sizePage;

        // Truy vấn kết hợp với LEFT JOIN để tính số lượng sản phẩm
        $sql = "SELECT categories.*, COUNT(products.product_id) AS quantity 
            FROM categories 
            LEFT JOIN products ON categories.category_id = products.category_id 
            GROUP BY categories.category_id 
            LIMIT $offset, $sizePage";

        return $this->exeQuery($sql);
    }


    public function getCountPage($sizePage)
    {
        $sql = "SELECT COUNT(*) AS total FROM categories";
        $count = $this->queryone($sql)['total'];
        return ceil($count / $sizePage);
    }

}
?>