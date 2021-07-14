<?php


namespace App\Controller\Pages;


use App\Model\Entity\Organization;
use App\Model\Entity\Products as EntityProduct;
use App\Model\Entity\Type as EntityType;
use App\Model\Pagination;
use App\Utils\View;

class Venda extends Page
{
    public static function getVenda($request)
    {

        $content = View::render('pages/venda', [
            'product_list_options' => self::getProductsCheckboxes($request, $pagination)
        ]);

        return parent::getPage('Venda - Mercado Plus', $content);
    }

    private static function getProductsCheckboxes($request, &$pagination)
    {
        $items = '';

        $registries = EntityProduct::getProducts(null, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;

        $queryParams = $request->getQueryParams();
        $currentPage = $queryParams['page'] ?? 1;

        $pagination = new Pagination($registries, $currentPage, 5);

        $results = EntityProduct::getProducts(null, 'id DESC', $pagination->getLimit());

        while ($product = $results->fetchObject(EntityProduct::class)) {
            $type = EntityType::getType("id = $product->type")->fetchObject(EntityType::class);

            $items .= View::render('pages/venda/product_list_options', [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'tax' => $product->tax,
                'type' => $type->name
            ]);
        }

        return $items;
    }
}