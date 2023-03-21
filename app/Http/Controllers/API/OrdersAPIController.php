<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrdersAPIRequest;
use App\Http\Requests\API\UpdateOrdersAPIRequest;
use App\Models\Orders;
use App\Repositories\OrdersRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class OrdersAPIController
 */
class OrdersAPIController extends AppBaseController
{
    private OrdersRepository $ordersRepository;

    public function __construct(OrdersRepository $ordersRepo)
    {
        $this->ordersRepository = $ordersRepo;
    }

    /**
     * Display a listing of the Orders.
     * GET|HEAD /orders
     */
    public function index(Request $request): JsonResponse
    {
        $orders = $this->ordersRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($orders->toArray(), 'Orders retrieved successfully');
    }

    /**
     * Store a newly created Orders in storage.
     * POST /orders
     */
    public function store(CreateOrdersAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $orders = $this->ordersRepository->create($input);

        return $this->sendResponse($orders->toArray(), 'Orders saved successfully');
    }

    /**
     * Display the specified Orders.
     * GET|HEAD /orders/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Orders $orders */
        $orders = $this->ordersRepository->find($id);

        if (empty($orders)) {
            return $this->sendError('Orders not found');
        }

        return $this->sendResponse($orders->toArray(), 'Orders retrieved successfully');
    }

    /**
     * Update the specified Orders in storage.
     * PUT/PATCH /orders/{id}
     */
    public function update($id, UpdateOrdersAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Orders $orders */
        $orders = $this->ordersRepository->find($id);

        if (empty($orders)) {
            return $this->sendError('Orders not found');
        }

        $orders = $this->ordersRepository->update($input, $id);

        return $this->sendResponse($orders->toArray(), 'Orders updated successfully');
    }

    /**
     * Remove the specified Orders from storage.
     * DELETE /orders/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Orders $orders */
        $orders = $this->ordersRepository->find($id);

        if (empty($orders)) {
            return $this->sendError('Orders not found');
        }

        $orders->delete();

        return $this->sendSuccess('Orders deleted successfully');
    }
}
