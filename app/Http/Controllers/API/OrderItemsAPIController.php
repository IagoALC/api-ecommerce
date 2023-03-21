<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrderItemsAPIRequest;
use App\Http\Requests\API\UpdateOrderItemsAPIRequest;
use App\Models\OrderItems;
use App\Repositories\OrderItemsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class OrderItemsAPIController
 */
class OrderItemsAPIController extends AppBaseController
{
    private OrderItemsRepository $orderItemsRepository;

    public function __construct(OrderItemsRepository $orderItemsRepo)
    {
        $this->orderItemsRepository = $orderItemsRepo;
    }

    /**
     * Display a listing of the OrderItems.
     * GET|HEAD /order-items
     */
    public function index(Request $request): JsonResponse
    {
        $orderItems = $this->orderItemsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($orderItems->toArray(), 'Order Items retrieved successfully');
    }

    /**
     * Store a newly created OrderItems in storage.
     * POST /order-items
     */
    public function store(CreateOrderItemsAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $orderItems = $this->orderItemsRepository->create($input);

        return $this->sendResponse($orderItems->toArray(), 'Order Items saved successfully');
    }

    /**
     * Display the specified OrderItems.
     * GET|HEAD /order-items/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var OrderItems $orderItems */
        $orderItems = $this->orderItemsRepository->find($id);

        if (empty($orderItems)) {
            return $this->sendError('Order Items not found');
        }

        return $this->sendResponse($orderItems->toArray(), 'Order Items retrieved successfully');
    }

    /**
     * Update the specified OrderItems in storage.
     * PUT/PATCH /order-items/{id}
     */
    public function update($id, UpdateOrderItemsAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var OrderItems $orderItems */
        $orderItems = $this->orderItemsRepository->find($id);

        if (empty($orderItems)) {
            return $this->sendError('Order Items not found');
        }

        $orderItems = $this->orderItemsRepository->update($input, $id);

        return $this->sendResponse($orderItems->toArray(), 'OrderItems updated successfully');
    }

    /**
     * Remove the specified OrderItems from storage.
     * DELETE /order-items/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var OrderItems $orderItems */
        $orderItems = $this->orderItemsRepository->find($id);

        if (empty($orderItems)) {
            return $this->sendError('Order Items not found');
        }

        $orderItems->delete();

        return $this->sendSuccess('Order Items deleted successfully');
    }
}
