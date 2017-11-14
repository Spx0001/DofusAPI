# DofusAPI
PHP API for Dofus 1.29

# Auhor
Manghao

# Version - 2

# Usage
* Install all depenancies:
```shell
composer install
```
* Configure your database logs
  * Edit **src/conf/db.conf.php**
  
# Features - Edit your lang file
  * Registration by client
    * Edit C.REGISTER_INGAME : 
      ```
      C.REGISTER_INGAME = Boolean(true);
      ```
    * Edit C.REGISTER_POPUP_LINK : 
      ```
      C.REGISTER_POPUP_LINK = String("http://mysite.com/api/%CMNTT%/register");
      ```
    * Edit C.CRYPTO_LINK :
      ```
      C.CRYPTO_LINK = String("http://mysite.com/api/crypto.png");
      ```
    * Edit C.WHERE_HEAR_LINK :
      ```
      C.WHERE_HEAR_LINK = String("http://mysite.com/api/registration_come_from.%CMNTT%");
      ```
  * Gifts
     * Edit C.GIFTS_LINK : 
       ```
       C.GIFTS_LINK = String("http://mysite.com/api/game_actions.l.%CMNTT%");
       ```
  * Servers status
    * Edit : C.ENABLE_SERVER_STATUS :
      ```
      C.ENABLE_SERVER_STATUS = Boolean(true);
      ```
    * Edit C.PROBLEMS_LINK : 
      ```
      C.PROBLEMS_LINK = String("http://mysite.com/api/serverstatus.%CMNTT%.xml");
      ```
  * RSS News
    * Edit C.RSS_LINK : 
      ```
      C.C.RSS_LINK = String("http://mysite.com/api/rss/rss.game.%CMNTT%.xml");
      ```
      
