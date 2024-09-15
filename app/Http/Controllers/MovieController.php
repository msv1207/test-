<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\Movie\MovieService;
use App\Services\Movie\NotStoredAndUnavailableException;

class MovieController extends Controller
{
    public function getTitles(Request $request, MovieService $movieService): JsonResponse
    {
        try {
            $titles = $movieService->getTitles();
        } catch (NotStoredAndUnavailableException $exception) {
            return response()->json(['status' => 'failure']);
        }

        return response()->json($titles);
    }
}
