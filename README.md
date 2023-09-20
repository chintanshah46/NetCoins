<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Netcoins : Laravel Live-Coding Test

## Project Overview:
Create an API that allows a user to place an order to buy or sell cryptocurrency. A live trade does not need to happen as this would be beyond the scope of the test. We expect you to use Laravel, and set up the database in MySQL. Please implement this using industry best practices.

## Project Overview:
- Any global currency like USD/CAD/GBP e.t.c. is collectively referred to as "fiat".
- You can assume CAD is the only available fiat currency.
- You can assume we only trade BTC, LTC, and ETH.
- You can buy Crypto by spending CAD, or sell Crypto back into CAD. This is known as the "direction".
- A Trade is composed of two sides. You will need to record the amount in CAD and the amount in Crypto as separate TradeDetails records.
- "cost" is the cost of 1 unit of Crypto. For example 1 BTC = $35,428.76 CAD.
- The amount in CAD will need to be calculated from the quantity requested by the user.

![image](https://github.com/chintanshah46/NetCoins/assets/58828374/94db4c7f-14c0-4f89-ae4b-a883a4d8dcce)

## Tasks:
- Create a new Laravel 9x project.
- Create migrations for the database diagram above.
- Implement an API endpoint that creates a Trade, and its Details, and responds to the user with a JSON representation of their completed transaction.
- Implement a third party service to pull the live price from and use this value as the "cost". You may use any provider of your choice, or you can use the free. API provided by CoinGecko: https://www.coingecko.com/en/api/documentation.

## Sample Result:
![image](https://github.com/chintanshah46/NetCoins/assets/58828374/ac01394d-d946-496c-83c5-d2ed898044ba)
