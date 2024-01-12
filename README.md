# alias
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
https://laraveldaily.com/lesson/build-laravel-api-step-by-step/generate-api-docs
#date format
https://laraveldaily.com/post/laravel-datetime-to-carbon-dates-casts

# sail artisan make:controller Api/V1/VehicleController --resource --api --model=Vehicle
# sail artisan make:observer VehicleObserver --model=Vehicle
# https://github.com/LaravelDaily/Laravel-API-Parking-Demo

# create Observer
sail artisan make:observer ParkingObserver --model=Parking
don't remember register observer in AppServiceProvider and addGlobalScope

# make feature test
sail artisan make:test AuthenticationTest

# api documentation
sail composer require --dev knuckleswtf/scribe
sail artisan vendor:publish --tag=scribe-config

