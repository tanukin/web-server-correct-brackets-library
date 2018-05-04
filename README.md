Web Server для библиотеки Correct Brackets
=====================================

Starting the environment
---
 
~~~
composer install
~~~
~~~
docker-compose up -d
~~~

Connect to nginx
---
~~~
telnet localhost 8080
~~~

Request
---
~~~
POST / HTTP/1.1
Host: anyName
Content-Type: application/x-www-form-urlencoded
Content-Length: 15
~~~
~~~
string=()()(())
~~~

Examples of request headers and server response
===

Example 1
---
~~~
POST / HTTP/1.1
Host: anyName
Content-Type: application/x-www-form-urlencoded
Content-Length: 15
 
string=()()(())
~~~
~~~
HTTP/1.1 200 OK
 
Brackets are set correctly
~~~

Example 2
---
~~~
POST / HTTP/1.1
Host: anyName
Content-Type: application/x-www-form-urlencoded
Content-Length: 15
 
string=()()(()(
~~~
~~~
HTTP/1.1 400 Bad Request
 
Brackets are not set correctly
~~~
Example 3
---
~~~
POST / HTTP/1.1
Host: anyName
Content-Type: application/x-www-form-urlencoded
Content-Length: 15
 
string=()()((d)
~~~
~~~
HTTP/1.1 400 Bad Request
 
The line uses forbidden characters.
~~~
Example 4
---
~~~
POST / HTTP/1.1
Host: anyName
Content-Type: application/x-www-form-urlencoded
Content-Length: 14
 
key=()()(())()
~~~
~~~
HTTP/1.1 400 Bad Request
 
string argument not passed
~~~
Example 5
---
~~~
GET / HTTP/1.1
Host: anyName
Content-Type: application/x-www-form-urlencoded
Content-Length: 15
 
string=()()(())
~~~
~~~
HTTP/1.1 400 Bad Request
 
Only use the POST method
~~~
