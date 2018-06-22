<?php

namespace App\Shop\ProductComments\Repositories;

use App\Shop\Base\Interfaces\BaseRepositoryInterface;
use Illuminate\Support\Collection;

interface ProductCommentRepositoryInterface extends BaseRepositoryInterface
{
    public function findProductCommentById(int $id);
    public function listComments(string $order = 'id', string $sort = 'desc', array $columns = ['*']) : Collection;
}
