# Tests

Aquest es un projecte per realitzar tests petits en symfony 6

## test 1: generar un codi qr a partir d'un string que es passa com a parametre
url: /qr/generacioqr/{valor}

## test 2: realitzar una conversio de moneda amb una api externa
parametres a incloure al env. :
- APIKEY_EXCHANGERATE
- URL_API_EXCHANGERATE -> https://v6.exchangerate-api.com/v6/[APIKEY]/pair/[CURRENCYFROM]/[CURRENCYTO]/[AMOUNT]

url: /currencyconverter/convert/{currencyFrom}/{currencyTo}/{amount}