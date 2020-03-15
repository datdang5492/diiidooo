<?php

namespace App\Http\Controllers\Shipment;

use App\Http\Controllers\Controller;
use App\Http\Repositories\TrackingRepository;
use Exception;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    /**
     * @var TrackingRepository
     */
    private $trackingRepo;


    public function __construct(TrackingRepository $trackingRepo)
    {
        $this->trackingRepo = $trackingRepo;
    }

    public function trackShipment(Request $request)
    {
        $this->validate($request, [
            'shipmentId' => 'required|alpha_num|size:8'
        ]);
        return response()->json([], 200);
        try {
            $uuid = $request->input('uuid');
            $data = $this->adRepository->getShipment($uuid);
            $data['reviews'] = [];
            return response()->json($data, 200);

        } catch (Exception $e) {
            dd($e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
//            return response()->json(['message' => 'Something wrong happened!'], 500);
        }
    }
}
