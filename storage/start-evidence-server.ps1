$env:DB_CONNECTION = 'sqlite'
$env:DB_DATABASE = 'D:\ironforge-machinery\storage\evidence.sqlite'
Set-Location 'D:\ironforge-machinery'
php artisan serve --host=127.0.0.1 --port=8765
