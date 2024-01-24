<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParkingStartRequest;
use App\Http\Resources\ParkingResource;
use App\Models\Parking;
use App\Services\ParkingPriceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;
/**
 * @group Parking
 */
class ParkingController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $activeParkings = Parking::active()
            ->latest('start_time')
            ->get();

        return ParkingResource::collection($activeParkings);
    }

    public function history(): AnonymousResourceCollection
    {
        $stoppedParkings = Parking::stopped()
            ->with(['vehicle' => fn ($q) => $q->withTrashed()])
            ->latest('stop_time')
            ->get();

        return ParkingResource::collection($stoppedParkings);
    }

    public function start(ParkingStartRequest $request): ParkingResource|JsonResponse
    {
        $data = $request->validated();

        if(Parking::active()->where('vehicle_id', $data['vehicle_id'])->exists()) {
            return response()->json([
                'errors' => ['general' => ['Can\'t start parking twice using same vehicle. Please stop currently active parking.']],
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $parking = Parking::query()->create($data);
        $parking->load(['vehicle', 'zone']);

        return ParkingResource::make($parking);
    }

    public function show(Parking $parking): ParkingResource
    {
        return ParkingResource::make($parking);
    }

    public function stop(Parking $parking): ParkingResource
    {
        $parking->update([
            'stop_time' => now(),
            'total_price' => ParkingPriceService::calculatePrice(
                $parking->zone_id, $parking->start_time
            )
        ]);

        return ParkingResource::make($parking);
    }
}
