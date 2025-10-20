Quickstart (resumo)

1) Instalar Composer
2) composer create-project laravel/laravel backend "10.*"
3) Copiar arquivos do diretório `laravel-scaffold` para o backend
4) composer require spatie/laravel-permission barryvdh/laravel-dompdf phpoffice/phpspreadsheet
5) php artisan migrate && php artisan db:seed
6) php artisan serve

Observações
- Configure `.env` com DB e AWS
- Configure `QUEUE_CONNECTION=database` e rode `php artisan queue:work` para filas
- Configure 2FA e spatie conforme documentação
