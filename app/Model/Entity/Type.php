<?php


namespace App\Model\Entity;


use App\Model\Database;

class Type
{
    public $id;

    public $name;

    public static function getType($where = null)
    {
        return (new Database('types'))->select($where);
    }

    public static function getTypes($where = null, $order = null, $limit = null, $fields = '*')
    {
        return (new Database('types'))->select($where, $order, $limit, $fields);
    }

    public function cadastrar()
    {
        $this->id = (new Database('types'))->insert([
            'name' => $this->name
        ]);

        return true;
    }
}