<?php

namespace Tests\Unit\ProductAttributes;

use App\Shop\Customers\Customer;
use App\Shop\ProductComments\Exceptions\ProductCommentNotFoundException;
use App\Shop\ProductComments\ProductComment;
use App\Shop\ProductComments\Repositories\ProductCommentRepository;
use App\Shop\Products\Product;
use App\Shop\Products\Repositories\ProductRepository;
use Tests\TestCase;

class ProductCommentsUnitTest extends TestCase
{

    /** @test */
    public function it_throws_error_when_the_product_comment_is_not_found()
    {
        $this->expectException(ProductCommentNotFoundException::class);

        $productCommentRepo = new ProductCommentRepository(new ProductComment());
        $productCommentRepo->findProductCommentById(999);
    }

    /** @test */
    public function it_can_find_the_product_comment_by_id()
    {
        $productComment = factory(ProductComment::class)->create([
            'product_id' => $this->product->id
        ]);

        $productCommentRepo = new ProductCommentRepository(new ProductComment);
        $found = $productCommentRepo->findProductCommentById($productComment->id);

        $this->assertEquals($productComment->customer_id, $found->customer_id);
        $this->assertEquals($productComment->product_id, $found->product_id);
    }

    /** @test */
    public function it_returns_null_deleting_non_existing_product_comment()
    {
        $product = factory(Product::class)->create();
        $productRepo = new ProductRepository($product);
        $deleted = $productRepo->removeProductComments(new ProductComment());

        $this->assertNull($deleted);
    }

    /** @test */
    public function it_can_create_product_comment()
    {
        $customer = factory(Customer::class)->create();
        $product = factory(Product::class)->create();

        $data = [
            'customer_id' => $customer->id,
            'product_id'  => $product->id,
            'comment'     => 'lorem ipsum',
            'approved'    => true,
            'evaluation'  => 5,
        ];

        $productComment = new ProductComment($data);

        $product = factory(Product::class)->create();
        $productRepo = new ProductRepository($product);
        $created = $productRepo->saveProductComments($productComment);

        $this->assertInstanceOf(ProductComment::class, $created);
        $this->assertInstanceOf(Product::class, $productComment->product);

    }
}
