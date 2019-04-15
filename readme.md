# About LimeStay

a sample PHP booking application written on Laravel.

LimeStay uses here.com api to find places nearby to user and stores a fake booking in the database.

- You need a browser with Geolocation Capabilities
- This app uses unsplash api to randomly show resorts/hotels photo to make things more interesting.

![](https://hazaveh.net/wp-content/uploads/limestay.png)


# Installation

1. Clone This Repo
2. Install Composer

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```
3. Run composer install to download all the dependencies.
```bash
composer install
```
4. Copy `.env.example` file and save it as `.env`
5. Place your HERE.COM app credentials at `HERE_APPID` and `HERE_APPCODE`.
```bash
HERE_APPID="your appid"
HERE_APPCODE="your app code"
```

6. There is a installer script that can run database migrations & necessary commands to prepare the application. Run the installer command:
```bash
php artisan limestay:install
```
(basically this command will run database migrations, creates a database.sqlite file if not exists and also places a random string for application encryption key if it doesn't exists)

7. run this script on your web server.

## Notes:
This app uses Browser GeoLocation API. you may need to create a self signed ssl certificate on the host you run the app as chrome doesn't allow access to device location when a page is served without SSL.
