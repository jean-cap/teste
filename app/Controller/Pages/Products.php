<?php


namespace App\Controller\Pages;


use App\Utils\View;
use App\Model\Entity\Products as EntityProduct;
use App\Model\Entity\Type as EntityType;
use App\Model\Pagination;


class Products extends Page
{
    public static function insertProduct($request)
    {
        $postVars = $request->getPostVars();

        $product = new EntityProduct();
        $product->name = $postVars['name'];
        $product->tax = $postVars['tax'];
        $product->type = $postVars['type'];

        $product->cadastrar();

        return self::getProducts($request);
    }

    public static function getProducts($request)
    {
        $content = View::render('pages/products', [
            'items' => self::getProductsItems($request, $pagination),
            'pagination' => parent::getPagination($request, $pagination),
            'options' => self::getOptions()
        ]);

        return parent::getPage('Produtos - Mercado Plus', $content);
    }

    private static function getProductsItems($request, &$pagination)
    {
        $items = '';

        $registries = EntityProduct::getProducts(null, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;

        $queryParams = $request->getQueryParams();
        $currentPage = $queryParams['page'] ?? 1;

        $pagination = new Pagination($registries, $currentPage, 5);

        $results = EntityProduct::getProducts(null, 'id DESC', $pagination->getLimit());

        while ($product = $results->fetchObject(EntityProduct::class)) {
            $type = EntityType::getType("id = $product->type")->fetchObject(EntityType::class);

            $items .= View::render('pages/product/item', [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'tax' => $product->tax,
                'type' => $type->name
            ]);
        }

        return $items;
    }

    private static function getOptions()
    {
        $options = '';

        $results = EntityType::getTypes(null, 'name ASC');

        while ($type = $results->fetchObject(EntityType::class)) {
            $options .= View::render('pages/product/options', [
                'id' => $type->id,
                'name' => $type->name
            ]);
        }

        return $options;
    }

    public static function insertType($request)
    {
        $postVars = $request->getPostVars();

        $type = new EntityType();
        $type->name = $postVars['name'];

        $type->cadastrar();

        return self::getProducts($request);
    }

    private static function getTypeItems($request, &$pagination)
    {
        $items = '';

        $registries = EntityType::getTypes(null, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;

        $queryParams = $request->getQueryParams();
        $currentPage = $queryParams['page'] ?? 1;

        $pagination = new Pagination($registries, $currentPage, 1);

        $results = EntityType::getTypes(null, 'id DESC', $pagination->getLimit());

        while ($product = $results->fetchObject(EntityType::class)) {
            $items .= View::render('pages/product/item', [
                'id' => $product->id,
                'name' => $product->name
            ]);
        }

        return $items;
    }
}