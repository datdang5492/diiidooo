# diiidooo
peer to peer shipping platform

Laravel version 5.7.15

Neo4j configuration
    https://neo4j.com/developer/docker-run-neo4j/
    https://github.com/neo4j/docker-neo4j
    https://neo4j.com/docs/operations-manual/current/docker/configuration/

Install Neo4j

// create and run neo4j image     
docker run \
    --publish=7474:7474 --publish=7687:7687 \
    --volume=D:/Projects/dido/data:/data \
    --volume=D:/Projects/dido/neo4j/logs:/logs \
    --env=NEO4J_dbms_allow_upgrade=true \
    --env=NEO4J_dbms_format_migration=true \
    neo4j:3.5
	
http://localhost:7474/browser/
