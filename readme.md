# Låtsasbörsen

## Installation
1. `npm install`
2. `bower install`
3. `gulp`
4. `php artisan migrate`
5. Besök `*.dev/register/` och skapa ett nytt konto

## Konfiguration

- Skapa ny fil: `config/nordnet.php`
- Fyll den enligt nedan:
```
<?php
  return [
      'username' => 'USERNAME',
      'password' => 'PASSWORD'
  ];
```
- Användarnamn och lösenord till nEXT API skapar du här: https://api.test.nordnet.se/account/register

## Databas
![database.png](https://raw.githubusercontent.com/fhqvst/cbs/master/database.png?token=AGsEwykhPbOBr9-8bs5aNkmriCcTVe6Vks5VyScwwA%3D%3D)
