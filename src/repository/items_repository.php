<?php

require_once 'repository.php';
require_once __DIR__.'/../models/item.php';

class ItemsRepository extends Repository {

    public function get_items_count(string $name, string $cat): array {
        $cat = "%".strtolower($cat)."%";
        $name = "%".strtolower($name)."%";
        return $this->database->query(
            "SELECT count(*) as count from products INNER JOIN categories ON categories.id_categories=products.fk_id_categories WHERE lower(categories.name) LIKE ? and lower(products.name) LIKE ?",
            $cat, $name
        )->fetch_array();
    }

    public function get_items(string $name, string $cat, int $start, int $interval): array {
        $result = [];
        $cat = "%".strtolower($cat)."%";
        $name = "%".strtolower($name)."%";
        $all_arr = $this->database->query(
        "SELECT products.name, quantity, price from products INNER JOIN categories on categories.id_categories=products.fk_id_categories WHERE LOWER(categories.name) LIKE ? AND LOWER(products.name) LIKE ? limit ?, ?",
            $cat, $name, $start, $interval
        )->fetch_all();
        foreach ($all_arr as $arr)
            $result[] = new Item($arr["name"], $arr["quantity"], $arr["price"]);
        return $result;
    }
    public function get_categories(): array {
        return $this->database->query("SELECT name, id_categories FROM categories")->fetch_all();
    }

    public function add_item(string $name, int $category_id, string $quantity, float $price, $image = "", string $desc = ""): bool {
        return boolval($this->database->query("INSERT INTO products(fk_id_categories, name, description, quantity, price, image) VALUES(?,?,?,?,?,?)",
            $category_id, $name, $desc, $quantity, $price, $image)->affected_rows());
    }
}