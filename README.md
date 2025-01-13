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
* Use personal linux vps for hosting website (Web Server - apache)
* Create a subdomain under mthlpbs.hackclub.app as sola.mthlpbs.hackclub.app .
* Use crontab to sync GitHub repo at midnight, everyday. (To minimize the conflict that happen when coding)
  ```
  30 18 * * * cd /home/mthlpbs/htdocs && gh repo sync --force
  ```
* Use mariadb as SQL server.
* [Create the folder structure for the web project](https://github.com/asurpbs/sola-chemicals-ecommerce-platform/blob/main/directory-readme.md)
