<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseController extends Controller
{
    public function response(): Response
    {
        return response('Hello Response!');
    }

    public function header(Request $request): Response
    {
        $body = $request->input();

        return response(json_encode($body), 200)
            ->header('Content-Type', 'application/json')
            ->withHeaders([
                'Author' => 'mamlzy',
                'App' => 'Belajar Laravel'
            ]);
    }

    public function responseView(Request $request): Response
    {
        $name = $request->input('name');

        return response()->view('hello', [
            'name' => $name
        ]);
    }

    public function responseJson(Request $request): JsonResponse
    {
        $body = $request->input();

        return response()->json($body);
    }

    public function responseFile(Request $request): BinaryFileResponse
    {
        return response()->file(storage_path('app/public/pictures/dog.jpg'));
    }

    public function responseDownload(Request $request): BinaryFileResponse
    {
        return response()->download(storage_path('app/public/pictures/dog.jpg'), 'dog.jpg');
    }
}
