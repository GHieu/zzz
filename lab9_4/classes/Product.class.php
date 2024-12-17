<?php
class Product extends Db
{
	private $_page_size = 5;
	private $_product;
	public function __construct()
	{
		parent::__construct();
		$sql = "select * from products";
		$this->_product = $this->exeQuery($sql);

	}
	public function getProduct()
	{
		return $this->_product;
	}
	public function add($arr)
	{
		$sql = "insert into products (name, category_id, image_url, description, price, quantity2) values (:name, :category_id, :image_url, :description, :price, :quantity2)";
		$this->exeNoneQuery($sql, $arr);
	}
	public function Remove($product_id)
	{
		$sql = "delete from products where product_id=:product_id ";
		$arr = array(":product_id" => $product_id);
		return $this->exeNoneQuery($sql, $arr);
	}
	public function Joincategories()
	{
		$sql = "Select products.*, categories.name as namecate from products join categories on products.category_id = categories.category_id";
		return $this->exeQuery($sql);

	}
	public function Update($arr)
	{

		$sql = "update products 
            set 
        name = :name,
        category_id = :category_id,
        description = :description,
        price = :price,
        image_url = :image_url,
        quantity2 = :quantity2
            WHERE 
        product_id = :product_id
        ";
		return $this->exeNoneQuery($sql, $arr);

	}

	public function getById($product_id)
	{
		$sql = "SELECT * FROM products WHERE product_id = :product_id";
		return $this->exeQuery($sql, ["product_id" => $product_id])[0] ?? "";
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
		$sql = "SELECT products.*, COUNT(categories.category_id) AS quantity 
            FROM products 
            LEFT JOIN categories ON products.product_id = categories.category_id 
            GROUP BY products.product_id 
            LIMIT $offset, $sizePage";
		return $this->exeQuery($sql);
	}

	public function getCountPage($sizePage)
	{
		$sql = "SELECT COUNT(*) AS total FROM products";
		$count = $this->queryone($sql)['total'];
		return ceil($count / $sizePage);
	}

	public function getCountSearchPage($key, $sizePage = 5)
	{
		$arr = array(":name" => "%" . $key . "%");

		// Truy vấn SQL để đếm tổng số kết quả
		$sql = "SELECT COUNT(*) as total 
				FROM products 
				WHERE name LIKE :name";

		$count = $this->countItems($sql, $arr); // Truyền thêm tham số vào countItems
		return ceil($count / $sizePage);
	}

	public function count($sql, $arr = array())
	{
		return $this->countItems($sql, $arr);
	}


	//Lọc sản phẩm theo danh mục
	public function getProductsByCategory($categoryId, $currPage, $sizePage)
	{
		$offset = (int) (($currPage - 1) * $sizePage); // Tính vị trí bắt đầu (OFFSET)
		$sizePage = (int) $sizePage;
		// Truy vấn SQL (không dùng bind với LIMIT)
		$sql = "SELECT 
                products.product_id, 
                products.name, 
                products.price, 
                products.image_url, 
                products.description,
                products.quantity2
            FROM 
                products
            WHERE 
                products.category_id = :category_id
            LIMIT $offset, $sizePage";

		$arr = array(":category_id" => $categoryId);
		return $this->exeQuery($sql, $arr);
	}


	//Lọc sản phẩm theo danh mục
	public function getCountPageByCategory($categoryId, $sizePage)
	{
		$sql = "SELECT COUNT(*) as total FROM products WHERE category_id = :category_id";
		$arr = array(":category_id" => $categoryId);
		$count = $this->countItems($sql, $arr);
		return ceil($count / $sizePage);
	}




	public function search($currPage = 1, $sizePage, $key)
	{
		$offset = max(0, (int) (($currPage - 1) * $sizePage)); // Tính toán offset
		$sizePage = (int) $sizePage;
		$arr = array(
			":name" => "%" . $key . "%"
		);

		// Sử dụng giá trị số nguyên trực tiếp trong LIMIT
		$sql = "SELECT
					products.product_id,
					products.name,
					products.description,
					products.price,
					products.image_url,
					products.quantity2,
					products.category_id,
					categories.name as category_name
				FROM
					products
				INNER JOIN 
					categories ON products.category_id = categories.category_id
				WHERE 
					products.name LIKE :name
				LIMIT $offset, $sizePage"; // Thêm $offset và $sizePage trực tiếp vào đây

		return $this->exeQuery($sql, $arr);
	}


}
?>