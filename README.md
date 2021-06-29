# Linus rants
Get Linus' rants using an API.

# Installation
This app requieres at least PHP7 and optionally APCu for storing in cache the file with the rants.

You also need to config the rewrite, this config may change depending on your web server. Apache users already have .htaccess ready

Once you have that ready, install the dependencies with:
```
composer install
```

# Endpoints
### /
Get all the rants available

### /random
Get a random rant

### /1,2,3,4...
Get a rant by id
