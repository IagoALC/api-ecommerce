<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCustomerAddressesAPIRequest;
use App\Http\Requests\API\UpdateCustomerAddressesAPIRequest;
use App\Models\CustomerAddresses;
use App\Repositories\CustomerAddressesRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Log;

/**
 * Class CustomerAddressesAPIController
 */
class CustomerAddressesAPIController extends AppBaseController
{
    private CustomerAddressesRepository $customerAddressesRepository;

    public function __construct(CustomerAddressesRepository $customerAddressesRepo)
    {
        $this->customerAddressesRepository = $customerAddressesRepo;
    }

    /**
     * Display a listing of the Forms.
     */
    public function index(Request $request)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG CustomerAddressesRepository-index: company {$User->company_id} user_id {$User->id} from ip {$request->ip()}");
        $input = $request->all();
        $resp = $this->customerAddressesRepository->filter($input, $User);
        return $resp->toJson(); 
    }

    public function store(CreateCustomerAddressesAPIRequest $request)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG CustomerAddressesRepository-store: company {$User->company_id} user_id {$User->id} from ip {$request->ip()}");
        $input = $request->all();
        $resp = $this->customerAddressesRepository->create($input);
        return $resp->toJson();
    }

    public function update($id, UpdateCustomerAddressesAPIRequest $request)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG CustomerAddressesRepository-update: company {$User->company_id} user_id {$User->id} from ip {$request->ip()}");
        $resp = $this->customerAddressesRepository->update($request->all(), $id);
        return $resp->toJson();
    }

    public function destroy($id)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG CustomerAddressesRepository-destroy: company {$User->company_id} user_id {$User->id}");
        $this->customerAddressesRepository->delete($id);
        return "true";     
    }
}
