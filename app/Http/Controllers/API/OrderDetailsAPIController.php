<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrderDetailsAPIRequest;
use App\Http\Requests\API\UpdateOrderDetailsAPIRequest;
use App\Models\OrderDetails;
use App\Repositories\OrderDetailsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Log;

/**
 * Class OrderDetailsAPIController
 */
class OrderDetailsAPIController extends AppBaseController
{
    private OrderDetailsRepository $orderDetailsRepository;

    public function __construct(OrderDetailsRepository $orderDetailsRepo)
    {
        $this->orderDetailsRepository = $orderDetailsRepo;
    }

    /**
     * Display a listing of the Forms.
     */
    public function index(Request $request)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG OrderDetailsRepository-index: company {$User->company_id} user_id {$User->id} from ip {$request->ip()}");
        $input = $request->all();
        $resp = $this->orderDetailsRepository->filter($input, $User);
        return $resp->toJson(); 
    }

    public function store(CreateOrderDetailsAPIRequest $request)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG OrderDetailsRepository-store: company {$User->company_id} user_id {$User->id} from ip {$request->ip()}");
        $input = $request->all();
        $resp = $this->orderDetailsRepository->create($input);
        return $resp->toJson();
    }

    public function update($id, UpdateOrderDetailsAPIRequest $request)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG OrderDetailsRepository-update: company {$User->company_id} user_id {$User->id} from ip {$request->ip()}");
        $resp = $this->orderDetailsRepository->update($request->all(), $id);
        return $resp->toJson();
    }

    public function destroy($id)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG OrderDetailsRepository-destroy: company {$User->company_id} user_id {$User->id}");
        $this->orderDetailsRepository->delete($id);
        return "true";     
    }
}
