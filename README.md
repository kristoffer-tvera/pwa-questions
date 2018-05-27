# pwa-questions

## Endpoints
### /api/questions/read.php
#### GET
Returns a random question in the following json format:
```json
{
    "category": "sports",
    "first_alternative": "Lifting",
    "first_alternative_score": "4",
    "second_alternative": "Running",
    "second_alternative_score": "0"
}
```

### /api/questions/read_by_category.php
#### GET
Takes a category as a query string parameter, example:

/api/questions/read_by_category.php __?category=sport__

Returns a random question within the given category in the following json format:
```json
{
    "category": "sports",
    "first_alternative": "Lifting",
    "first_alternative_score": "4",
    "second_alternative": "Running",
    "second_alternative_score": "0"
}
```

### /api/questions/read_by_id.php
#### GET

Takes a id as a query string parameter, example:

/api/questions/read_by_category.php __?id=1__

Returns the corresponding question in the following json format:
```json
{
    "category": "sports",
    "first_alternative": "Lifting",
    "first_alternative_score": "4",
    "second_alternative": "Running",
    "second_alternative_score": "0"
}
```

###/api/questions/update.php
#### Post
Used to vote on a question, accepts json in the following format in post body:
```json
{
    "id": "<question id>",
    "first": "true/false",
}
```


###/api/questions/create.php
#### Post
Used to create a new question, accepts json in the following format in the post body:
```json
{
    "category": "<question category>",
    "first": "<question first option>",
    "second": "<question second option>",
}
```


###/api/questions/delete.php
#### Delete
Used to delete a question, accepts json in the following format in the post body:
```json
{
    "id": "<question id>",
}
```