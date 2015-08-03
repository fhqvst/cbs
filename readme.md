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
Den gråmarkerade tabellen (orders) kommer troligtvis bara existera mha. Redis eftersom den bara kommer innehålla värden då:

1. en användare behöver se orderdjupet för ett instrument.
2. en användare har lagt en order på ett instrument.

Detta beror helt enkelt på att man för att få tag på ordrar måste ansluta till en stream och prenumerera per instrument, vilket kan bli enormt krävande om man prenumererar på ett stort antal instrument samtidigt. Därför visas och behandlas bara orderdata när det behövs. För annan typ av prisdata används istället quotes-tabellen, som regelbundet uppdateras med OHLC-värden. 

![database.png](https://raw.githubusercontent.com/fhqvst/cbs/master/database.png?token=AGsEwykhPbOBr9-8bs5aNkmriCcTVe6Vks5VyScwwA%3D%3D)
