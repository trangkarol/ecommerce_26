<?php

namespace App\Repositories\Order;

interface OrderInterface
{
    public function createOrderMultiple($orders, $orderDetails);

    public function getOrders();

    public function getOrderUsers();

    public function searchOrder($input);

    public function changeStatus($id, $status);
}
