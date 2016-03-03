# PHP Yelp Wrapper

This is a wrapper for yelp api. It allow some nice requests, like /search/{something}/in/{location} instead of a complex query. Or /phone/+390000000000. It also use twig to render the content. Actually just json content.

## Configuration

Copy app/config.yml.dist in your app/config.yml file and put here your Yelp configurations.

```yaml
yelp:
    api_keys:
        consumer_key: ~
        consumer_secret: ~
        token: ~
        token_secret: ~
    api_host: api.yelp.com
```

### Run wrapper

```bash
php -S localhost:8888 -t scripts/
```

This will opern default route. On top of the page there is a menu with a little preset of query.

## Why this wrapper?

Is just an exercise!
