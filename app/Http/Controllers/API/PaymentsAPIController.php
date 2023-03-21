<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePaymentsAPIRequest;
use App\Http\Requests\API\UpdatePaymentsAPIRequest;
use App\Models\Payments;
use App\Repositories\PaymentsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Log;

/**
 * Class PaymentsAPIController
 */
class PaymentsAPIController extends AppBaseController
{
    private PaymentsRepository $paymentsRepository;

    public function __construct(PaymentsRepository $paymentsRepo)
    {
        $this->paymentsRepository = $paymentsRepo;
    }

    /**
     * Display a listing of the Forms.
     */
    public function index(Request $request)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG PaymentsRepository-index: company {$User->company_id} user_id {$User->id} from ip {$request->ip()}");
        $input = $request->all();
        $resp = $this->paymentsRepository->filter($input, $User);
        return $resp->toJson(); 
    }

    public function store(CreatePaymentsAPIRequest $request)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG PaymentsRepository-store: company {$User->company_id} user_id {$User->id} from ip {$request->ip()}");
        $input = $request->all();
        $resp = $this->paymentsRepository->create($input);
        return $resp->toJson();
    }

    public function update($id, UpdatePaymentsAPIRequest $request)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG PaymentsRepository-update: company {$User->company_id} user_id {$User->id} from ip {$request->ip()}");
        $resp = $this->paymentsRepository->update($request->all(), $id);
        return $resp->toJson();
    }

    public function destroy($id)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG PaymentsRepository-destroy: company {$User->company_id} user_id {$User->id}");
        $this->paymentsRepository->delete($id);
        return "true";     
    }
}
