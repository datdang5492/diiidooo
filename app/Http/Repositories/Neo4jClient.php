<?php

namespace App\Http\Repositories;

use GraphAware\Neo4j\Client\ClientBuilder;
use Illuminate\Contracts\Session\Session;


class Neo4jClient
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
