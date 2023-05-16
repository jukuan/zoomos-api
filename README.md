# zoomos-api

This is a small helper-library to work with zoomos.by API-system. Non official.

Steps how to use it:
* Install the package: `$ composer require jukuan/zoomos-api`
* see the `examples` directory
* create your fetcher like `BaseFetcher::create($key)->execute('GET', 'pricelist');`

Profit!

Зрэшты, гэта ліба мае сэнс выключна для Беларусі, дык працягну па-беларуску.
Гэта невялікая бібліятэка для працы з API-сістэмай сэрвіса [zoomos.by](http://zoomos.by). Дазваляе атрымаць дадзеныя аб таварах.
Перадусім выкарыстоўваю гэта ў сваіх праектах і шырокай падтрымкі яна не патрабуе. Таму пісаў пад сучасныя PHP 7.4 і неўзабаве падняў версію да 8.1.

Сам zoomos-сэрвіс дапамагае бінэсу каталагізаваць тавары і абнаўляць прайсы на онлайнеры (гэта, бадай, самая важная «фішка»).
Але для мяне гэта як база дадзеных у воблаку.

Карыстайцеся, калі раптам трэба. Ды не цурайцеся пісаць аўтару пра магчымыя памылкі ды ствараць Pull-Request ці пісаць заўвагі.
