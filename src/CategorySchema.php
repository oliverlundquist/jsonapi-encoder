<?php declare(strict_types=1);

namespace OliverLundquist;

use Neomerx\JsonApi\Schema\SchemaProvider;

class CategorySchema extends SchemaProvider
{
    protected $resourceType = 'categories';

    public function getId($category)
    {
        /** @var Author $category */
        return $category->id;
    }

    public function getAttributes($category)
    {
        /** @var Author $category */
        return [
            'category_name' => $category->categoryName,
            'parent_id'  => $category->parentId,
        ];
    }
}
