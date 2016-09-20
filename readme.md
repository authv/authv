# MO Authentication Server

[![StyleCI](https://styleci.io/repos/67142226/shield?branch=master)](https://styleci.io/repos/67142226)
[![Build Status](https://travis-ci.org/vinkasMO/mo-authentication-server.svg?branch=master)](https://travis-ci.org/vinkasMO/mo-authentication-server)
[![Total Downloads](https://poser.pugx.org/vinkas/mo-authentication-server/d/total.svg)](https://packagist.org/packages/vinkas/mo-authentication-server)
[![Latest stable version](https://poser.pugx.org/vinkas/mo-authentication-server/v/stable.svg)](https://packagist.org/packages/vinkas/mo-authentication-server)
[![Latest Unstable Version](https://poser.pugx.org/vinkas/mo-authentication-server/v/unstable.svg)](https://packagist.org/packages/vinkas/mo-authentication-server)

A simple, secure php authentication server using [Laravel](https://github.com/laravel/laravel), [Socialite](https://github.com/laravel/socialite), [Passport](https://github.com/laravel/passport) and [Material Design Lite](https://github.com/google/material-design-lite).

## Features

* Choosing unique username on user account registration.
* Login with either username or email address.
* Email address validation by sending confirmation mail.
* **[Laravel Socialite](https://github.com/laravel/socialite)** - OAuth authentication with Facebook, Twitter, Google, LinkedIn, GitHub and Bitbucket. It handles almost all of the boilerplate social authentication code you are dreading writing. We are not accepting new adapters. Adapters for other platforms are listed at the community driven [Socialite Providers](https://socialiteproviders.github.io) website.

## Screenshots

![Login](https://raw.githubusercontent.com/vinkasMO/mo-docs/master/screenshots/login.png)
---
![Register](https://raw.githubusercontent.com/vinkasMO/mo-docs/master/screenshots/register.png)
---

## Installation

#### Via Composer Create-Project

You may install by issuing the Composer create-project command in your terminal:

`composer create-project vinkas/mo-authentication-server`

## Security Vulnerabilities

If you discover a security vulnerability within this Authentication Server, please send an e-mail to Vinoth Kannan at vinothkannan@vinkas.com. All security vulnerabilities will be promptly addressed.

## License

MO Authentication Server is open-sourced software licensed under the [MIT license](LICENSE.txt).
