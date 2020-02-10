<?php

namespace App\Http\Controllers\Shipment;

use App\Http\Controllers\Controller;
use App\Http\Repositories\AdvertisementRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FilterController extends Controller
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
        $this->adRepository = $adRepository;
        $this->strHelper = $strHelper;
    }

    public function filter(Request $request)
    {
        $this->validateFilterCondition($request);

        try {
            $conditions = [
                'fromCity' => $request->input('fromCity'),
                'toCity' => $request->input('toCity'),
                'date' => !empty($request->input('expected_delivery_date'))
                    ? $this->convertDateToStandard($request->input('expected_delivery_date')) : '',
                'deliverDocument' => $request->input('document'),
                'minPrice' => $request->input('min_price'),
                'maxPrice' => $request->input('max_price')
            ];

            $results = $this->adRepository->filterShipment($conditions);

            $sortOrder = (int)$request->input('sort');
            if ($sortOrder === 0) {
                $this->sortByField($results, 'price');
            } else if ($sortOrder === 1) {
                $this->sortByField($results, 'price', false);
            } else if ($sortOrder === 2) {
                $this->sortByField($results, 'availableWeight');
            } else if ($sortOrder === 3) {
                $this->sortByField($results, 'availableWeight', false);
            }

            return response()->json($results, 200);

        } catch (Exception $e) {
            dd($e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
//            return response()->json(['message' => 'Something wrong happened!'], 500);
        }
    }

    private function sortByField(array &$arrData, string $field, bool $topDown = true): void
    {
        usort($arrData, function ($a, $b) use ($field, $topDown) {
            if ($topDown === true) {
                return $a[$field] <=> $b[$field];
            }

            return $b[$field] <=> $a[$field];
        });
    }

    private function convertDateToStandard(string $date)
    {
        $date = str_replace('/', '-', $date);
        return date("Y-m-d", strtotime($date));
    }

    private function validateFilterCondition(Request $request): void
    {
        $this->validate($request, [
            'fromCity' => 'required|alpha|max:25',
            'toCity' => 'required|alpha|max:25',
            'expected_delivery_date' => 'date_format:d/m/Y',
            'document' => 'boolean',
            'min_price' => 'numeric',
            'max_price' => 'numeric',
            'sort' => 'numeric|max:3',
        ]);
    }
}
