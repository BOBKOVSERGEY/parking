<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class PasswordUpdateController extends Controller
{
    public function __invoke(PasswordUpdateRequest $request): JsonResponse
    {
        $request->validated();

        auth()->user()->update([
            'password' => Hash::make($request->input('password'))
        ]);

        return response()->json([
            'message' => 'Your password has been updated.'
        ], Response::HTTP_ACCEPTED);
    }
}
