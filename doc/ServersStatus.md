# DofusAPI - Server Status
* Edit : C.ENABLE_SERVER_STATUS :
  ```
  C.ENABLE_SERVER_STATUS = Boolean(true);
  ```
* Edit C.PROBLEMS_LINK : 
  ```
  C.PROBLEMS_LINK = String("http://mysite.com/api/serverstatus.%CMNTT%.xml");
  ```

* Database :
	* Tables names : **serverstatus** and **serverstatus_problems**
	* Fields (serverstatus) :
		* state : Status
			* 1 : Processing
			* 2 : Resolved
			* 3 : Resolved at next update
		* type : Type of status
			* 1 : Scheduled maintenance
			* 2 : High latency
			* 3 : Waiting line
			* 4 : Server crash
			* 5 : Hosting break
		* visible : Display status above rss news or not :
			* 0 : rss news are displayed above status
			* 1 : status are displayed above rss news
		* cnx : Dysplay if login server is concerned :
			* 0 : No concerned
			* 1 : Is concerned
		* servers : Display server name concerned :
			* all : All servers are concerned
			* specific servers : Separate server name by **,** (ex: Jiva, Silvosse, Hecate)
		* cmntt : Communauty (fr, en, es ...) 
	* Fields (serverstatus_problems) :
		* id_status : Id of row in serverstatus table
		* event : Event (schedule) of status 
			* 1 : Problem solved
			* 2 : Restarting the servers
		* comment : Comment for event
		* translated : Doesn't woked in client
			* 0 : Disabled translation of comment
			* 1 : Enabled translation of comment
		* created_at : Creation date (autoupdate in creation)
		* updated_at : Updated date use to display event date (autoupdate)