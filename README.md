# Engagement Networks API 

**This script provides an Engaging Networks Token to be used when sending petition form data to Engaging Networks.** 

It was built as a simple API to be used by our petition forms that are built and coded outside Engaging Networks. It's just a PHP class without dependencies, frontend code or output. Being so simple it can be used in sites with different frontend settings.

A Javascript call to `https://example.domain.org/gpes-engaging-networks-token/` returns a json response with the Engaging Networks token and information saying if the token is new or cached.

```json
{
    "token": "ewewrffdwrweerwew",
    "source": "cache" 
}
```

Please note that the cache is needed because Engaging Networks will issue a max of 5,000 tokens per hour. This script will ask for a new token if the cached version is older than 5 minutes. This cache also reduces resource consumption both in Greenpeace and Engaging Network servers.

The information in the json about the token source (cache or engaging) is for debugging purposes only.

## Install this script

1. Rename `config.php.dist` to `config.php`
2. Edit `config.php`:
3. Modify the CACHE_FOLDER setting. You'll need a **writable folder**, to store the cache file with the token value. This folder should be outside the server's path, for extra security.
4. Add the API key in the `ENGAGING_NETWORKS_API_KEY`setting.
5. Finally configure the `ALLOW_ORIGIN_HEADER` with the domain name
5. Upload `EngagingNetworksToken.php`, `index.php` and `config.php` to your server

For security reasons the script should work from an https url

### config.php example

```php
<?php
define('CACHE_FOLDER', '/home/tokenuser/token_site/token');
define('ENGAGING_NETWORKS_API_KEY', 'efsdewr234dgfgerwe44334');
define('ALLOW_ORIGIN_HEADER', '*');
?>
```

## To do:

* Create a ALLOW_ORIGIN_HEADER setting that will allow to use the same API endpoint for multiple domains without adding `Access-Control-Allow-Origin: *` as a header.
