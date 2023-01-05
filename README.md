# Linus rants
Get Linus' rants using an API.

# Installation
This app requieres at least PHP7 and ext-sqlite.

You also need to config the rewrite, this config may change depending on your web server. Apache users already have .htaccess ready

Once you have that ready, install the dependencies with:
```
composer install
```

# Endpoints
### /
Get all the rants available

Optional query: ?sort=hate|timestamp
Sort rants by hate or timestamp

### /random
Get a random rant

### /1,2,3,4...
Get a rant by id

# Credits
Linus' rants collection taken from [here](https://data.world/jboutros/linus-rants)
