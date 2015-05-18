This is a copy of DayZMapper from wterpstra
https://github.com/wterpstra/DayZMapper
This copy has been modified to work with Epoch. My modifications are a complete hack, but it seems to work for me. 

<b>Things that I didn't get working with Epoch:</b>
<pre>
- Deployables (buildings and such...)
</pre>

<b>Tested with:</b>
<pre>
- Epoch Version 1.0.2.1

- Windows Server 2008 R2 Standard Edition Service Pack 1
- Apache 2.4
- PHP Version 5.4.4

- Ubuntu 12.04.2 LTS
- Apache 2.2.22 
- PHP Version 5.3.10-1ubuntu3.8

- MySQL 5.5.28
- Firefox 23
- Chrome 29
</pre>

<b>Caveats</b>
<pre>

Doesn't seem to work in Internet Explorer. I don't use Internet Explorer, so I didn't attempt to fix this...

Epoch doesn't save a time stamp when data is committed to the database. So I had to use last login time. I set the query to show players that have logged in within the last 12 hours. You can change this in bin/data.php...
Locate:
s.LastLogin > DATE_SUB(now(), INTERVAL 12 HOUR)
Change "12 HOUR" to whatever you want (DAY, HOUR, MINUTE) Examples:
s.LastLogin > DATE_SUB(now(), INTERVAL 15 MINUTE)
s.LastLogin > DATE_SUB(now(), INTERVAL 2 HOUR)
s.LastLogin > DATE_SUB(now(), INTERVAL 1 DAY)

</pre>


....................................

<b>Supported Maps</b>
<pre>
- Chernarus
- Lingor
- Namalsk
- Panthera
- Takistan
- Taviana
- Napf
</pre>

<b>How to install:</b>

<pre>
1. Copy bin/* to your webhost (Can be the server that DayZ is running on but you
will need either apache or some other http server that can handle php)
2. Rename example_config.php to config.php
3. Change config.php to have your username/password/hostname etc.
5. Point your browser to wherever you copied stuff to.
</pre>

<b>Optional Stuff:</b>

Open console with CTRL+SHIFT+ENTER

Create .htaccess file to password protect the website. See http://httpd.apache.org/docs/current/howto/htaccess.html

If you want to use your own map graphic you need to specify certain values in the map.txt

Here is an example map.txt with comments (Do not add comments in the map.txt otherwise it will not work!)
<pre>
maps/chernarus.jpg 	// the map file that is loaded.
1234 				// image width in pixels
4321 				// image height in pixels
100 				// origo X offset in meters, origo means coordinates 0,0
30 					// origo Y offset in meters
1000 				// map X size in meters, these can be found in the dayz database
1000 				// map Y size in meters
</pre>
