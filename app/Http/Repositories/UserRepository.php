<?php

namespace App\Http\Repositories;

use Exception;

class UserRepository
{
    /**
     * @var Neo4jClient
     */
    private $neo4jClient;

    public function __construct(Neo4jClient $neo4jClient)
    {
        $this->neo4jClient = $neo4jClient;
    }

    public function getUserData(string $uuid): array
    {
        try {
            $query = 'MATCH (u:User{uuid:$uuid}) RETURN {
                firstName       : u.firstName,
                lastName        : u.lastName,
                gender          : u.gender,
                birthDate       : u.birthDate,
                phone           : u.phone,
                governmentId    : u.governmentId,
                language        : u.language,
                currency        : u.currency,
                address         : u.address,
                introduction    : u.introduction
            } as data;';

            return $this->neo4jClient->run($query, ['uuid' => $uuid])
                ->firstRecord()
                ->get('data');
        } catch (Exception $e) {
            return [];
        }
    }

    public function saveUserData(string $uuid, array $data): bool
    {
        try {
            // create user node if it does not exist
            if (!$this->doesUserExist($uuid)) {
                return $this->createUserNode($uuid, $data);
            }

            $data['uuid'] = $uuid;

            $query = 'MATCH (u:User{uuid:$uuid}) SET 
                u.firstName     = $firstName,  
                u.lastName      = $lastName,
                u.gender        = $gender,
                u.birthDate     = $birthDate,
                u.phone         = $phone,
                u.governmentId  = $governmentId,
                u.language      = $language,
                u.currency      = $currency,
                u.address       = $address,
                u.introduction  = $introduction,
                u.updated_at = date();';

            $this->neo4jClient->run($query, [
                'uuid' => $uuid,
                'firstName' => $data['firstName'],
                'lastName' => $data['lastName'],
                'gender' => $data['gender'],
                'birthDate' => $data['birthDate'],
                'phone' => $data['phone'],
                'governmentId' => $data['governmentId'],
                'language' => $data['language'],
                'currency' => $data['currency'],
                'address' => $data['firstName'],
                'introduction' => $data['introduction']
            ]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    private function doesUserExist(string $uuid)
    {
        $query = 'MATCH (u:User{uuid:$uuid}) RETURN count(u) as data';

        try {
            return $this->neo4jClient->run($query, ['uuid' => $uuid])
                ->firstRecord()
                ->get('data');
        } catch (Exception $e) {
            return false;
        }
    }

    public function createUserNode(string $uuid, array $data)
    {
        $data['uuid'] = $uuid;
        $query = 'CREATE (u:User) SET u = $data, u.created_at = date(), u.updated_at = date();';

        try {
            $this->neo4jClient->run($query, ['data' => $data]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}
