## eBay

This repo contains a collection of software and data.  The first data set  was initially collected and analyzed by Mingli Zheng in 2001.  It contained data on auctions for a single class of Pentium Processors.

The second set of data was collected on auctions for cameras in 2005 by Chris Bidner.  It has many more observations but contains many different models that trade at different prices.

A description of the data from 2001 is at [https://montoya.econ.ubc.ca/eBay/intro](https://montoya.econ.ubc.ca/eBay/intro).  On that website you can interactively explore the data and see how the eBay trades evolve.  An analysis of the data in the module was published by Mingli Zheng in a paper called [Bidding Behavior at Competing Auctions](https://papers.ssrn.com/sol3/papers.cfm?abstract_id=691986) which was eventually published in the European Economic Review.

The data from 2005 on cameras has never been analyzed. But it has a much broader collection of outcomes with a lot more bidding.  There is a jupyter notebook (with an r kernel) that gives some preliminary desciptive analysis of the data and an R markdown shiny app that allows you to explore the various auctions.

I'll briefly describe the three projects you can explore (and hopefully extend for yourself) in this repo.

# Drupal Module

The drupal 8 module is designed to provide an interactive display of data from ebay. The software is all php and included in the `src` directory.  This is the same software that is used on the website mentioned above.

The data for the module is included as a json file in the data directory.

To use the module interactively, you'll need a website running drupal 8.  You'll also need to use composer to install the module [erusev/parsedown](https://github.com/erusev/parsedown) which converts mardown to html.  

To install that module, when you have the module set up in a directory where it will live, go to that directory and use the command `composer update`.  The composer json file is part of the module, so it should automatically install that file for you.

The mysql database that is used to install the module is included in the data directory of the module itself.  You can use that to create the database (it is only a single table).  Then give your drupal mysql user select access to this new database.

The data used in the module is also included as a json file in the data directory.  There is also a jupyter notebook file that gives a short description of the data.

If you find a way to improve the interaction, or otherwise do some more sophisticated analysis of the data, let me know.  Consider contributing your improvements here since I use this in some of my classes.

## Python Notebook

This notebook was written by Wenxin Ma and is contained in the `python` directory. 

What is does is to recover the values of the bidders using very crudely the logic of second price auctions - the value of any bidder is the highest bid they submitted and the starting bids of the sellers as their reserve prices.

For theoretical purists, this is not quite correct.  The eBay mechanism isn't a pure second price auction because of the minimum bid increments.  Even if it were, as Mingli Zheng pointed out in his paper, there are competing auctions so value bidding is weakly dominated by bidding something other than value, but doing so at multiple auctions.  He showed that  bidders who used what he called `cross bidding` got better prices on average than bidders who seemed to be value bidding.

## R notebook
 This notebook deals with the richer camera data that was collected in 2005. The r code in the notebook was contributed by Honkai Yu.  It provides a preliminary description of the data.
 
 Unlike the earlier processor data, there are many different brands and models in the camera data.  The data from processors in 2001 is slightly hard to interpret since the exact trading rules at that time were in flux.  For the camera data, there is fortunately a very old [bidding tutorial](https://papers.ssrn.com/sol3/papers.cfm?abstract_id=691986) that describes the rules at that time. 
 
 One unfortunate property is that the data contains three kinds of auctions.  There is a standard single unit auction, a multiple unit auction, that was referred to at that time as a `dutch` auction, and a reserver price auction where a secret reserve was set that was different from the starting bid.
 
 When interpreting the data, there is one flaw to watch out for.  The data set contains a column called `buy_it_now`.  The column is not a buy it now price, but the actual selling price in the auction. At that time, the buy it now price, if it existed at all, disappeared as soon as a bid was submitted above the starting price.  So all the auctions are standard auctions with bidding.
 
 There are a set of auctions (171 of them) where the highest bid submitted in an auction was strictly higher than the selling price. At this point in time this could not happen in a standard auction since the selling price was always equal to the last bid submitted. Since bids were submitted through a bidding robot, this last bid was typically less than the bid the buyer submitted to the robot.
 
 Among the auctions where the highest bid was strictly larger than the selling price, most were cases where a single bid was submitted so trade occurred at the starting bid. The other cases were cases in which multiple units were being sold in the same auction.  In those cases it seems the reported bids were those submitted to the robot rather than actual bids.
 
 In a standard auction it isn't necessary to show anyone the bid the winner submitted to bidding robot because the winning bidder can verify his price by checking that the last bid submitted bythe robot was correct.  In a multi unit auction the winning bidders need to see the higher value bidders to verify their payment is correct. 