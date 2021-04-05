<?php

namespace App\Traits;

trait ApiResponse
{
    public function successRes($data, $msg, $statusCode)
    {
        return response()
            ->json(['data' => $data, 'message' => $msg], $statusCode);
    }

    public function errorRes($data, $msg, $statusCode)
    {
        return response()
            ->json(['data' => $data, 'message' => $msg], $statusCode);
    }

    public function resourceResponse($resourceName, $data, $msg, $statusCode)
    {
        return (new $resourceName($data))
            ->additional(['message' => $msg])
            ->response()
            ->setStatusCode($statusCode);
    }

    public function collectionResponse($resourceName, $data, $msg, $statusCode)
    {
        return $resourceName::collection($data)
            ->additional(['message' => $msg])
            ->response()
            ->setStatusCode($statusCode);
    }
}