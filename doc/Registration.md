# DofusAPI - Registration
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

* Database :
  * Edit your account table name in **$table** located at **src/models/Account.php**
  * Edit fields name in **src/controller/UsersController.php**, search **Edit me** to find the code
  * Collecting personal informations :
    * Edit **cpi** in **src/conf/api.conf.php**