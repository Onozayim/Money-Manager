<?php
namespace App\Traits;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

trait Utils
{
    public function returnSuccesJson()
    {
        return response()->json([
            'status' => 'done'
        ], Response::HTTP_OK);
    }

    public function returnSuccessMessage($msg) {
        return response()->json([
            'status' => 'done',
            'msg' => $msg
        ], Response::HTTP_OK);
    }

    public function returnDataJson($data, $key = 'data')
    {
        return response()->json([
            'status' => 'done',
            $key => $data
        ], Response::HTTP_OK);
    }

    public function returnErrorMessage($msg)
    {
        return response()->json([
            'status' => 'error',
            'msg' => $msg
        ], Response::HTTP_BAD_REQUEST);
    }

    public function returnErrorMessageWithException(Exception $ex)
    {
        Log::emergency("ERROR IN {$ex->getFile()} LINE {$ex->getLine()} - {$ex->getMessage()}");

        return response()->json([
            'status' => 'error',
            'msg' => 'Ah ocurrido un error, favor de ponerse en contacto con soporte'
        ], Response::HTTP_BAD_REQUEST);
    }

    public function returnValidationErrors($errors)
    {
        return response()->json([
            'status' => 'error',
            'errors' => $errors
        ], Response::HTTP_BAD_REQUEST);
    }
}