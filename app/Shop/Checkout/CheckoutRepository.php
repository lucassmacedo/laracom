<?php

namespace App\Shop\Checkout;

use App\Shop\Carts\Repositories\CartRepository;
use App\Shop\Carts\ShoppingCart;
use App\Shop\OrderDetails\OrderProduct;
use App\Shop\OrderDetails\Repositories\OrderProductRepository;
use App\Shop\Orders\Order;
use App\Shop\Orders\Repositories\OrderRepository;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CheckoutRepository
{
    /**
     * @param array $data
     * @return Order
     */
    public function buildCheckoutItems(array $data) : Order
    {

        $this->validateFields($data);

        $orderRepo = new OrderRepository(new Order);
        $cartRepo = new CartRepository(new ShoppingCart);
        $orderProductRepo = new OrderProductRepository(new OrderProduct);

        $order = $orderRepo->create([
            'reference' => $data['reference'],
            'courier_id' => $data['courier_id'],
            'customer_id' => $data['customer_id'],
            'address_id' => $data['address_id'],
            'order_status_id' => $data['order_status_id'],
            'payment' => $data['payment'],
            'discounts' => $data['discounts'],
            'total_products' => $data['total_products'],
            'total' => $data['total'],
            'total_paid' => $data['total_paid'],
            'tax' => $data['tax']
        ]);

        $orderProductRepo->buildOrderDetails($order, $cartRepo->getCartItems());

        return $order;
    }

    /**
     * @param $data
     * @return Redirect|$this
     */
    private function validateFields($data)
    {
        $validator = Validator::make($data, [
            'reference',
            'courier_id',
            'customer_id',
            'address_id',
            'order_status_id',
            'payment',
            'discounts',
            'total_products',
            'total',
            'total_paid',
            'tax'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('checkout.index')
                ->withErrors($validator)
                ->withInput();
        }
    }
}