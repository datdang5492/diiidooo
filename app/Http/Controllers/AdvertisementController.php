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

    public function getStepOne(Request $request)
    {
        try {
            $userId = Auth::id();
            $adId = $request->input('adId');

            // get step one data with ID
            if (!empty($adId)) {
                $stepOneData = $this->adRepository->getStepOneDataWithId($userId, $adId);
                if (!empty($stepOneData)) {
                    return response()->json([
                        'data' => $stepOneData['data'],
                        'id' => $stepOneData['adId']
                    ], 200);
                }
                return response()->json('Page not found!', 400);
            }

            // get step one data without ID
            $stepOneData = $this->adRepository->getStepOneDataWithoutId($userId);
            if (empty($stepOneData)) {
                return response()->json(['data' => $this->initializeEmptyStepOne()], 200);
            }

            return response()->json([
                'data' => $stepOneData['data'],
                'id' => $stepOneData['adId']
            ], 200);

        } catch (Exception $e) {
            return response()->json(['msg' => 'Something wrong happened!'], 500);
        }
    }

    private function initializeEmptyStepOne(): array
    {
        return [
            'flightFrom' => '',
            'flightTo' => '',
            'flightDate' => '',
            'expectedDeliveryDate' => ''
        ];
    }

    public function getStepX(Request $request)
    {
        try {
            $adId = $request->input('adId');
            $stepNo = $request->input('step');
            $userId = Auth::id();

            if (empty($adId) || !$this->isStepNoValid($stepNo)) {
                return response()->json(['msg' => 'Can not find advertisement!'], 500);
            }

            $adData = $this->adRepository->getAdData($userId, $adId);

            if (empty($adData['adId'])) {
                return response()->json(['msg' => 'Can not find your advertisement!'], 500);
            }

            return response()->json([
                'id' => $adData['adId'],
                'data' => $this->hydrateAdDataByStepNo($adData, $stepNo)
            ], 200);

        } catch (Exception $e) {
            return response()->json(['msg' => 'Something wrong happened!'], 500);
        }
    }

    private function hydrateAdDataByStepNo(array $adData, string $stepNo): array
    {
        if ($stepNo === 'stepone') {
            return $this->hydrateStepOneData($adData);
        }

        if ($stepNo === 'steptwo') {
            return $this->hydrateStepTwoData($adData);
        }

        if ($stepNo === 'stepthree') {
            return $this->hydrateStepThreeData($adData);
        }

        return [];
    }

    private function isStepNoValid(?string $step): bool
    {
        if (empty($step)) {
            return false;
        }

        if (!in_array($step, ['stepone', 'steptwo', 'stepthree'])) {
            return false;
        }
        return true;
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

    public function saveStepOne(Request $request)
    {
        $this->validateStepOneData($request);
        $userId = Auth::id();
        $adId = $request->input('adId');

        try {
            $adData = [
                'flightFrom' => $request->input('flightFrom'),
                'flightTo' => $request->input('flightTo'),
                'flightDate' => $this->convertDateToStandard($request->input('flightDate')),
                'expectedDeliveryDate' => $this->convertDateToStandard($request->input('expectedDeliveryDate'))
            ];

            if (empty($adId)) {
                // check if user has current undone advertisement
                if ($this->adRepository->doesUserHasUndoneAd($userId) === true) {
                    return response()->json(['msg' => 'Something wrong happened!'], 500);
                }

                // generate new ad id to create new ad
                $adData['uuid'] = $this->strHelper->uuid()->toString();
                $this->adRepository->createAd($userId, $adData);
                return response()->json(['msg' => 'success', 'id' => $adData['uuid']], 200);
            }

            $adData['uuid'] = $adId;
            $this->adRepository->saveStepOne($userId, $adData);
            return response()->json(['msg' => 'success', 'id' => $adId], 200);

        } catch (Exception $e) {
            return response()->json(['msg' => 'Something wrong happened!'], 500);
        }
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

    public function saveStepTwo(Request $request)
    {
        $this->validateStepTwoData($request);
        $userId = Auth::id();
        $adId = $request->input('adId');

        try {
            if (empty($adId)) {
                // check if user has current undone advertisement
                return response()->json(['msg' => 'Can not find advertisement!'], 500);
            }

            $adData = [
                'availableWeight' => $request->input('availableWeight'),
                'currency' => $request->input('currency'),
                'price' => $request->input('price'),
                'homePickup' => $request->input('homePickup'),
                'deliverDocument' => $request->input('deliverDocument'),
                'priceDocument' => $request->input('priceDocument')
            ];

            $this->adRepository->saveStepTwo($userId, $adId, $adData);
            return response()->json(['msg' => 'success', 'id' => $adId], 200);

        } catch (Exception $e) {
            return response()->json(['msg' => 'Something wrong happened!'], 500);
        }
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

    public function saveStepThree(Request $request)
    {
        $this->validateStepThreeData($request);
        $userId = Auth::id();
        $adId = $request->input('adId');

        try {
            if (empty($adId)) {
                // check if user has current undone advertisement
                return response()->json(['msg' => 'Can not find advertisement!'], 500);
            }

            $adData = [
                'discount' => $request->input('discount'),
                'shipmentNote' => $request->input('shipmentNote'),
                'allowedItems' => json_encode($request->input('allowedItems'))
            ];

            $this->adRepository->saveStepThree($userId, $adId, $adData);
            return response()->json(['msg' => 'success', 'id' => $adId], 200);

        } catch (Exception $e) {
            return response()->json(['msg' => 'Something wrong happened!'], 500);
        }
    }

    private function validateStepThreeData(Request $request): void
    {
        $this->validate($request, [
            'discount' => 'numeric',
            'shipmentNote' => 'required',
        ]);
    }

    public function publish(Request $request)
    {
        $this->validateStepThreeData($request);
        $userId = Auth::id();
        $adId = $request->input('adId');

        try {
            if (empty($adId)) {
                // check if user has current undone advertisement
                return response()->json(['msg' => 'Can not find advertisement!'], 500);
            }
            $this->adRepository->publish($userId, $adId);

            return response()->json(['msg' => 'success', 'id' => $adId], 200);

        } catch (Exception $e) {
            return response()->json(['msg' => 'Something wrong happened!'], 500);
        }
    }



}
