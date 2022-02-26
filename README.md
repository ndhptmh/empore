<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Cara memakai aplikasi
1. Setelah melakukan clone project ini, maka lakukan perintah "Composer install"
2. Setelah itu, copy paste env.example dan ubah nama filenya menjadi .env
3. Lakukan perintah "php artisan key:generate" setelah itu jalankan "php artisan migrate --seed"
4. Jalankan perintah "php artisan serve" Aplikasi siap untuk digunakan.
5. Untuk mengecek API dapat menggunakan Postman.
6. Untuk mengecek API list buku dapat menggunakan method GET dan url : http://localhost:8000/api/book
7. Untuk mengecek API membuat buku baru dapat menggunakan method POST dan url : http://localhost:8000/api/book dengan menambah paramater (code, stock, title,year, writer)  
8. Untuk mengecek API detail buku dapat menggunakan method GET dan url : http://localhost:8000/api/book/{id} atau http://localhost:8000/api/bookByCode/{code}
9. Untuk mengecek API mengedit buku dapat menggunakan method PUT dan url : http://localhost:8000/api/book/{id} dengan menambah paramater (code, stock, title,year, writer) atau http://localhost:8000/api/bookByCode/{code}
10. Untuk mengecek API menghapus buku dapat menggunakan method DELETE dan url : http://localhost:8000/api/book/{id} atau http://localhost:8000/api/bookByCode/{code}
11. Untuk mengecek API list member dapat menggunakan method GET dan url : http://localhost:8000/api/member
12. Untuk mengecek API list peminjaman buku dapat menggunakan method GET dan url : http://localhost:8000/api/bookloan
13. Untuk melihat contoh API Anda bisa melihat file dokumentasi API.docx pada folder public.
14. Jika ingin login role admin gunakan (email: admin@mail.com, password: password)
15. Jika ingin login role anggota gunakan (email: user@mail.com, password: password), anda dapat membuat user baru oleh admin.
16. Aplikasi siap digunakan. 

Note : http://localhost:8000 (disesuaikan dengan localhost dan port device masing-masing.)

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

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[CMS Max](https://www.cmsmax.com/)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
