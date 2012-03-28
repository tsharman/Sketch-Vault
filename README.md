Sketch Vault
============
Pulls images from our favorite webcomics and puts them in an easy to read feed format

Requirements
------------
- LAMP (or similar)
- [XHP](https://github.com/facebook/xhp)

Features
--------
- Scripts to pull images from web comics to populate our db
- Facebook login functionality
- Like comics
- See feeds for all liked comics, and most popular comics for the past day and week

Notes
-----
- There are two empty config files you'll need to fill in. First one is lib/config.php for your facebook app's app id and secret. Second one is util/config.php for you db username/password/server/databse
- The authors of Sketch Vault never has and never will have any plans to monetize. We have a great deal of respect for the authors of the webcomics present and created Sketch Vault to easier consume webcomics we were already reading, as well as share some of our favorites with our friends.
- We also built Sketch Vault as a way to play with Facebook's XHP. Do check out how we utilized XHP to make generating markup for a feed super easy
- Do not take this code and attempt to monetize on other artists' work. That's super lame.
- Made with love in Ann Arbor
