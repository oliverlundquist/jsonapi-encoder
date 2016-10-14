<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use OliverLundquist\ProductResource;
use OliverLundquist\CategoryResource;
use OliverLundquist\ProductSchema;
use OliverLundquist\ProductCategorySchema;
use OliverLundquist\CategorySchema;
use OliverLundquist\ProductCategory;
use Neomerx\JsonApi\Encoder\Encoder;
use Neomerx\JsonApi\Encoder\EncoderOptions;
use Neomerx\JsonApi\Document\Link;

$product1 = new ProductResource;
$product1->id = 2;
$product1->firstName = 'Oliver';
$product1->lastName  = 'Lundquist';

$product2 = new ProductResource;
$product2->id = 3;
$product2->firstName = 'Oliver';
$product2->lastName  = 'Lundquist';

// $options = JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT;
$encoder = Encoder::instance([
    ProductResource::class  => ProductSchema::class,
    CategoryResource::class => CategorySchema::class,
    ProductCategory::class => ProductCategorySchema::class,
], new EncoderOptions($options = JSON_PRETTY_PRINT, $urlPrefix = 'http://example.com'));

$data = $encoder->encodeData([$product1, $product2]);
echo $data . PHP_EOL;

$encoder2 = Encoder::instance([
    ProductResource::class  => ProductSchema::class,
    CategoryResource::class => CategorySchema::class,
    ProductCategory::class => ProductCategorySchema::class,
], new EncoderOptions($options = JSON_PRETTY_PRINT));

$productCategory1 = new ProductCategory;
$productCategory1->id = 22;
$productCategory2 = new ProductCategory;
$productCategory2->id = 33;

$data = $encoder2
            ->withLinks([
                'self'    => new Link('/articles/1/relationships/tags'),
                'related' => new Link('/articles/1/tags')
            ])
            ->encodeData([$productCategory1, $productCategory2]);


echo $data . PHP_EOL;

// {
//   "links": {
//     "self": "/articles/1/relationships/tags",
//     "related": "/articles/1/tags"
//   },
//   "data": [
//     { "type": "tags", "id": "2" },
//     { "type": "tags", "id": "3" }
//   ]
// }
