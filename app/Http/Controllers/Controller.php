<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;

abstract class Controller
{
    protected function sendResponse(mixed $data, int $status = Response::HTTP_OK)
    {
        return response()->json($data, $status);
    }
}
