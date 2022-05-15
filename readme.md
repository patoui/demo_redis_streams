# Demo Redis Streams

This is a demo application for the article found here:

https://patriqueouimet.ca/post/messaging-php-and-redis-streams

## Requirements

- [Docker](https://www.docker.com/get-started/)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Running the application

Within your terminal, run the project directory

```
docker-compose up
```

### Running the producer

```
docker exec -it drs__php php producer.php
```

There will be no output if the script is successful

### Running the consumer

```
docker exec -it drs__php php consumer.php
```

You should see something similar to this if the script is successful

```
Account No ABC321, current balance: 900
Account No XYZ987, current balance: 533
```
