world-rest-api
==============

A REST API to query the World is a part of the article i wrote for creating REST API's with intuitive URI's. The PHP code is contained in the v1 folder index.php. The database password needs to be changed on line 21 of DatabaseManager.php. If the deployment is on any other platform other than Openshift, the IP address and Port needs to be changed to reflect the correct environment: OPENSHIFT_MONGODB_DB_HOST, OPENSHIFT_MONGODB_DB_PORT on line 18 and 19 of DatabaseManager.php

The data to be imported into the MongoDb database is available under world-rest-api/database/data/ with a filename database-export-world.js.

A database named "world" needs to be created and the data needs to be imported. It is easier using Rockmongo to import data into the database.

Original blog: https://simithnambiar.wordpress.com/2013/09/24/a-restful-api-for-the-countries-of-the-world/
