﻿# CoWFC
Front- and back-end website for the DWC network server emulator

# Prerequisites
- mh9924/dwc\_network\_server\_emulator
- Webserver (nginx or httpd)
- PHP ≥ 7.0 - PHP 7.1 recommended
  - php7.1-mysql
  - sqlite php-sqlite3
- MySQL
- HTML5 templates
  - Landed
  - SBAdmin
# How to Build
First, you will need to be running on Ubuntu. Otherwise the [setup script](https://github.com/kyle95wm/cowfc_installer) will not run. Please run the following comments below to get started:

`mkdir /var/www && cd /var/www && wget https://raw.githubusercontent.com/kyle95wm/cowfc_installer/master/cowfc.sh && chmod +x cowfc.sh && ./cowfc.sh`Help - Once you've ran cowfc.sh, go through a couple of things then press enter when asked to. Your machine should now restart. Once your machine has open the terminal. Run, `sudo bash` and then run, `cd /var/www` and then run ./cowfc.sh. Then, run through the script. Note - You should run `sudo chmod 777 /var/www/dwc_network_server_emulator -R` if you are rebooting your machine. This isn't needed, but you should run it. `Features: Stats page shows who is online by game/country
, admin panel to manage bans, whitelists, and more`

# Screenshots

## Login Page
![image](https://user-images.githubusercontent.com/10158714/30234202-09416e82-94c9-11e7-94ac-8aa6e8bf550d.png)
## Main Dashboard
![image](https://user-images.githubusercontent.com/10158714/30234212-212eadf2-94c9-11e7-8b01-24c10f67ce7a.png)
## User List - contains all the info an admin would need to identify a player
![image](https://user-images.githubusercontent.com/10158714/30234228-3f4ed5b4-94c9-11e7-814c-26d892d29707.png)

## More screenshots coming soon as we get further with development.

# TODO
- Public ban history
  - Maybe show player name, ban time, unban time, reason for ban and length of ban on page
- Install script for CoWFC to automate new deployments - to some extent - we are already working on this and testing build steps
- Integrate console banning for users with Admin GUI
  - Maybe use the Consoles page to allow banning/unbanning of consoles?
  - Two types of console bans
    - Wii
      - MAC Address
      - Wii Friend Code (found on the Wii Message Board)
      - Serial Number
    - DS
      - MAC Address
      - Maybe BSSID too? - will make it trickier since a BSSID can't easily be changed afaik
- Integrate moderator rank system
- Integrate moderator account management portal
  - Only accessible by highest ranked moderators
  - Modification of users of the same rank must be done through shell
- More ideas I'm sure we haven't thought of yet :p
