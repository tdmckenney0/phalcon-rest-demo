> curl -i -X GET http://localhost/phalcon-rest-demo/api/robots

> curl -i -X GET http://localhost/phalcon-rest-demo/api/robots/search/Astro

> curl -i -X GET http://localhost/phalcon-rest-demo/api/robots/3

> curl -i -X POST -d '{"name":"C-3PO","type":"droid","year":1977}' http://localhost/phalcon-rest-demo/api/robots

> curl -i -X POST -d '{"name":"C-3PO","type":"droid","year":1977}' http://localhost/phalcon-rest-demo/api/robots

> curl -i -X PUT -d '{"name":"ASIMO","type":"humanoid","year":2000}' http://localhost/phalcon-rest-demo/api/robots/4

> curl -i -X DELETE http://localhost/phalcon-rest-demo/api/robots/4
