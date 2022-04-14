<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mechanic\StoreMechanicRequest;
use App\Http\Resources\MechanicResource;
use App\Models\Mechanic;
use App\Models\Photo;
use App\Services\MechanicsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MechanicsController extends Controller
{
    /** @var MechanicsService */
    protected $mechanicsService;

    /**
     * @param MechanicsService $mechanicsService
     */
    public function __construct(MechanicsService $mechanicsService)
    {
        $this->mechanicsService = $mechanicsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(
            MechanicResource::collection($this->mechanicsService->getAll()),
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMechanicRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreMechanicRequest $request): JsonResponse
    {
        return response()->json(
            $this->mechanicsService->store($request->validated()),
            JsonResponse::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $mechanicId
     *
     * @return JsonResponse
     */
    public function show(int $mechanicId): JsonResponse
    {
        return response()->json(
            MechanicResource::make($this->mechanicsService->getById($mechanicId)),
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
