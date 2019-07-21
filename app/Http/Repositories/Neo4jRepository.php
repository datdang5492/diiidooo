<?php

namespace App\Http\Repositories;

use GraphAware\Neo4j\Client\ClientBuilder;


class Neo4jRepository
{
    /**
     * @return Session
     */
    private $client;

    public function __construct(){
        $this->client = ClientBuilder::create()
            ->addConnection('bolt', 'bolt://neo4j:password@192.168.178.27')
            ->build();
    }

    /**
     * @param string $query
     * @param array $params
     * @return \GraphAware\Common\Result\Result
     */
    public function run(string $query, ?array $params = null)
    {
        return $this->client->run($query, $params);
    }

}
