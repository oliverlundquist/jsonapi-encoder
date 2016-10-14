<?php declare(strict_types=1);

namespace OliverLundquist;

use Neomerx\JsonApi\Schema\SchemaProvider;

class ProductCategorySchema extends SchemaProvider
{
    protected $resourceType = 'tags';

    public function getId($productCategory)
    {
        return $productCategory->id;
    }

    /**
     * @inheritdoc
     */
    // public function getSelfSubLink($resource)
    // {
    //     //
    // }
    public function getResourceLinks($resource)
    {
        //
    }

    public function getAttributes($productCategory)
    {
        // var_dump(self::SHOW_SELF);
        // var_dump(self::SHOW_SELF);
        // self::SHOW_SELF = false;
        /** @var Author $productCategory */
        // return [
            //
        // ];
    }
}
