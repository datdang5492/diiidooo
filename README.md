Neo4j configuration
    https://neo4j.com/developer/docker-run-neo4j/
    https://github.com/neo4j/docker-neo4j

Install Neo4j
     
docker run \
    --publish=7474:7474 --publish=7687:7687 \
    --volume=D:/Projects/dido/data:/data \
    neo4j:3.0
	


http://localhost:7474/browser/
