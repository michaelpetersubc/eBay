## eBay
This drupal 8 modules is designed to provide an interactive display of data from ebay. The auctions involved computer processors and took place in the summer of 2001.  It is based on work by Mingli Zheng.

The data for the module is included as a json file in the data directory.

To use the module interactively, you'll need a website running drupal 8.  You'll also need to use composer to install the module [erusev/parsedown](https://github.com/erusev/parsedown) which converts mardown to html.  

To install that module, when you have the module set up in a directory where it will live, go to that directory and use the command `composer update`.  The composer json file is part of the module, so it should automatically install that file for you.

The mysql database that is used to install the module is included in the data directory of the module itself.  You can use that to create the database (it is only a single table).  Then give your drupal mysql user select access to this new database.

The data used in the module is also included as a json file in the data directory.  There is also a jupyter notebook file that gives a short description of the data.

If you find a way to improve the interaction, or otherwise do some more sophisticated analysis of the data, let me know.  Consider contributing your improvements here.