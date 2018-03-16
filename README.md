# Engagement Networks API 

**This script provides an Engaging Networks Token to use when sending petition form information to Engaging Networks.** It was built as a simple API to be used by petition forms built outside Engaging Networks.

It returns a json response with the Engaging Networks token and information saying if the token is new or cached.

```json
{
    "token": "ewewrffdwrweerwew",
    "source": "cache" 
}
```

Please note the cache is needed because Engaging Networks will issue a max of 5,000 tokens per hour.

The information about the token source (cache or engaging) is for debugging purposes only.

## Install this script

You'll need a **writable folder**, to act as a cache, and store the token value for a few minutes. This folder should be outside the server's path, for security reasons. Don’t forget to ensure the server can write in that folder.

You’ll need to rename the file `config.php.dist` and add the API key and the folder absolute path.

For security reasons the script needs to work in https.

### config.php example

```php
<?php
define('CACHE_FOLDER', '/home/tokenuser/token_site/token');
define('ENGAGING_NETWORKS_API_KEY', 'efsdewr234dgfgerwe44334');
?>
```



