<?php
namespace App\Traits;

use Symfony\Component\HttpFoundation\Response;

trait ApiResponse
{
    public function successResponse($message, $data=null): \Illuminate\Http\JsonResponse
    {
        return $this->response($message,Response::HTTP_OK, $data);
    }

    public function errorResponse($message, $data=null, $code = Response::HTTP_BAD_REQUEST): \Illuminate\Http\JsonResponse
    {
        return $this->response($message, $code, $data);
    }

    protected function response($message, $code, $data): \Illuminate\Http\JsonResponse
    {
        return \response()->json([
            'msg'      => $message,
            'data' => $data
        ], $code);
    }

    public function dataResponse($data): \Illuminate\Http\JsonResponse
    {
        return \response()->json($data);
    }

}
