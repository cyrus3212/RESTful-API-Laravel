<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

trait ApiResponser
{
    private function successResponse ($data, $code) 
    {
        return response()->json($data, $code);
    }

    protected function errorResponse ($message, $code) 
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    protected function showAll (Collection $collection, $code = 200) 
    {
        // Avoid empty collection to be transformed
        // return just empty collection
        if ($collection->isEmpty()) {
            return $this->successResponse(['data' => $collection], $code);
        }
        // Get the transformer of its collection
        // Use the first element collection to obtain its transformer
        $transformer = $collection->first()->transformer;

        $collection = $this->transformData($collection, $transformer);
        return $this->successResponse($collection, $code);
    }

    protected function showOne (Model $instance, $code = 200)
    {
        // Get instance transformer
        $transformer = $instance->transformer;

        $instance = $this->transformData($instance, $transformer);

        return $this->successResponse($instance, $code);
    }

    protected function message($message, $code = 200)
    {
        return $this->successResponse(['data' => $message], $code);
    }

    protected function transformData($data, $transformer)
    {
        $transformation = fractal($data, new $transformer);
         // dd($transformation->toArray());
        return $transformation->toArray();
    }
}