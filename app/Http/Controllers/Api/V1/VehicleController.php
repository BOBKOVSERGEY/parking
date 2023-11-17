<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleStoreRequest;
use App\Http\Requests\VehicleUpdateRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class VehicleController extends Controller
{

    public function index(): AnonymousResourceCollection
    {
        return VehicleResource::collection(Vehicle::all());
    }

    public function store(VehicleStoreRequest $request): VehicleResource
    {
        $vehicle = Vehicle::query()
            ->create($request->validated());
        return VehicleResource::make($vehicle);
    }

    public function show(Vehicle $vehicle): VehicleResource
    {
        return VehicleResource::make($vehicle);
    }

    public function update(
        VehicleUpdateRequest $request,
        Vehicle $vehicle
    ): VehicleResource
    {
        $vehicle->update($request->validated());

        return VehicleResource::make($vehicle);
    }

    public function destroy(Vehicle $vehicle): Response
    {
        $vehicle->delete();
        return response()->noContent();
    }
}
