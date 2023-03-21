<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCartItemsAPIRequest;
use App\Http\Requests\API\UpdateCartItemsAPIRequest;
use App\Models\CartItems;
use App\Repositories\CartItemsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Log;

/**
 * Class CartItemsAPIController
 */
class CartItemsAPIController extends AppBaseController
{
    private CartItemsRepository $cartItemsRepository;

    public function __construct(CartItemsRepository $cartItemsRepo)
    {
        $this->cartItemsRepository = $cartItemsRepo;
    }

    /**
     * Display a listing of the Forms.
     */
    public function index(Request $request)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG CartItemsRepository-index: company {$User->company_id} user_id {$User->id} from ip {$request->ip()}");
        $input = $request->all();
        $resp = $this->cartItemsRepository->filter($input, $User);
        return $resp->toJson(); 
    }

    public function store(CreateCartItemsAPIRequest $request)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG CartItemsRepository-store: company {$User->company_id} user_id {$User->id} from ip {$request->ip()}");
        $input = $request->all();
        $resp = $this->cartItemsRepository->create($input);
        return $resp->toJson();
    }

    public function update($id, UpdateCartItemsAPIRequest $request)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG CartItemsRepository-update: company {$User->company_id} user_id {$User->id} from ip {$request->ip()}");
        $resp = $this->cartItemsRepository->update($request->all(), $id);
        return $resp->toJson();
    }

    public function destroy($id)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG CartItemsRepository-destroy: company {$User->company_id} user_id {$User->id}");
        $this->cartItemsRepository->delete($id);
        return "true";     
    }
}
