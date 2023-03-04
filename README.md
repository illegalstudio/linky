<img width="151" alt="Linky-w@2x" src="https://user-images.githubusercontent.com/1971953/222575552-97a0a0ac-82f6-40f6-b50e-2ebf8077bbf1.png">

![TEST](https://github.com/Illegal-Studio/Linky/actions/workflows/test.yml/badge.svg)


_THIS REPOSITORY IS UNDER ACTIVE DEVELOPMENT AND IS NOT READY FOR PRODUCTION USE._

--------

**Linky** is an open-source Laravel package that started as a free alternative to Linktree,
but quickly evolved into a powerful web enthusiast's Swiss Army knife. With Linky, you
can intercept traffic to a Laravel application, analyze it, act as a honeypot, and 
create custom workflows and action pipelines based on incoming HTTP requests.

Linky's traffic interception and analysis capabilities make it an invaluable tool for 
developers, security researchers, and web enthusiasts who want to gain insights into 
their application's behavior and protect it from malicious actors. Its honeypot 
functionality allows you to attract and trap attackers, while its workflow and pipeline 
features enable you to automate complex tasks and responses based on incoming requests. 
Additionally, Linky can also be used in offensive cyber security activities to simulate 
attacks and test the security of web applications.

Whether you're a seasoned Laravel developer, a security researcher, or a cyber security 
professional looking to enhance your offensive capabilities, Linky is the perfect 
solution for you. Best of all, it's free and open-source, so you can contribute to 
its development and customize it to suit your needs.

# Installation

### Install Composer Package
```shell
composer require illegal/linky
```

### Assets Publish
```shell
php artisan vendor:publish --tag=linky-assets
```

# Usage

## Authentication

### Environment variables

#### LINKY_AUTH_USE_LINKY_AUTH
True or false. If true, the authentication will be handled by the linky project.
If false, the authentication will be handled by the linky package.

Configure to false if yu want to use the linky package in another project that
has its own authentication.

#### LINKY_AUTH_REQUIRE_VALID_USER
True or false. If true, a valid user is required to access the application.  
If false, the application will be accessible without authentication.

#### LINKY_AUTH_MULTI_TENANT
True or false. If true, the application will be multi-tenant.
Each user will only be able to access his own contents.


#### LINKY_AUTH_LOGIN_ROUTE_NAME
The route path of the login page.

Configure the route path of the login page of your application, if you have
configured LINKY_AUTH_USE_LINKY_AUTH to false.
