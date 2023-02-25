# Linky 

THIS REPOSITORY IS UNDER ACTIVE DEVELOPMENT AND IS NOT READY FOR PRODUCTION USE.

Linky is a Laravel module to gather and manage all of your links

# Installation

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

#### LINKY_AUTH_LOGIN_ROUTE_NAME
The route path of the login page.

Configure the route path of the login page of your application, if you have
configured LINKY_AUTH_USE_LINKY_AUTH to false.
