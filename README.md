# E Commerce Platform For Sola Chemicals
<pre>
                                                            _______________________   
                                                        | Hi, We are Hash Hackers |
                                                          =======================
                                                                               \
                                                                                \
                                                                                  ^__^
                                                                                  (oo)\_______
      #   #                                                                       (__)\       )\/\ 
  ###########                                                                         ||----w |
    #   #                                                                             ||     ||
</pre>
## Creating work environment
* Use personal linux vps for hosting website (Web Server - CaddyServer)
* Create a subdomain under mthlpbs.hackclub.app as sola.mthlpbs.hackclub.app .
  ```
    http://sola.mthlpbs.hackclub.app {
      	bind unix/.sola.mthlpbs.hackclub.app.webserver.sock|777
      	root * /home/mthlpbs/pub/sola-chemicals-ecommerce-platform
      	file_server {
  		hide .git .env
  	}
          @adminPath {
          	path /admin
      	}
      	redir @adminPath /admin/login.php 301
  	handle_errors {
          	@404 {
              		expression {http.error.status_code} == 404
          	}
          rewrite @404 /components/error/404.html
          file_server
      }	
  }

  ```
* Use crontab to sync GitHub repo at midnight, everyday. (To minimize the conflict that happen when coding)
  ```
  30 18 * * * cd /home/mthlpbs/pub/sola-chemicals-ecommerce-platform && gh repo sync --force
  ```
* Use mariadb as SQL server (Provided by alwaysdata.com)
* [Create the folder structure for the web project](https://github.com/asurpbs/sola-chemicals-ecommerce-platform/blob/main/directory-readme.md)
