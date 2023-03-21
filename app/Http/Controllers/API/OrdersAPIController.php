<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrdersAPIRequest;
use App\Http\Requests\API\UpdateOrdersAPIRequest;
use App\Models\Orders;
use App\Repositories\OrdersRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\UpdateOrdersRequest;
use Illuminate\Support\Facades\Log;

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
     * Display a listing of the Forms.
     */
    public function index(Request $request)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG OrdersRepository-index: company {$User->company_id} user_id {$User->id} from ip {$request->ip()}");
        $input = $request->all();
        $resp = $this->ordersRepository->filter($input, $User);
        return $resp->toJson(); 
    }

    public function store(CreateOrdersAPIRequest $request)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG OrdersRepository-store: company {$User->company_id} user_id {$User->id} from ip {$request->ip()}");
        $input = $request->all();
        $resp = $this->ordersRepository->create($input);
        return $resp->toJson();
    }

    public function update($id, UpdateOrdersAPIRequest $request)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG OrdersRepository-update: company {$User->company_id} user_id {$User->id} from ip {$request->ip()}");
        $resp = $this->ordersRepository->update($request->all(), $id);
        return $resp->toJson();
    }

    public function destroy($id)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG OrdersRepository-destroy: company {$User->company_id} user_id {$User->id}");
        $this->ordersRepository->delete($id);
        return "true";     
    }
}
