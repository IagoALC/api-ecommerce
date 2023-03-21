<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCustomersAPIRequest;
use App\Http\Requests\API\UpdateCustomersAPIRequest;
use App\Models\Customers;
use App\Repositories\CustomersRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Log;

/**
 * Class CustomersAPIController
 */
class CustomersAPIController extends AppBaseController
{
    private CustomersRepository $customersRepository;

    public function __construct(CustomersRepository $customersRepo)
    {
        $this->customersRepository = $customersRepo;
    }

    /**
     * Display a listing of the Forms.
     */
    public function index(Request $request)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG CustomersRepository-index: company {$User->company_id} user_id {$User->id} from ip {$request->ip()}");
        $input = $request->all();
        $resp = $this->customersRepository->filter($input, $User);
        return $resp->toJson(); 
    }

    public function store(CreateCustomersAPIRequest $request)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG CustomersRepository-store: company {$User->company_id} user_id {$User->id} from ip {$request->ip()}");
        $input = $request->all();
        $resp = $this->customersRepository->create($input);
        return $resp->toJson();
    }

    public function update($id, UpdateCustomersAPIRequest $request)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG CustomersRepository-update: company {$User->company_id} user_id {$User->id} from ip {$request->ip()}");
        $resp = $this->customersRepository->update($request->all(), $id);
        return $resp->toJson();
    }

    public function destroy($id)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG CustomersRepository-destroy: company {$User->company_id} user_id {$User->id}");
        $this->customersRepository->delete($id);
        return "true";     
    }
}
