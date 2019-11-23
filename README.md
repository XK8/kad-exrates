# CBR rates
## Install
- Clone repository
- Run ```composer install```
- Run ```php artisan migrate --seed```

## Sync CBR
```php artisan rates:sync```

## API access
- **GET** ```/currencies``` — all currency list
- **GET** ```/currencies/{id}``` — currency info by ID (```/currencies/550```)
