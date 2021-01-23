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

    public function getUnfinishedAdData(string $userId): array
    {
        try {
            $query = 'MATCH (u:User{uuid:$userId})-[:POST]-(ad:Advertisement{status:false}) 
            RETURN {
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

            $data = $this->neo4jClient->run($query, ['userId' => $userId])
                ->firstRecord()->get('data');

            $data['flightDate'] = $this->convertFrontendDate($data['flightDate']);
            $data['expectedDeliveryDate'] = $this->convertFrontendDate($data['expectedDeliveryDate']);

            return $data;

        } catch (Exception $e) {
            return [];
        }
    }

    private function convertFrontendDate(?string $date)
    {
        return !empty($date) ? date('d/m/Y', strtotime($date)) : '';
    }

    public function createAd(string $userId, string $adId): bool
    {
        try {
            $query = 'MATCH (u:User{uuid: $userId})
            CREATE (ad:Advertisement) 
            SET ad.uuid                    = $adId,
                ad.status                  = false                
            CREATE (u)-[:POST]->(ad)
            RETURN ad.uuid as adId';

            $adId = $this->neo4jClient->run($query, [
                'userId' => $userId,
                'adId' => $adId
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

    public function saveStepOne(string $userId, string $adId, array $data): bool
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
                'adId' => $adId,
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

    public function publish(string $userId, string $adId, array $data): bool
    {
        try {

            $query = 'MATCH (u:User{uuid: $userId})-[:POST]-(ad:Advertisement{uuid: $adId}) 
            SET 
                ad.flightFrom              = $flightFrom, 
                ad.flightTo                = $flightTo,
                ad.expectedDeliveryDate    = date($expectedDeliveryDate),
                ad.flightDate              = date($flightDate), 
                ad.updated_at              = date(),
                
                ad.availableWeight         = $availableWeight, 
                ad.currency                = $currency,
                ad.price                   = toFloat($price),
                ad.homePickup              = $homePickup, 
                ad.deliverDocument         = $deliverDocument,
                ad.priceDocument           = $priceDocument,
                 
                ad.discount                = toFloat($discount), 
                ad.shipmentNote            = $shipmentNote,
                ad.allowedItems            = $allowedItems
            RETURN ad.uuid as adId;';

            $adId = $this->neo4jClient->run($query, [
                'userId' => $userId,
                'adId' => $adId,

                'flightFrom' => $data['flightFrom'],
                'flightTo' => $data['flightTo'],
                'expectedDeliveryDate' => $data['expectedDeliveryDate'],
                'flightDate' => $data['flightDate'],

                'availableWeight' => $data['availableWeight'],
                'currency' => $data['currency'],
                'price' => $data['price'],
                'homePickup' => $data['homePickup'],
                'deliverDocument' => $data['deliverDocument'],
                'priceDocument' => $data['priceDocument'],

                'discount' => $data['discount'],
                'shipmentNote' => $data['shipmentNote'],
                'allowedItems' => $data['allowedItems']
            ])->firstRecord()->get('adId');

            if (!empty($adId)) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

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

    public function filterShipment(array $params): array
    {
        $result = [];
        $conditionStatement = '';

        $query = 'MATCH (city:City{code:$fromCity})-[:FROM]-(ad:Advertisement)
            -[:TO]-(city2:City{code:$toCity}) 
            MATCH (u:User)-[:POST]->(ad)
            WHERE ad.status = TRUE';

        $returnStatement = ' RETURN {
//                flightFrom : ad.flightFrom,
//                flightTo : ad.flightTo,
                flightDate : toString(ad.flightDate),
                expectedDeliveryDate : toString(ad.expectedDeliveryDate),
                
                availableWeight: toFloat(ad.availableWeight),
                currency: ad.currency,
                price: ad.price,
//                homePickup: ad.homePickup,
//                deliverDocument: ad.deliverDocument,
//                priceDocument: ad.priceDocument,
                 
//                discount: ad.discount,
//                allowedItems: ad.allowedItems,
//                shipmentNote: ad.shipmentNote,
                
                adId : ad.uuid,
                last_name: u.lastName,
                first_name: u.firstName,
                is_verified: u.is_verified,
                rating: u.rating,
                reviews: COUNT(u.reviews),
                profile_pic: u.profile_pic
            } as data';


        if (!empty($params['minPrice'])) {
            $conditionStatement .= ' AND toFloat($minPrice) <= ad.price ';
        }

        if (!empty($params['maxPrice'])) {
            $conditionStatement .= ' AND ad.price <= toFloat($maxPrice) ';
        }

        if (!empty($params['deliverDocument']) && $params['deliverDocument'] === true) {
            $conditionStatement .= ' AND ad.deliverDocument = true ';
        }

        if (!empty($params['date'])) {
            $conditionStatement .= ' AND ad.expectedDeliveryDate >= date($date) ';
        }

        $query .= $conditionStatement . $returnStatement;
        $records = $this->neo4jClient->run($query, $params)->records();

        foreach ($records as $key => $record) {
            $result[] = $record->get('data');
            $result[$key]['flightDate'] = $this->convertFrontendDate($result[$key]['flightDate']);
            $result[$key]['expectedDeliveryDate'] = $this->convertFrontendDate($result[$key]['flightDate']);
        }

        return $result;
    }

    /**
     * @desc get all detail of shipment to display in shipment detail page
     * @param string $uuid
     * @return array
     */
    public function getShipment(string $uuid): array
    {
        try {
            $query = 'MATCH (ad:Advertisement{uuid:$uuid}) 
            MATCH (ad)-[:FROM]-(from:City)
            MATCH (ad)-[:TO]-(to:City) 
            MATCH (u:User)-[:POST]->(ad)
            WHERE ad.status = TRUE
            RETURN {
                    adId : ad.uuid,
                    flightFrom : from.name,
                    flightTo : to.name,
                    flightDate : toString(ad.flightDate),
                    expectedDeliveryDate : toString(ad.expectedDeliveryDate),
                    availableWeight: toFloat(ad.availableWeight),
                    currency: ad.currency,
                    price: ad.price,
                    homePickup: ad.homePickup,
                    deliverDocument: ad.deliverDocument,
                    priceDocument: ad.priceDocument,
                    discount: ad.discount,
                    allowedItems: ad.allowedItems,
                    shipmentNote: ad.shipmentNote
                } as shipment, {
                    lastName: u.lastName,
                    firstName: u.firstName,
                    idVerified: u.id_verified,
                    rating: u.rating,
                    reviews: COUNT(u.reviews),
                    profilePic: u.profile_pic,
                    fbVerified: u.facebookVerified,
                    idVerified: u.idVerified
                } as user';

            $data = $this->neo4jClient->run($query, ['uuid' => $uuid])
                ->firstRecord();

            return [
                'shipment' => $data->get('shipment'),
                'user' => $data->get('user')
            ];
        } catch (Exception $e) {
            return [];
        }
    }

}
