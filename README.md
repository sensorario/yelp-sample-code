# PHP Yelp Sample Code

This repository aims to talk with Yelp API.

## Configurable

Copy app/config.yml.dist in your app/config.yml file and put here your Yelp configurations.

```yaml
yelp:
    api_keys:
        consumer_key: ~
        consumer_secret: ~
        token: ~
        token_secret: ~
    search:
        location: Milano
        limit: 3
    api_host: api.yelp.com
```

### Run sample code

```bash
php scripts/sample.php
```
