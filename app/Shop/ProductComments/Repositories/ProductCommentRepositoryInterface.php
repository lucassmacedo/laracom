<?php

namespace App\Shop\ProductComments\Repositories;

use App\Shop\Base\Interfaces\BaseRepositoryInterface;

interface ProductCommentRepositoryInterface extends BaseRepositoryInterface
{
    public function findProductAttributeById(int $id);
}
