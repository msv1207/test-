<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\Movie\MovieService;

class MovieController extends Controller
{
    public function getTitles(Request $request, MovieService $movieService): JsonResponse
    {
        $titles = $movieService->getTitles();

        return response()->json($titles);
    }
}
