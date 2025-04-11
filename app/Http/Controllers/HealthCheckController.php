<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;
use Exception;

class HealthCheckController extends Controller
{
    /**
     * @OA\Get(
     *     path="/status",
     *     summary="Health check",
     *     @OA\Response(response="200", description="OK")
     * )
     */
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'status' => 'This is the fucking hell!',
            'data' => [
                'app'   => true,
                'db'    => $this->checkDatabase(),
                'cache' => $this->checkCache(),
            ],
            'timestamp' => now()->toDateTimeString(),
        ]);
    }

    private function checkDatabase(): bool
    {
        try {
            DB::connection()->getPdo();
            return true;
        } catch (Exception $e) {
            Log::warning('Database connection error', [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);

            return false;
        }
    }

    private function checkCache(): bool
    {
        try {
            Cache::put('health_check', 1, 10);
            return Cache::get('health_check') === 1;
        } catch (Throwable $e) {
            Log::error('Cache connection error', [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);

            return false;
        }
    }
}
