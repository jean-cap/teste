<?php


namespace App\Model\Entity;


use App\Model\Database;

class Products
{
    public $id;

    public $name;

    public $price;

    public $tax;

    public $type;

    public static function getProducts($where = null, $order = null, $limit = null, $fields = '*')
    {
        return (new Database('products'))->select($where, $order, $limit, $fields);
    }

    public function cadastrar()
    {
        $this->id = (new Database('products'))->insert([
            'name' => $this->name,
            'price' => $this->price,
            'tax' => $this->tax,
            'type' => $this->type
        ]);

        return true;
    }
}