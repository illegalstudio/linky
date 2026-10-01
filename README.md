<p align="center">
  <img src="assets/logo-mark-light.svg#gh-light-mode-only" alt="Linky logo" width="130">
  <img src="assets/logo-mark-dark.svg#gh-dark-mode-only" alt="Linky logo" width="130">
</p>

<h1 align="center">Linky</h1>

<p align="center">
  <em>Your links, your rules.</em>
</p>

<p align="center">
  <a href="https://github.com/illegalstudio/linky/actions/workflows/test.yml"><img src="https://img.shields.io/github/actions/workflow/status/illegalstudio/linky/test.yml?branch=main&amp;style=flat-square&amp;label=tests&amp;color=000000&amp;logo=github&amp;logoColor=white" alt="Tests"></a>
  <a href="https://packagist.org/packages/illegal/linky"><img src="https://img.shields.io/packagist/v/illegal/linky?style=flat-square&amp;label=packagist&amp;color=000000&amp;logo=packagist&amp;logoColor=white" alt="Packagist version"></a>
  <a href="https://packagist.org/packages/illegal/linky"><img src="https://img.shields.io/packagist/dt/illegal/linky?style=flat-square&amp;label=downloads&amp;color=000000" alt="Downloads"></a>
  <a href="https://github.com/illegalstudio/linky/stargazers"><img src="https://img.shields.io/github/stars/illegalstudio/linky?style=flat-square&amp;label=stars&amp;color=000000&amp;logo=github&amp;logoColor=white" alt="GitHub stars"></a>
  <a href="LICENSE"><img src="https://img.shields.io/github/license/illegalstudio/linky?style=flat-square&amp;label=license&amp;color=000000" alt="License: MIT"></a>
</p>

<p align="center">
  <strong>Short links &middot; Collections &middot; Custom pages &middot; Request tracking</strong>
</p>

<p align="center">
  Linky is a free, open-source Laravel package for managing links and publishing collections and pages.
  Choose custom URLs, record incoming requests, and manage your content through an admin interface
  with configurable authentication.
</p>

<p align="center">
  <a href="https://opensource.nahi.me"><strong>Website</strong></a>
</p>

<p align="center">
  <em>This project is under active development and is not ready for production use.</em>
</p>

---

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
