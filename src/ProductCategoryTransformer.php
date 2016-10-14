<?php declare(strict_types=1);

namespace OliverLundquist;

use Neomerx\JsonApi\Schema\SchemaProvider;

class ProductCategoryTransformer extends SchemaProvider
{
    protected $resourceType = 'categories';

    public function getId($productCategory)
    {
        return $productCategory->id;
    }

    public function getResourceLinks($resource)
    {
        // do not return links
    }

    public function getAttributes($productCategory)
    {
        // do not return attributes
    }
}
