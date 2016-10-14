<?php declare(strict_types=1);

namespace OliverLundquist;

use Neomerx\JsonApi\Schema\SchemaProvider;
use Neomerx\JsonApi\Document\Link;

class ProductSchema extends SchemaProvider
{
    protected $resourceType = 'products';

    public function getId($product)
    {
        /** @var Author $product */
        return $product->id;
    }

    public function getAttributes($product)
    {
        /** @var Author $product */
        return [
            'first_name' => $product->firstName,
            'last_name'  => $product->lastName,
        ];
    }

    public function getIncludePaths()
    {
        return [
            'posts',
            'posts.author',
            'posts.comments',
        ];
    }

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
        var_dump($resource, $isPrimary, $includeRelationships);

        $data = new CategoryResource;
        $data->id = 500;
        // $data->data = [];
        // $data->type = 'categories';
        // $data->name = 'asdjkasd';
        // $data->something = 'else';

        return [
            'categories' => [self::SHOW_RELATED => true],
        ];

        // return [
        //             'categories' => [
        //                 // self::DATA         => $data,
        //                 self::DATA         => false,
        //                 self::SHOW_SELF    => true,
        //                 self::SHOW_RELATED => true,
        //                 self::META => function () use ($data) {
        //                             return [
        //                                 'total' => count($data),
        //                             ];
        //                         },
        //                 self::LINKS => [
        //                                     Link::FIRST => new Link('/first')
        //                                 ]
        //             ]
        //         ];


        // // $resource = new CategoryResource;
        // // $isPrimary = true;
        // // $includeRelationships = ['categories'];
        // return ['cateogries' => $data];
    }
}
