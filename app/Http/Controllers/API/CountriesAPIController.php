<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCountriesAPIRequest;
use App\Http\Requests\API\UpdateCountriesAPIRequest;
use App\Models\Countries;
use App\Repositories\CountriesRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Log;

/**
 * Class CountriesAPIController
 */
class CountriesAPIController extends AppBaseController
{
    private CountriesRepository $countriesRepository;

    public function __construct(CountriesRepository $countriesRepo)
    {
        $this->countriesRepository = $countriesRepo;
    }

    /**
     * Display a listing of the Forms.
     */
    public function index(Request $request)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG CountriesRepository-index: company {$User->company_id} user_id {$User->id} from ip {$request->ip()}");
        $input = $request->all();
        $resp = $this->countriesRepository->filter($input, $User);
        return $resp->toJson(); 
    }

    public function store(CreateCountriesAPIRequest $request)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG CountriesRepository-store: company {$User->company_id} user_id {$User->id} from ip {$request->ip()}");
        $input = $request->all();
        $resp = $this->countriesRepository->create($input);
        return $resp->toJson();
    }

    public function update($id, UpdateCountriesAPIRequest $request)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG CountriesRepository-update: company {$User->company_id} user_id {$User->id} from ip {$request->ip()}");
        $resp = $this->countriesRepository->update($request->all(), $id);
        return $resp->toJson();
    }

    public function destroy($id)
    {
        $User = auth()->guard('api')->user();
        Log::debug("MONITORING-LOG CountriesRepository-destroy: company {$User->company_id} user_id {$User->id}");
        $this->countriesRepository->delete($id);
        return "true";     
    }
}
