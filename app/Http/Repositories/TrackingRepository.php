<?php

namespace App\Http\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;

class TrackingRepository
{

    public function getShipmentProgress(string $shipmentId): array
    {
        try {
            $progress = DB::table('tracking')
                ->where('shipment_id', $shipmentId)
                ->get()
                ->toArray();

            return $progress;
        } catch (Exception $e) {
            return [];
        }
    }
}
