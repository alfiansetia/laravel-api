<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class Controller
{
    public function get_limit(Request $request)
    {
        $limit = 10;
        if ($request->filled('limit') && $request->limit > 0 && is_numeric($request->limit)) {
            $limit = $request->limit;
        }
        return $limit;
    }

    public function send_response(string $message = '', mixed $data = [], int $code = 200)
    {
        return response()->json([
            'message'   => $message,
            'data'      => $data,
        ], $code);
    }

    public function send_json(mixed $data = [], int $code = 200)
    {
        return response()->json($data, $code);
    }

    public function send_response_not_found(string $message = 'Data Not Found!', mixed $data = null)
    {
        return response()->json([
            'message'   => $message,
            'data'      => $data,
        ], 404);
    }

    public function send_response_unauthorize(string $message = 'Unauthorize!', mixed $data = null)
    {
        return response()->json([
            'message'   => $message,
            'data'      => $data,
        ], 403);
    }

    public function send_response_unauthenticate(string $message = 'Unauthenticate, Please Login!', mixed $data = null)
    {
        return response()->json([
            'message'   => $message,
            'data'      => $data,
        ], 401);
    }

    public function send_error(string $message = 'Server Error!', mixed $data = null)
    {
        return response()->json([
            'message'   => $message,
            'data'      => $data,
        ], 500);
    }
}
