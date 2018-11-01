# find

To start this is a tool for taking lists of proxy ip addresses, verifying them, and placing the results in a database for future use. 

Second, it is a tool upon which to build a web scraper.

It is largely a work in progress, including this README!

It requires Docker and for now is only tested on Windows.

SSH into a Container

Use docker ps to get the name of the existing container.
Use the command docker exec -it <container name> /bin/bash to get a bash shell in the container.
Generically, use docker exec -it <container name> <command> to execute whatever command you specify in the container.

Stop and remove all docker containers and images

List all containers (only IDs) docker ps -aq.
Stop all running containers. docker stop $(docker ps -aq)
Remove all containers. docker rm $(docker ps -aq)
Remove all images. docker rmi -f $(docker images -q)
