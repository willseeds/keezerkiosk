# keezerkiosk 1.0 (8.6.20)
 The initial release

**********************************************
**************   KEEZER KIOSK   **************
**********************************************

// Keezer Kiosk project goal (1.0)
// - to create a touch-screen intranet accessible
// - LAMP website that allows for keezer management
// - to add/revise/delete beers and open/close taps
// - with the ability to report temp from a sensor

// opening
the Keezer Kiosk project was initially thought of after seeing the magic mirror project from Michael Teeuw, kinda before everyone was doing it and there was an easy img file. I liked the thought of feedback on the mirror using a webpage started in kiosk mode. i later discovered that i could use that same tech on another project i had been recently pondering.

i have been a home-brewer since 2015 and a electronics tinkerer since about the same time. after about two years of homebrewing i wanted a keezer, which is a chest-freezer that has the door taken off, a wood rim added, then the door reattached. It is a really simple idea that allows multiple taps to be served, depending only on the size of the freezer. With a simple temp controller for about $20, it will not freeze the beer and i know my worth ($20 to not let it keep the release hostage). there are dozens of how-tos on various search engines for building one. 

that leaves me with how to show people what is on tap. I saw many ways to use chalkboards, magnets and other ways to show what's on tap. for the last couple years I have used a small magnetic white board for the 3-tap system in my fridge. i didn't want to designate too many bells and whistles for this project, as it would never get done. in giving back to the two communities that i spent a lot of time learning from (and teaching others), i felt that it should be enough to allow immediate use, but still be a good platform for teaching php/mysql and coding basics. 

if you are a expert electronics tinkerer, learn to brew. if you brew, learn more about the raspberry pi you own and maybe break it a few times. seek out those of like-mindness such as electronic clubs or your local home-brewers club. i joined my local Greater Everett Brewers League (GEBL) and my tastes for beer have become very sharpened, and building this project helped me learn more about my next love, internet applications that i need in my life. ~cheers friends. 


// minimum requirements
(you)
a little HTML knowledge, not expertise
a little computing knowledge, again not a power user

(hardware)
external/internal home network
another computer to load initial software and share files
raspberry PI version 3 rev B (wifi) w/ a simple case & power
specific USB mouse and keyboard
32GB SD card 
old tv w/ HDMI connection for pi video

(wrap up)
touch monitor, HDMI connection or web-accessible monitor
waterproof DS18B20 Temperature sensor (w/ 6' cable length or more) 
1/2 sized breadboard w/ about 1' of wire
of course, a keezer

*requirements note: spend the time learning before you invest in the wrap up parts. You may be able to spread the investment out as you learn. this was designed to be plug and play for someone with some simple computing skills.

(it can also)
- run on any internal internet device, as long as it can show a webpage (smart tv, ipads/iphones, etc). It just has to be able to resolve the DNS query from that device to your router (which you should do for security anyway, not outside your network) and call it in a web browser using http://the-raspi-name/keezer/

- with that being said, be sure to check out the skinny version with a minimal header/footer; indextv.php. this is good for when you want people to see with their eyes and not their hands (mine is a touch-screen for the full effect). 

- split between two screens for even more taps! Just have a second webpage link; copy the index.php to index2.php. copy the globals.php file to globals2.php and edit the globals.php to call the 1st keezer total quantity of taps (vs. all quantity), while on globals2.php put the full quantity of taps in total so it will skip based on the index2.php $i variable. edit the "$i" variable on the index2.php page to be the number of the first tap on the second keezer (dare i say 'etc..'). Put screen over second keezer that is web-accessible and link to index2.php (does not have to be another full pi unless you want additional sensors or have enough CAT5 cable). 
 

// get up and going
start with a simple Linux/Apache/MySQL/PHP (LAMP) server setup (link 1-5 below). make sure you can add/delete/revise information in the selected database within the phpMySQLadmin website and PHP files work on your website root and import the keeer sql (_keezer_db_import.txt). the pi will be ok without a mouse/keyboard and you might think about getting samba up and running to update from another computer if you have no real desire to understand *nix. i spent a lot of time finding simple websites that i used over time that will help in being useful, but you will have to read, pluck along on the keyboard and have some decent copy/paste skills. 

finalizing would be getting the 1-wire set up (link 6) and then work carefully to test pins (shutdown, unplug, tinker, plug in, boot, test... remember). You can change the temp reporting by setting $temp to "temp_f" or "temp_c" for applicable measurement at the bottom of the globals.php file. everything will run without the sensor plugged in, but you might want to remove (or edit out) the degree symbol. using the 1-wire and DS18B20 Temperature sensor, it will allow multiple sensors to be addressed but only one was programmed for feedback for the purposes of this project. 


// set up
Step 1
- gather the initial hardware: 
   USB mouse, keyboard and hdmi connection to an old tv
   this is what it was tested to run on with a fresh install on Raspian (now called Raspberry OS), wifi with no issues.

- hardware list links:
   Raspberry PI (Rev 3 Vers.B, with wifi) & a 32gb SD card
   - use the wifi raspberry to minimize wires
   - go with Amazon for a good deal and fast shipping for both. Make sure its the right PI though.
   - if you are already on Adafruit: https://www.adafruit.com/product/3055

   if you order from Adafruit, you can get the half-sized breadboard for making sensor connections here:
   - https://www.adafruit.com/product/1609

   and a wiring bundle package (there are cheaper, you will only need about 1')
   - https://www.adafruit.com/product/153

   DS18B20 - Waterproof sensor (with 6' extension for reaching inside your keezer)
   - if more distance is needed, try splicing in CAT5 cable between the PI and sensor.
   - https://www.adafruit.com/product/381?gclid=EAIaIQobChMIzMrHxtbc6gIVlh6tBh3R0gpOEAAYASAAEgK8l_D_BwE

Step 2
- helpful software 
   Install raspberry pi imager for windows from the raspberry pi downloads page.
   SD card formatter is a good tool to format the card if the imager hangs. Run new cards through this just in case.
   If you are using Windows to follow along, the app "Rocketcake" is a pretty good free editor.
   
- put raspian on a 32gb card (basic desktop install)
   https://www.raspberrypi.org/documentation/installation/installing-images/
   keep the user pi and boot to desktop using that login

- once you have all the connections to the PI, the power connection is last. verify connections and power first.
   if you have hardware issues and aren't knowedgeable on RaspPi or *nix systems, try different hardware. 

Step 3
- once it boots to the screen you will be promoted to update and pick a time zone. 
- change the computer name (requires reboot) before joining your wifi network (so it doesn’t cause issues resolving at the router).
- last item before going online, reset root and pi user passwords
   there should be an icon for the command prompt in the taskbar, click and type; "sudo passwd root" to change the rarely used admin user password.
   Then do the same for the user pi: "sudo password pi" for your your user account on the pi. 
   between this account and the one for the admin side of the database (which should be different), you shouldn't need more. 
- in the taskbar, use the wifi network scanner to locate and join your network.

- on the command line, run ‘sudo apt-get update’ (answering yes to the size questions unless you didn't get that 32gb like I said).

- install packages 
   Now that you have the “L” part done let’s do the AMP(Apache, MariaDB/MySQL and PHP) part. The rest of the packages will install the server stuff along with nano (instead of leafpad) and phpmyadmin (for database editing and setup).

Then install apache2 (webserver);
‘sudo apt-get install apache2’

the MySQL server is installed with;
‘sudo apt-get install mariadb-server’
then run 'sudo mysql_secure_installation' to set password, remove root login remotely and remove test dbs
The sql server admin password is selected at install. The admin user ‘root’ password should NOT be the the same as any user on your system, since the password will be physically on the server (another reason to not expose this to the external internet). Creating other users is not required for the purposes of this tutorial. If you do decide to add another user for the database, make sure that the user can add, revise, delete data, but not add users (again not be a system user).

   if you have issues logging into the MySQL database using the command line, check this article:
   https://serverfault.com/questions/795290/admin-password-of-mariadb-doesnt-seem-to-work

install php for sql;
‘sudo apt-get install php-MySQL’
   No real things to note here. 

install support stuff;
‘sudo apt-get install phpmyadmin’
   choose apache2 if asked
   you will need to enter the root password from the mariadb/MySQL server setup (not the system root password).
   access this with http://localhost/phpmyadmin/

Then install nano (just a better command line text file editor);
‘sudo apt-get install nano’

For purposes of starting at boot, I would also suggest iceweasel, which is Firefox for PI. 
‘sudo apt-get install iceweasel’
   https://www.raspberrypi.org/forums/viewtopic.php?t=122444
   you can follow directions for opening a webpage from auto start and clicking F11 (or Fullscreen from menus). 
   i have it boot with the window, but i make full screen using the button or clicking F11.


Step 4 
- This step is kinda optional if you are installing right on the system itself.
   you will have to update the ownership of /var/www to pi
   'sudo chown pi /var/www'
   you can use sudo to extract the .zip file to the /var/www folder
   but you are going to be making a few updates. change it back later!

- Samba file server to make updates
   i performed all functions through samba file connection or directly on the pi and left ftp/ssh disabled
   Samba: Set up a Raspberry Pi as a File Server for your local network
   https://magpi.raspberrypi.org/articles/samba-file-server
   - edit applicable files for your internal network, so it is recognized
   - add user pi to the www-user group
   - add the /var/www as a network share with access for pi
   - you will have to change the ownership of the /var/www to pi 
   - do this by typing 'sudo chown /var/www pi'


Step 5
 - finish set up
Now that all the system requirements are intact, download the source from github;
http://github.com/willseeds

The source files are packaged to be copied to your server root (http://localhost/) to the keezer folder. If you are stating fresh there is probably already an index.html or index.php file in that folder (default; /var/www/html). Create a new folder in there called ‘keezer’. Copy all files to this folder. (http://localhost/keezer/) will be located in folder: /var/www/html/keezer/

Now move the private files starting with an understore “_” to /var/www/ (above the webroot) so they can be included in pages. If you install this in the webroot and not a keezer folder, you will have to edit the include locations on each page. Remove the "_" from the file name.

Edit the keezerdb.php file with your database information. There’s nothing to see in the common.php file. I have included white and black backgrounds for css files, so feel free to edit colors and text/fonts as desired in the globals.php file and copy/edit a new "color".css file. 

Log into the phpMyAdmin site and create a new database called "keezer". Click the import information and use the _keezer_db_import.txt, which should set up the initial database structure for the web application. Don't worry about the errors. It is suggested that you edit the information on the database with your information here and afterward it will be easy to copy/paste info in just the add.php (Admin>Add Beer) file. Then use the update-beer.php (Update> Beer selection) to only change date info, keeping to the 10-digit format, YYYY-MM-DD.

- Check this link to flip the screen if needed:
  https://www.raspberrypi.org/forums/viewtopic.php?f=108&t=166959


Step 6
- 1-wire set up
     use the below link to install an easier way to get the temp data from python
     https://www.raspberrypi.org/forums/viewtopic.php?t=228939


// sensors
i used the waterproof DS18B20 Temperature sensor and found it was not actually working correctly and fried my pi checking pins, so i bought two more pis/sensors (keeping one each secure for future known-good testing). before you starting hacking on the code, make sure the wiring connections are sound using a known-good voltmeter AND code snippets. 


// tap management
I tried to make the config file the only thing you need to update for all pages, so if you go beyond eight taps, you may have to update some code. start by adding your info to the config.php file and look at the site. you can edit the css files for text size/color and font. design is mostly based on a loop, based on $tapcount in the config.php file, so more than 8 taps should be able to be used (screen limiting). look through the simple design of the database. you cannot have things "on tap" and be "kicked". you can physically enter two beers with the same tap, but it may cause a conflict in tap-counting sql queries. my suggestion is to use as it was planned to be; a brewery management system. enter planned beers in the future with a little info. on brew-day enter a little more info, along with more info when it is kegged. You can go into the database and see the entries flowing down and to the right. there are also comments in the page queries that you might want to see if you think the database is missing something. entries not performed in the web-interface may affect functionality. try to minimize moving tables around, changing keys or renaming fields. if you want to add functionality, use new variable names. i found it easier to manage outside of the system and my first drinks would populate the keezer info (name, dates, comments, etc). 


// site map
/site root (where non-accessible config docs go; "_*.php" files; /var/www/)
 /html 			(site root folder, http://localhost/)
   /keezer 		(extract keezer kiosk files here in subfolder of main site http://localhost/keezer/)
   main .php files 	(index.php - php files should be allowed on your server and working)
     /admin		(the admin files go here for security)


// my lessons learned, your warning
- do not expose this website to the internet. if you have to, pull the admin stuff (but then whats the point).
- backup your data. even though its on a SD card, not just your webroot, the whole thing.
- use known-good equipment. i tried a new meter and toasted a pi. swapping the SD card to another was a minimal impact.
- if you suspect malicious intent, look up how to lock down the admin folder with an .htaccess file ;)


// links, shout-outs and notable mentions
After seeing the Magic Mirror project, i thought of other ways to use Michael Teeuw's original version of the magic mirror. it was a little outside of my skillset at the time, but i loved the idea of a kiosk-style website. shortly after seeing this and thinking how i could use it, i came up with the Keezer Kiosk project. 
   https://michaelteeuw.nl/post/80391333672/magic-mirror-part-i-the-idea-the-mirror

Tania Rascia's excellent article on building a simple CRUD database app allowed me to get back up to date with new PHP/SQL coding examples along with setting the stage for how much of the Keezer Kiosk project was structured. 
   https://www.taniarascia.com/create-a-simple-database-app-connecting-to-mysql-with-php/

DS18B20 Temperature sensor (get the waterproof ones on Adafruit for around $10/ea)
i suggest this sensor for the ability to just add in another sensor (1-wire) and the system will pick it up on booting. this functionality was designed in for the use of 1 sensor for just keezer temperature.
   The code used in this was based on bouncymat's post on this string:
   https://www.raspberrypi.org/forums/viewtopic.php?t=35487

1-wire informational links
   Check out Tim's w1thermsensor package that can verify your 1-wire serial numbers and connectivity.
   https://github.com/timofurrer/w1thermsensor

   and this one that shows a lot about the w1thermsensor
   https://bigl.es/ds18b20-temperature-sensor-with-python-raspberry-pi/

   How the 1-wire is connected
   https://thepihut.com/blogs/raspberry-pi-tutorials/18095732-sensors-temperature-with-the-1-wire-interface-and-the-ds18b20

   Raspberry Pi Touch Display - 7" touch screen and case for about $90
   https://www.raspberrypi.org/documentation/hardware/display/

   cron for backing up mysql/site
   set up time-interval backups locally or over your network (mine goes to a nas)
   https://www.raspberrypi.org/documentation/linux/usage/cron.md

   *final note: nothing was ever learned without breaking it first.


// about @willseeds
most of my interests come from my 90's teen-life which includes my music interests in rock, metal and even some oldies. along with making beer an tinkering on electronics, i find myself working in the aerospace industry as a technical expert for a daily job. i have held mostly production jobs at companies such as Apple, Boeing and Microsoft. there's also a decent background in construction, computer aided drafting (CAD) and CNC programming. i am also known to snowboard, ride atvs and camp when i can. issues with my right shoulder in February 2020, just as a major pandemic hits, made it almost unbearable to cope with daily life and this project was my only focus to keep my sanity (i know, go figure). i hope to put a lot of this behind me and get back to brewing, my next electronics project and maybe learn to fly small airplanes soon. 


// about @keezerkiosk
  Started 5.6.20 - 1.0 released 8.6.20
  Target Goal: create a simple 
  touch-management viewable website 
  for showing keezer contents and
  history for 2 to 8 taps. 

  include insert/update/delete ability on past/upcoming
  beers for easy brewing/keezer management.

  simple HTML pages (with .php extension)
   - use include/require to add functionality
   - leave out the ID and SQL stuff from the user
   - source pages and phpMySQLadmin tables contain SQL understanding
   - admin area for add/edit/delete
   - touch-only for users, admin will need keyboard/mouse
   - globals page for keezer name, tap count, colors

The site was designed to be accessible from an internal network's website sub-folder, but can be updated easily to work as the main site. Update the include file locations (../../ should be just ../ to go up one folder instead of two). This was design this way to allow the home-computing environment to use the website/database functionality without disturbing the keezer files. 

***WARNING***
This site was not designed for external exposure to the internet. Only for internal/local network. It should for no reason at all be exposed to the external internet. If you want to show friends/family take a picture or invite them over for a beer and surprise them. 

-------

Happy Brewing and Cheers!

-------


