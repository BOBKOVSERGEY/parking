<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * @group Auth
 */
class ProfileController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        return response()->json(
            $request->user()->only('name', 'email')
        );
    }

    public function update(UserUpdateRequest $request): JsonResponse
    {
        auth()->user()->update($request->validated());
        return response()->json(
            data: $request->validated(),
            status: Response::HTTP_ACCEPTED
        );
    }
}
