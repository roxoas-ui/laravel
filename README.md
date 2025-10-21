<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## Project - NOVO CONTROLE DE LICENCAS (instruções rápidas)

### Rodar localmente

1. Instale dependências PHP:

```powershell
composer install
```

2. Copie o arquivo de ambiente e gere a chave:

```powershell
cp .env.example .env
php artisan key:generate
```

3. Criar banco SQLite (opcional) e rodar migrações:

```powershell
# cria o arquivo de sqlite
New-Item -Path database\testing.sqlite -ItemType File -Force
php artisan migrate --force
php artisan db:seed --force
```

4. Iniciar servidor de desenvolvimento Laravel:

```powershell
php artisan serve --port=8001
```

### Testes

A suíte de testes foi configurada para rodar com SQLite em memória. Execute:

```powershell
vendor\bin\phpunit
```

### Expor localmente (ngrok)

Se quiser expor o backend para testes externos com `ngrok`, faça:

1. Instale ngrok e configure seu authtoken (requer conta):

```powershell
# baixar ngrok manualmente e extrair ngrok.exe
ngrok authtoken <SEU_AUTHTOKEN>
```

2. Inicie o servidor Laravel e crie o túnel:

```powershell
php artisan serve --port=8001
ngrok http 8001
```

O ngrok mostrará a URL pública (https) no terminal.

### Expor localmente (localtunnel)

Se preferir `localtunnel` (não precisa de conta):

```powershell
# no diretório backend
npx --yes localtunnel --port 8001
```

Você receberá uma URL pública do tipo `https://<random>.loca.lt`.

> Nota: o túnel ficará ativo enquanto o comando estiver rodando no terminal.

### Frontend (dev)

O frontend usa Vite + Vue. No diretório `frontend`:

```powershell
cd frontend
npm install
# iniciar dev server
npm run dev
```

Para apontar o frontend para o backend local ou o túnel público, defina a variável `VITE_API_URL` no arquivo `.env` do frontend, por exemplo:

```
VITE_API_URL=http://127.0.0.1:8001
# ou
VITE_API_URL=https://purple-areas-see.loca.lt
```

Em seguida reinicie o dev server do Vite.

### CI

O workflow de CI foi ajustado para usar SQLite e resetar o cache do pacote Spatie antes de rodar os testes. Veja `backend/.github/workflows/tests.yml` e `backend/.github/workflows/ci.yml`.

---

Se quiser, eu atualizo o README com instruções mais detalhadas (deploy, backups, storage, produção).
