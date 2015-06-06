# pRadius
A Simple FreeRADIUS Web GUI

# Installation

### Requirements

* PHP >= 5.4
* Mcrypt PHP Extension
* OpenSSL PHP Extension
* Mbstring PHP Extension

#### Installing/Configuring

install [composer](http://getcomposer.org)
```
curl -s http://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
```
clone source
```
git clone https://github.com/pgroot/pRadius.git
cd pRadius
composer install
//php artisan key:generate
cp ./document/env.example ./.env
vi .env
```
database(MySQL)
```
mysql -u username -p password radius < /path/to/pRadius/database/p_member_apply.sql
mysql -u username -p password radius < /path/to/pRadius/database/p_operators.sql
```

# Screenshots
![oneline users](https://raw.githubusercontent.com/pgroot/pRadius/master/Screenshots/online.png)
![user top](https://raw.githubusercontent.com/pgroot/pRadius/master/Screenshots/usertop.png)
![graph](https://raw.githubusercontent.com/pgroot/pRadius/master/Screenshots/graph.png)

# FreeRADIUS Config Example
* [authorize](https://github.com/pgroot/pRadius/tree/master/document/authorize.md)
* [counter.sql](https://github.com/pgroot/pRadius/tree/master/document/counter.sql.md)
* [dictionary](https://github.com/pgroot/pRadius/tree/master/document/dictionary.md)
* [database](https://github.com/pgroot/pRadius/tree/master/document/database.md)