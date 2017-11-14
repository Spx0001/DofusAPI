# DofusAPI - News RSS
* Edit C.RSS_LINK : 
	```
	C.C.RSS_LINK = String("http://mysite.com/api/rss/rss.game.%CMNTT%.xml");
	```

* Database :
	* Table name : **rss**
	* Fields :
		* title : News tite
		* link : Url to see details in your website
		* icon : Icon display in client
		* cmntt : Communauty (fr, en, es ...)
		* created_at : Creation date (autoupdate)
		* updated_at : Updated date (autoupdate)
