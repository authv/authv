![Authv](public/images/logo.png)
# Authentication & OAuth 2.0 Authorization Server

[![StyleCI][badge-style-ci]][style-ci]
[![Build Status][badge-build]][build]
[![Latest stable version][badge-stable]][packagist]
[![Latest Unstable Version][badge-unstable]][packagist]
[![Total Downloads][badge-downloads]][packagist]

A simple, secure php authentication and OAuth 2.0 authorization server using [Laravel](https://github.com/laravel/laravel) framework, [Socialite](https://github.com/laravel/socialite), [Passport](https://github.com/laravel/passport) and [Material Design Lite](https://github.com/google/material-design-lite).

## Features

* Choosing unique username on user account registration.
* Login with either username or email address.
* Email address validation by sending confirmation mail.
* [Laravel Socialite](https://github.com/laravel/socialite) - OAuth authentication with Facebook, Twitter, Google, LinkedIn, GitHub and Bitbucket. It handles almost all of the boilerplate social authentication code you are dreading writing. We are not accepting new adapters. Adapters for other platforms are listed at the community driven [Socialite Providers](https://socialiteproviders.github.io) website.
* Invites
* [Discourse](https://github.com/discourse/discourse) SSO login.

## Screenshots

![Login](https://raw.githubusercontent.com/authv/authv.org/master/screenshots/login.png)
---
![Register](https://raw.githubusercontent.com/authv/authv.org/master/screenshots/register.png)
---

## Installation

#### Via Composer Create-Project

You may install by issuing the Composer create-project command in your terminal:

```
composer create-project authv/authv
```

## Security Vulnerabilities

If you discover a security vulnerability within Authv, please send an e-mail to Vinoth Kannan at vinothkannan@vinkas.com. All security vulnerabilities will be promptly addressed.

## License

Licensed under the GNU General Public License Version 3.0; you may not use this work except in compliance with the License. You may obtain a copy of the License in the LICENSE file, or at:

https://www.gnu.org/licenses/gpl-3.0.txt



[style-ci]: https://styleci.io/repos/67142226
[build]: https://travis-ci.org/authv/authv
[packagist]: https://packagist.org/packages/authv/authv

[badge-style-ci]: https://styleci.io/repos/67142226/shield?branch=master
[badge-build]: https://img.shields.io/travis/authv/authv/master.svg?style=flat-square
[badge-stable]: https://poser.pugx.org/authv/authv/v/stable.svg?format=flat-square
[badge-unstable]: https://poser.pugx.org/authv/authv/v/unstable.svg?format=flat-square
[badge-downloads]: https://img.shields.io/packagist/dt/authv/authv.svg?style=flat-square
