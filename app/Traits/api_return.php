<?php

namespace App\Traits;

trait api_return
{

    public function getCurrentLang()
    {
        return app()->getLocale();
    }

    public function returnError($errNum, $msg)
    {
        return response()->json([
            'status' => false,
            'errNum' => $errNum,
            'msg' => $msg
        ]);
    }


    public function returnSuccessMessage($msg = "")
    {
        return [
            'status' => true,
            'errNum' => "200",
            'msg' => $msg
        ];
    }

    public function returnData($value, $msg = "")
    {
        return response()->json([
            'status' => true,
            'errNum' => "200",
            'msg' => $msg,
            'data' => $value
        ]);
    }

    public function returnPaginationData($value,$paginator, $msg = "")
    {
        return response()->json([
            'status' => true,
            'errNum' => "200",
            'msg' => $msg,
            'data' => $value,
            'pagination' => [
                'links' =>[
                    'first' => $paginator->url(1),
                    'last' => $paginator->url($paginator->lastPage()),
                    'prev' => $paginator->previousPageUrl(),
                    'next' => $paginator->nextPageUrl()
                ],
                'meta' => [
                    'current_page' => $paginator->currentPage(),
                    'from' => $paginator->firstItem(),
                    'to' => $paginator->lastItem(),
                    'last_page' => $paginator->lastPage(),
                    'total_items_in_current_page' => $paginator->count(),
                    'items_per_page' => $paginator->perPage(),
                    'total_pages' => $paginator->lastPage(),
                    'total_items' => $paginator->total()
                ]
            ]
        ]);
    }
    public function twopoints_on_earth($latitudeFrom, $longitudeFrom, $latitudeTo,  $longitudeTo)
    {
        $long1 = deg2rad($longitudeFrom);
        $long2 = deg2rad($longitudeTo);
        $lat1 = deg2rad($latitudeFrom);
        $lat2 = deg2rad($latitudeTo);
            
        //Haversine Formula
        $dlong = $long2 - $long1;
        $dlati = $lat2 - $lat1;
            
        $val = pow(sin($dlati/2),2)+cos($lat1)*cos($lat2)*pow(sin($dlong/2),2);
            
        $res = 2 * asin(sqrt($val));
            
        $radius = 3958.756;
        
        //transform to meter
        $transform = (1.609344 * 1000);
        return ($res*$radius) * $transform;
    }

}
