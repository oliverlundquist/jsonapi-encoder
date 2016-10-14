<?php declare(strict_types=1);

namespace OliverLundquist;

use Neomerx\JsonApi\Schema\SchemaProvider;
use Neomerx\JsonApi\Document\Link;

class ProductTransformer extends SchemaProvider
{
    protected $resourceType = 'products';


    public function getId($product)
    {
        return $product->id;
    }

    public function getAttributes($product)
    {
        var_dump($product);
        return [
            'name' => $product->productName,
            'quantity'  => $product->quantity,
        ];
    }

    // public function getIncludePaths()
    // {
    //     return [
    //         'posts',
    //         'posts.author',
    //         'posts.comments',
    //     ];
    // }

    // protected function restore()
    // {
    //
    // }

    /**
     * Get resource links.
     *
     * @param object $resource
     * @param bool   $isPrimary
     * @param array  $includeRelationships A list of relationships that will be included as full resources.
     *
     * @return array
     */
    public function getRelationships($resource, $isPrimary, array $includeRelationships)
    {
        return [
            'categories' => [self::SHOW_RELATED => true],
        ];

        // return [
        //     'categories' => [
        //         self::DATA         => $data,
        //         self::SHOW_SELF    => true,
        //         self::SHOW_RELATED => true,
        //         self::META => function () use ($data) {
        //             return ['total' => count($data)];
        //         },
        //         self::LINKS => [
        //             Link::FIRST => new Link('/first')
        //         ]
        //     ]
        // ];
    }
}
