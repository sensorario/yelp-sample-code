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
        term: Fox
        lang: it
        category_filter: pubs
        cc: IT
        actionslink: true
    business:
        id: old-fox-pub-milano
    phone_search:
        phone: '0289402622'
        cc: IT
    api_host: api.yelp.com
```

### Run sample code

```bash
php scripts/sample.php
```
