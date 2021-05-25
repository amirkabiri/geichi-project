# DateTime attributes
Any attribute which ends with "_at" is a timestamp.
    for example : start_at, updated_at and ...
Every model has these two timestamp attributes:
    created_at, updated_at


# Foreign key attributes
Any attribute which ends with "_id" is a foreign key.
    for example : user_id, service_id and ...

There is a relation for each foreign key.
for example if there is a "user_id" attribute, the relation name of this foreign key is "user"
or the relation name of "service_id" is "service".


# Api output structure
Every endpoint returns a json object which has a key called "data" and the primary data are placed in this key.
value of "data" key could be array or object or other data types.
example:
{
    "data" : [ ...primary data... ],
    "meta_key" : "meta key value",
    "second_meta_key" : "meta key value"
}


# Request headers
You must set these two headers in any request:
    Accept: application/json
    Content-Type: application/json


# Authorization header
For sending token to endpoints, you must set below header:
    Authorization: Bearer TOKEN_GOES_HERE


# Base URL
Base URL of api is [DOMAIN]/api/v1/


# Index of any resource returns a paginated output.
for example plans is a resource.
this resource is accessible by [DOMAIN]/api/v1/plans.
index of any resource is get request to resource url.
if you send a GET request to [DOMAIN]/api/v1/plans, you will receive some output like this:
{
    "current_page": 1,
    "data": [ ... LIST_OF_PLANS ... ],
    "first_page_url": "...",
    "from": ...,
    "last_page": ...,
    "last_page_url": "...",
    "links": [ ... ],
    "next_page_url": "...",
    "path": "http:\/\/localhost:8000\/api\/v1\/plans",
    "per_page": 15,
    "prev_page_url": null,
    "to": 15,
    "total": 344
}
As you know, there is a primary key called "data" which hold list of plans and there are some of other meta data.
so this endpoint has paginated output.


# Paginated output parameters
you can send these parameter to any paginated output for control the output:
per_page = number [default=15]
order_by = attribute_name
order_type = ASC or DESC
with = list of relation names separated by comma.
    example:  with=user,service
Notice: with is something like aggregation in mongo. you pass the name of realtion and will load realtion data too.


# Another authorization header just for development
you can set this header for login just in development for ease of use:
    Auth-Guard: barber
with this header you will authorize as barber.
for authorization as a user you can set this header:
    Auth-Guard: user

Notice: this header does not guarantee to authorize as a same user or barber every time.


# Status codes
200 -> job done successfully, body contains data
201 -> some resource created successfully, body contains created resource
401 -> unauthenticated, empty body.
403 -> authenticated use don't have permission for this action, empty body.
422 -> validation error, body contains validation errors info
500 -> server has fucked up, I am logging errors and I will fix it. don't worry.

# Validation errors
if you got 422 status code when creating or updating something, that means you have sent invalid data.
the output will look like this:
{
    "message": "The given data was invalid.",
    "errors": {
        "plan_id": [
            "The plan id field is required."
        ],
        "lat": [
            "The lat field is required."
        ],
        "lng": [
            "The lng field is required."
        ]
    }
}
you can set a middleware for your request handler and check whenever you got 422 error, show "errors" key as toast messages. 
