<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;

class HealthCheckController extends Controller
{
    /**
     * Provision a new web server.
     */
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'status' => 'This is the fucking hell!',
            'timestamp' => now()->toDateTimeString(),
        ]);
    }
}
