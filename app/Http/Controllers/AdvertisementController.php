<?php

namespace App\Http\Controllers;

use App\Http\Repositories\AdvertisementRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdvertisementController extends Controller
{
    /**
     * @var AdvertisementRepository
     */
    private $adRepository;

    /**
     * @var Str
     */
    private $strHelper;

    public function __construct(AdvertisementRepository $adRepository, Str $strHelper)
    {
        $this->middleware('auth');
        $this->adRepository = $adRepository;
        $this->strHelper = $strHelper;
    }

    /**
     * TWO CASES WHEN GET SHIPMENT
     * 1: get shipment with id
     * 2: get shipment without id
     * return unfinished shipment
     * return new initialized shipment
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStepOne()
    {
        try {
            $userId = Auth::id();
            $adData = $this->adRepository->getUnfinishedAdData($userId);

            if (empty($adData)) {
                $adData = $this->generateShipmentData();
                $adId = $this->strHelper->uuid()->toString();
                $this->adRepository->createAd($userId, $adId);
            } else {
                $adId = $adData['adId'];
            }

            $adData = !empty($adData) ? $adData : $this->generateShipmentData();

            return response()->json([
                'id' => $adId,
                'data' => $this->hydrateAdData($adData)
            ], 200);

        } catch (Exception $e) {
            return response()->json(['message' => 'Something wrong happened!'], 500);
        }
    }

    public function getShipment(Request $request)
    {
        try {
            $adId = $request->input('adId');
            $userId = Auth::id();

            // get shipment without id
            if (empty($adId)) {
                return response()->json(['message' => 'Can not find advertisement!'], 500);
            }

            $adData = $this->adRepository->getAdData($userId, $adId);

            if (empty($adData['adId'])) {
                return response()->json(['message' => 'Can not find your advertisement!'], 500);
            }

            return response()->json([
                'id' => $adData['adId'],
                'data' => $this->hydrateAdData($adData)
            ], 200);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
//            return response()->json(['message' => 'Something wrong happened!'], 500);
        }
    }

    public function saveStepOne(Request $request)
    {
        $this->validateStepOneData($request);
        $userId = Auth::id();
        $adId = $request->input('adId');
        if (empty($adId)) {
            return response()->json(['message' => 'Can not find shipment to save!'], 500);
        }

        try {
            $adData = [
                'flightFrom' => $request->input('flightFrom'),
                'flightTo' => $request->input('flightTo'),
                'flightDate' => $this->convertDateToStandard($request->input('flightDate')),
                'expectedDeliveryDate' => $this->convertDateToStandard($request->input('expectedDeliveryDate'))
            ];

            $result = $this->adRepository->saveStepOne($userId, $adId, $adData);

            if ($result === false) {
                return response()->json(['message' => 'Something wrong happened!'], 500);
            }
            return response()->json(['message' => 'success'], 200);

        } catch (Exception $e) {
            return response()->json(['message' => 'Something wrong happened!'], 500);
        }
    }

    public function saveStepTwo(Request $request)
    {
        $this->validateStepTwoData($request);
        $userId = Auth::id();
        $adId = $request->input('adId');
        if (empty($adId)) {
            return response()->json(['message' => 'Can not find shipment to save!'], 500);
        }

        try {
            $adData = [
                'availableWeight' => $request->input('availableWeight'),
                'currency' => $request->input('currency'),
                'price' => $request->input('price'),
                'homePickup' => $request->input('homePickup'),
                'deliverDocument' => $request->input('deliverDocument'),
                'priceDocument' => $request->input('priceDocument')
            ];

            $result = $this->adRepository->saveStepTwo($userId, $adId, $adData);
            if ($result === false) {
                return response()->json(['message' => 'Something wrong happened!'], 500);
            }
            return response()->json(['message' => 'success'], 200);

        } catch (Exception $e) {
            return response()->json(['message' => 'Something wrong happened!'], 500);
        }
    }

    public function saveStepThree(Request $request)
    {
        $this->validateStepThreeData($request);
        $userId = Auth::id();
        $adId = $request->input('adId');
        if (empty($adId)) {
            return response()->json(['message' => 'Can not find shipment to save!'], 500);
        }

        try {
            $adData = [
                'discount' => $request->input('discount'),
                'shipmentNote' => $request->input('shipmentNote'),
                'allowedItems' => json_encode($request->input('allowedItems'))
            ];

            $result = $this->adRepository->saveStepThree($userId, $adId, $adData);

            if ($result === false) {
                return response()->json(['message' => 'Something wrong happened!'], 500);
            }
            return response()->json(['message' => 'success'], 200);

        } catch (Exception $e) {
            return response()->json(['message' => 'Something wrong happened!'], 500);
        }
    }

    public function publish(Request $request)
    {
        $this->validateAll($request);
        $userId = Auth::id();
        $adId = $request->input('adId');
        if (empty($adId)) {
            return response()->json(['message' => 'Can not find shipment to save!'], 500);
        }

        try {
            if ($this->adRepository->isAdPublished($userId, $adId) === true) {
                return response()->json(['message' => 'Advertisement has already been published!'], 500);
            }

            $this->adRepository->publish($userId, $adId);

            return response()->json(['message' => 'success', 'id' => $adId], 200);

        } catch (Exception $e) {
            return response()->json(['message' => 'Something wrong happened!'], 500);
        }
    }


    private function hydrateAdData(array $adData): array
    {
        return [
            'step_1' => $this->hydrateStepOneData($adData),
            'step_2' => $this->hydrateStepTwoData($adData),
            'step_3' => $this->hydrateStepThreeData($adData)
        ];
    }

    private function hydrateStepOneData(array $adData): array
    {
        return [
            'flightFrom' => $adData['flightFrom'],
            'flightTo' => $adData['flightTo'],
            'flightDate' => $adData['flightDate'],
            'expectedDeliveryDate' => $adData['expectedDeliveryDate']
        ];
    }

    private function hydrateStepTwoData(array $adData): array
    {
        return [
            'availableWeight' => $adData['availableWeight'],
            'currency' => $adData['currency'],
            'price' => $adData['price'],
            'homePickup' => $adData['homePickup'],
            'deliverDocument' => $adData['deliverDocument'],
            'priceDocument' => $adData['priceDocument'],
        ];
    }

    private function hydrateStepThreeData(array $adData): array
    {
        return [
            'discount' => $adData['discount'],
            'allowedItems' => json_decode($adData['allowedItems']),
            'shipmentNote' => $adData['shipmentNote']
        ];
    }

    private function convertDateToStandard(string $date)
    {
        $date = str_replace('/', '-', $date);
        return date("Y-m-d", strtotime($date));
    }

    private function validateStepOneData(Request $request): void
    {
        $this->validate($request, [
            'flightFrom' => 'required|alpha|min:2',
            'flightTo' => 'required|alpha|min:2',
            'flightDate' => 'required|date_format:d/m/Y',
            'expectedDeliveryDate' => 'required|date_format:d/m/Y|after_or_equal:flightDate'
        ]);
    }

    private function validateStepTwoData(Request $request): void
    {
        $this->validate($request, [
            'availableWeight' => 'required|numeric|max:200',
            'currency' => 'required|alpha|size:3',
            'price' => 'required|numeric',
            'homePickup' => 'required|alpha|max:3',
            'deliverDocument' => 'required|alpha|max:3',
            'priceDocument' => 'numeric',
        ]);
    }

    private function validateStepThreeData(Request $request): void
    {
        $this->validate($request, [
            'discount' => 'nullable|numeric',
            'shipmentNote' => 'required',
        ]);
    }

    private function validateAll(Request $request): void
    {
        $this->validate($request, [
            'flightFrom' => 'required|alpha|min:2',
            'flightTo' => 'required|alpha|min:2',
            'flightDate' => 'required|date_format:d/m/Y',
            'expectedDeliveryDate' => 'required|date_format:d/m/Y|after_or_equal:flightDate',

            'availableWeight' => 'required|numeric|max:200',
            'currency' => 'required|alpha|size:3',
            'price' => 'required|numeric',
            'homePickup' => 'required|alpha|max:3',
            'deliverDocument' => 'required|alpha|max:3',
            'priceDocument' => 'numeric',

            'discount' => 'numeric',
            'shipmentNote' => 'required',
        ]);
    }

    private function generateShipmentData(): array
    {
        return [
            'flightFrom' => '',
            'flightTo' => '',
            'flightDate' => '',
            'expectedDeliveryDate' => '',

            'availableWeight' => '',
            'currency' => '',
            'price' => '',
            'homePickup' => '',
            'deliverDocument' => '',
            'priceDocument' => '',

            'discount' => '',
            'allowedItems' => '',
            'shipmentNote' => '',
        ];
    }

}
