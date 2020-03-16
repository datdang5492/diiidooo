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

        try {
            $shipmentId = $request->input('shipmentId');
            $data = $this->trackingRepo->getShipmentProgress($shipmentId);

            return response()->json($data, 200);

        } catch (Exception $e) {
//            return response()->json(['message' => $e->getMessage()], 500);
            return response()->json(['message' => 'Something wrong happened!'], 500);
        }
    }
}
