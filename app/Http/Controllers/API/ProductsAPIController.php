<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductsAPIRequest;
use App\Http\Requests\API\UpdateProductsAPIRequest;
use App\Models\Products;
use App\Repositories\ProductsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Log;

/**
 * Class ProductsAPIController
 */
class ProductsAPIController extends AppBaseController
{
    private ProductsRepository $productsRepository;

    public function __construct(ProductsRepository $productsRepo)
    {
        $this->productsRepository = $productsRepo;
    }

    /**
     * Display a listing of the Forms.
     */
    public function index(Request $request)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG ProductsRepository-index: company {$User->company_id} user_id {$User->id} from ip {$request->ip()}");
        $input = $request->all();
        $resp = $this->productsRepository->filter($input, $User);
        return $resp->toJson(); 
    }

    public function store(CreateProductsAPIRequest $request)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG ProductsRepository-store: company {$User->company_id} user_id {$User->id} from ip {$request->ip()}");
        $input = $request->all();
        $resp = $this->productsRepository->create($input);
        return $resp->toJson();
    }

    public function update($id, UpdateProductsAPIRequest $request)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG ProductsRepository-update: company {$User->company_id} user_id {$User->id} from ip {$request->ip()}");
        $resp = $this->productsRepository->update($request->all(), $id);
        return $resp->toJson();
    }

    public function destroy($id)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG ProductsRepository-destroy: company {$User->company_id} user_id {$User->id}");
        $this->productsRepository->delete($id);
        return "true";     
    }
}
