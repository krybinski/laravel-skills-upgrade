<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mechanic\StoreMechanicRequest;
use App\Http\Resources\MechanicResource;
use App\Models\Mechanic;
use App\Models\Photo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MechanicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        // TODO: move to MechanicService
        $mechanics = MechanicResource::collection(Mechanic::with('photos')->get());

        return response()->json($mechanics, JsonResponse::HTTP_OK);
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
        // TODO: move to MechanicService
        $mechanic = new Mechanic();
        $mechanic->name = $request->name;
        $mechanic->save();

        // MorphTo photos
        $mechanic->photos()->save(new Photo([
            'imageable_id' => $mechanic->id,
            'imageable_type' => Mechanic::class,
            'filename' => 'default.jpg',
        ]));

        return response()->json($mechanic, JsonResponse::HTTP_CREATED);
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
        // TODO: move to MechanicService
        $mechanic = MechanicResource::make(Mechanic::with('photos')->findOrFail($mechanicId));

        return response()->json($mechanic, JsonResponse::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
