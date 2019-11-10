<?php

namespace App\Http\Repositories;

use Exception;

class AdvertisementRepository
{
    /**
     * @var Neo4jClient
     */
    private $neo4jClient;

    public function __construct(Neo4jClient $neo4jClient)
    {
        $this->neo4jClient = $neo4jClient;
    }

    // check if user has current ad which has not been published yet
    public function doesUserHasUndoneAd(string $userId): bool
    {
        try {
            $query = 'MATCH (u:User{uuid:$userId})-[:POST]-(ad:Advertisement)
            WHERE ad.status = false
            RETURN ad.uuid as data;';

            $adId = $this->neo4jClient->run($query, ['userId' => $userId])
                ->firstRecord()->get('data');

            if (empty($adId)) {
                return false;
            }
            return true;

        } catch (Exception $e) {
            return false;
        }
    }

    public function getStepOneDataWithoutId(string $userId): array
    {
        try {
            $query = 'MATCH (u:User{uuid:$userId})-[:POST]-(ad:Advertisement)
            WHERE ad.status = false
            RETURN {
                flightFrom : ad.flightFrom,
                flightTo : ad.flightTo,
                flightDate : toString(ad.flightDate),
                expectedDeliveryDate : toString(ad.expectedDeliveryDate)
            } as data, ad.uuid as adId;';

            $result = $this->neo4jClient->run($query, ['userId' => $userId]);
            $data = $result->firstRecord()->get('data');
            $adId = $result->firstRecord()->get('adId');

            // if there s no existing ad, return an empty ad array
            if (empty($adId)) {
                return [];
            }

            $data['flightDate'] = $this->convertFrontendDate($data['flightDate']);
            $data['expectedDeliveryDate'] = $this->convertFrontendDate($data['expectedDeliveryDate']);
            return [
                'adId' => $adId,
                'data' => $data
            ];

        } catch (Exception $e) {
            return [];
        }
    }

    public function getStepOneDataWithId(string $userId, string $adId): array
    {
        try {
            $query = 'MATCH (u:User{uuid:$userId})-[:POST]-(ad:Advertisement{uuid:$adId})
            WHERE ad.status = false
            RETURN {
                flightFrom : ad.flightFrom,
                flightTo : ad.flightTo,
                flightDate : toString(ad.flightDate),
                expectedDeliveryDate : toString(ad.expectedDeliveryDate)
            } as data, ad.uuid as adId;';

            $result = $this->neo4jClient->run($query, ['userId' => $userId, 'adId' => $adId]);
            $data = $result->firstRecord()->get('data');
            $adId = $result->firstRecord()->get('adId');

            // if there s no existing ad, return an empty ad array
            if (empty($adId)) {
                return [];
            }

            $data['flightDate'] = $this->convertFrontendDate($data['flightDate']);
            $data['expectedDeliveryDate'] = $this->convertFrontendDate($data['expectedDeliveryDate']);
            return [
                'adId' => $adId,
                'data' => $data
            ];

        } catch (Exception $e) {
            return [];
        }
    }

    private function convertFrontendDate(?string $date)
    {
        return !empty($date) ? date('d/m/Y', strtotime($date)) : '';
    }

    public function createAd(string $userId, array $data): bool
    {
        try {
            $query = 'MATCH (u:User{uuid: $userId})
            CREATE (ad:Advertisement) 
            SET 
                ad.uuid                    = $adId,
                ad.flightFrom              = $flightFrom, 
                ad.flightTo                = $flightTo,
                ad.expectedDeliveryDate    = date($expectedDeliveryDate),
                ad.flightDate              = date($flightDate),
                ad.created_at              = date(), 
                ad.updated_at              = date(),
                ad.status                  = false                
            CREATE (u)-[:POST]->(ad)
            RETURN ad.uuid as adId';

            $adId = $this->neo4jClient->run($query, [
                'userId' => $userId,
                'adId' => $data['uuid'],
                'flightFrom' => $data['flightFrom'],
                'flightTo' => $data['flightTo'],
                'expectedDeliveryDate' => $data['expectedDeliveryDate'],
                'flightDate' => $data['flightDate']
            ])->firstRecord()->get('adId');

            if (!empty($adId)) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

    public function saveStepOne(string $userId, array $data): bool
    {
        try {
            $query = 'MATCH (u:User{uuid: $userId})-[:POST]-(ad:Advertisement{uuid: $adId}) 
            SET 
                ad.flightFrom              = $flightFrom, 
                ad.flightTo                = $flightTo,
                ad.expectedDeliveryDate    = date($expectedDeliveryDate),
                ad.flightDate              = date($flightDate), 
                ad.updated_at              = date()
            RETURN ad.uuid as adId';

            $adId = $this->neo4jClient->run($query, [
                'userId' => $userId,
                'adId' => $data['uuid'],
                'flightFrom' => $data['flightFrom'],
                'flightTo' => $data['flightTo'],
                'expectedDeliveryDate' => $data['expectedDeliveryDate'],
                'flightDate' => $data['flightDate']
            ])->firstRecord()->get('adId');

            if (!empty($adId)) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getAdData(string $userId, string $adId): array
    {
        try {
            $query = 'MATCH (u:User{uuid:$userId})-[:POST]-(ad:Advertisement{uuid:$adId}) RETURN {
                flightFrom : ad.flightFrom,
                flightTo : ad.flightTo,
                flightDate : toString(ad.flightDate),
                expectedDeliveryDate : toString(ad.expectedDeliveryDate),
                
                availableWeight: ad.availableWeight,
                currency: ad.currency,
                price: ad.price,
                homePickup: ad.homePickup,
                deliverDocument: ad.deliverDocument,
                priceDocument: ad.priceDocument,
                 
                discount: ad.discount,
                allowedItems: ad.allowedItems,
                shipmentNote: ad.shipmentNote,
                
                adId : ad.uuid
            } as data;';

            $data = $this->neo4jClient->run($query, [
                'userId' => $userId, 'adId' => $adId
            ])->firstRecord()->get('data');

            $data['flightDate'] = $this->convertFrontendDate($data['flightDate']);
            $data['expectedDeliveryDate'] = $this->convertFrontendDate($data['expectedDeliveryDate']);

            return $data;

        } catch (Exception $e) {
            return [];
        }
    }

    public function saveStepTwo(string $userId, string $adId, array $data): bool
    {
        try {
            $query = 'MATCH (u:User{uuid: $userId})-[:POST]-(ad:Advertisement{uuid: $adId}) 
            SET 
                ad.availableWeight      = $availableWeight, 
                ad.currency             = $currency,
                ad.price                = toFloat($price),
                ad.homePickup           = $homePickup, 
                ad.deliverDocument      = $deliverDocument,
                ad.priceDocument        = $priceDocument
            RETURN ad.uuid as adId;';

            $result = $this->neo4jClient->run($query, [
                'userId' => $userId,
                'adId' => $adId,
                'availableWeight' => $data['availableWeight'],
                'currency' => $data['currency'],
                'price' => $data['price'],
                'homePickup' => $data['homePickup'],
                'deliverDocument' => $data['deliverDocument'],
                'priceDocument' => $data['priceDocument']
            ])->firstRecord()->get('adId');

            if (!empty($result)) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

    public function saveStepThree(string $userId, string $adId, array $data): bool
    {
        try {
            $query = 'MATCH (u:User{uuid: $userId})-[:POST]-(ad:Advertisement{uuid: $adId}) 
            SET ad.discount      = toFloat($discount), 
                ad.shipmentNote  = $shipmentNote,
                ad.allowedItems  = $allowedItems
            RETURN ad.uuid as adId;';

            $result = $this->neo4jClient->run($query, [
                'userId' => $userId,
                'adId' => $adId,
                'discount' => $data['discount'],
                'shipmentNote' => $data['shipmentNote'],
                'allowedItems' => $data['allowedItems']
            ])->firstRecord()->get('adId');

            if (!empty($result)) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Set advertisement status to true
     * @param string $userId
     * @param string $uuid
     * @return bool
     */
    public function publish(string $userId, string $uuid): bool
    {
        try {
            $query = 'MATCH (u:User{uuid: $userId})-[:POST]-(ad:Advertisement{uuid: $adId})
            SET ad.status = true
            RETURN ad.uuid as adId;';

            $adId = $this->neo4jClient->run($query, [
                'userId' => $userId,
                'adId' => $uuid
            ])->firstRecord()->get('adId');

            if (!empty($adId)) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Check if advertisement already been published
     * @param string $userId
     * @param string $uuid
     * @return bool
     */
    public function isAdPublished(string $userId, string $uuid): bool
    {
        try {
            $query = 'MATCH (u:User{uuid: $userId})-[:POST]-(ad:Advertisement{uuid: $adId})
            RETURN ad.status as status;';

            $status = $this->neo4jClient->run($query, [
                'userId' => $userId,
                'adId' => $uuid
            ])->firstRecord()->get('status');
            
            if (!empty($status)) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

}
