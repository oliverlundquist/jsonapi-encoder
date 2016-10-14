<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use OliverLundquist\ProductResource;
use OliverLundquist\ProductTransformer;
use OliverLundquist\ProductCategoryResource;
use OliverLundquist\ProductCategoryTransformer;
use Neomerx\JsonApi\Encoder\Encoder;
use Neomerx\JsonApi\Encoder\EncoderOptions;
use Neomerx\JsonApi\Document\Link;

$options = JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT;
$urlPrefix = 'https://api.mystore.no';

$encoder = Encoder::instance([
    ProductResource::class         => ProductTransformer::class,
    ProductCategoryResource::class => ProductCategoryTransformer::class,
], new EncoderOptions($options, $urlPrefix));

$product1 = new ProductResource;
$product1->id = 2;
$product1->productName = ['se' => 'Mjolk', 'no' => 'Melk'];
$product1->quantity  = '24';
$product2 = new ProductResource;
$product2->id = 3;
$product2->productName = ['se' => 'Cykel', 'no' => 'Sykkel'];
$product2->quantity  = '48';

$data = $encoder->encodeData([$product1, $product2]);
echo $data . PHP_EOL;

$productCategory1 = new ProductCategoryResource;
$productCategory1->id = 22;
$productCategory2 = new ProductCategoryResource;
$productCategory2->id = 33;

$data = $encoder
                ->withLinks([
                    'self'    => new Link('/articles/1/relationships/tags'),
                    'related' => new Link('/articles/1/tags')
                ])
                ->encodeData([$productCategory1, $productCategory2]);

echo $data . PHP_EOL;
