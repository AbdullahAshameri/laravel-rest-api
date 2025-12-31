<?php

namespace App\Traits;

trait GeneralTrait
{
    public function getCurrentLang() 
    {
        return app()->getLocale();
    }

    // The Shape Of Error Return
    public function returnError($errNum, $msg) 
    {
        return response()->json([
            'status' => false,
            'errNum' => $errNum,
            'msg'    => $msg
        ]);
    }

    // Return Success of Project Active Or Unactive
    public function returnSuccessMessage($msg= "", $errNum = "S000")
    {
        return [
            'status'    => true,
            'errName'   => $errNum,
            'msg'       => $msg
        ];
    }

    // Return Data
    public function returnData($key, $value, $msg = "")
    {
        return response()->json([
            'status' => true,
            'errNum' => 'S000',
            'msg'    => $msg,
            'value'  => $value
        ]);
    }
} 
?>