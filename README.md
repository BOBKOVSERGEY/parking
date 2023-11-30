# alias
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
https://laraveldaily.com/lesson/build-laravel-api-step-by-step/price-calculation
#date format
https://laraveldaily.com/post/laravel-datetime-to-carbon-dates-casts

# sail artisan make:controller Api/V1/VehicleController --resource --api --model=Vehicle
# sail artisan make:observer VehicleObserver --model=Vehicle
# https://github.com/LaravelDaily/Laravel-API-Parking-Demo

# create Observer
sail artisan make:observer ParkingObserver --model=Parking
don't remember register observer in AppServiceProvider and addGlobalScope

