<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use OliverLundquist\ProductResource;
use OliverLundquist\ProductTransformer;
use OliverLundquist\ProductCategoryResource;
use OliverLundquist\ProductCategoryTransformer;
use OliverLundquist\Response;
use Neomerx\JsonApi\Encoder\Encoder;
use Neomerx\JsonApi\Encoder\EncoderOptions;
use Neomerx\JsonApi\Document\Link;
use Neomerx\JsonApi\Encoder\Parameters\EncodingParameters;
use Neomerx\JsonApi\Encoder\Parameters\SortParameter;
use Neomerx\JsonApi\Factories\Factory;
use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Client;
use Neomerx\JsonApi\Document\Error;
use Neomerx\JsonApi\Exceptions\JsonApiException;

$options = JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT;
$urlPrefix = 'https://api.mystore.no';

$encoder = Encoder::instance([
    ProductResource::class         => ProductTransformer::class,
    ProductCategoryResource::class => ProductCategoryTransformer::class,
], new EncoderOptions($options, $urlPrefix));


// ////////////// //
//  HTTP REQUEST  //
// ////////////// //
$get = ['page' => ['number' => '3', 'size' => '1'], 'somenonsense' => 'hey'];
$request = (new ServerRequest('GET', 'http://example.com/articles?somenonsense=hey&page[number]=3&page[size]=1&page[sizez]=1'))
                    ->withQueryParams($get);
$factory = new Factory();
$parsedParameters = $factory->createQueryParametersParser()->parse($request);
$parameters = new EncodingParameters(
    $includePaths = null,
    $fieldSets = null,
    $sortParameters = null,
    $pagingParameters = null,
    $filteringParameters = null,
    $unrecognizedParams = null
);
$allowUnrecognised   = false;
$includePaths        = ['author', 'comments'];
$fieldSetTypes       = ['header', 'created-at', 'updated-at'];
$sortParameters      = ['created-at', 'updated-at'];
$pagingParameters    = ['first', 'last', 'number', 'size'];
$filteringParameters = ['header', 'body', 'created-at', 'updated-at'];
$checker = $factory->createQueryChecker(
    $allowUnrecognised,
    $includePaths,
    $fieldSetTypes,
    $sortParameters,
    $pagingParameters,
    $filteringParameters
);
try {
    $checker->checkQuery($parsedParameters);
}
catch (JsonApiException $e) {
    // var_dump($e->getErrors());
    // var_dump($e->getHttpCode());
    $response = new Response($encoder);
    list($body, $status, $headers) = $response->getErrorResponse($e->getErrors());
    var_dump($body, $status);
    exit(1);
}

$product1 = new ProductResource;
$product1->id = 2;
$product1->productName = ['se' => 'Mjolk', 'no' => 'Melk'];
$product1->quantity  = '24';
$product2 = new ProductResource;
$product2->id = 3;
$product2->productName = ['se' => 'Cykel', 'no' => 'Sykkel'];
$product2->quantity  = '48';

$links = [
    Link::FIRST => new Link('/authors?page=1'),
    Link::LAST  => new Link('/authors?page=4'),
    Link::NEXT  => new Link('/authors?page=6'),
    Link::LAST  => new Link('/authors?page=9'),
];

$response = new Response($encoder);
var_dump( $response->getContentResponse($product1, 200, $links) );
exit(1);


$data = $encoder->encodeData([$product1, $product2], $parameters);
echo $data . PHP_EOL;
exit(1);


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

// echo $data . PHP_EOL;
