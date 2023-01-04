

## A Day in the Life of eBay

This interactive app is based on a java applet written by Mingli Zheng in 2002.  It allows you to follow 
the bidding that occurred in the previous year during  June and July on eBay. The data is restricted to sales of  Pentium
800 mhz processors. 

This applet illustrates many of the 'strange'
features of eBay bidding that have been discussed in the literature.
This page and its associated links allow you to step through various eBay auctions to see some of the interesting behaviour that occurred. 

The original intention was to compare actual behavior with what Sergei Severinov and I wrote about in the paper[An Ascending Double Auction](http://microeconomics.ca/michael_peters/information_revelation_7.pdf). In that paper we describe an efficient dynamic bidding procedure for eBay for situations in which there are many auctions for almost identical products.


This page describes how to use the applet, and the data that was used to
construct it.  If you already know all about it and just want to play
around with it, you can directly to the [php version](ebay.php?auction_end=2001-06-04&start_from=2001-06-04+00:00:00&limit_results_to=5). 

Mingli's original applet is not longer active.
### The Data

The auctions involve sales of used Pentium 800mhz processors.  Though
the processors were second hand, product quality was probably not an
important issue.  Processors in this speed range were only introduced
in 2000, so none of the processors could have been in service for too
long.  Many were sold in their original packaging.  All of the
auctions ended in June or early July of 2001. As is apparent from the
applet, the average price at which these things traded was a little
over $100US.

The processors were chosen because they are about as close as one could
get on eBay to a homogenous commodity at the time.  According to the paper with
Sergei Severinov that I mentioned above, bidder behavior in the face of many alternatives  should be
considerably different from that predicted in classroom auction theory.  

For additional information on the dataset, and for some of the
econometric analysis that he has done on this and subsequently
collected data, refer to Mingli Zheng's work [Bidding Behavior at Competing Auctions: Evidence from Ebay?](https://papers.ssrn.com/sol3/papers.cfm?abstract_id=691986) which was subsequently published in the European Economic Review.
.
### A little about eBay

Crudely speaking, eBay consists of a set independently run, ascending
second price auctions. Each seller registers his or her product with
eBay and sets a starting bid, as well as a possibly secret reserve
price.  Auctions run for 3, 5, 7, or 10 days (as the seller
chooses). 

Bidding is carried out on behalf of buyers by a proxy
bidder that adjusts bids over time so that a bidder who is willing to pay more than the highest standing bid ends up submitting the lowest bid that will ensure that they are the high bidder. 
At each step of this very dynamic process, the proxy bidder adjusts each bid by adding increments to ensure that it both rounds the high bid and ensures that it is unique.   A description
that provides a bit more information, (based on the authors' own experiences), is given in the paper by [Roth
and Ockenfels](http://www.economics.harvard.edu/~aroth/papers/eBay.veryshortaer.pdf).

The essential idea is that when buyers submit a 'bid' to the proxy
bidder, they are telling the proxy bidder the maximum amount that they
are willing to pay. The proxy bidder knows the maximum amount that the
current high bidder in any auction has said he or she is willing to pay.
When a new bidder enters his 'bid' into the ebay software, the proxy
bidder does one of two things.  If the new bid is <em>higher</em> than
the maximum amount the current high bidder is willing to pay, then the
proxy bidder raises the <em>standing bid</em> in the auction until
it is just slightly above the maximum amount the current high bidder is
willing to pay. Any new bidder comes to the auction after than  has to bid
striclty more than this standing bid. 

If the new bidders maximum willingness to pay is less than the maximum
amount the current high bidder is willing to pay, then the proxy
bidder will raise the standing bid just slightly above
this new bidder's value and inform the new bidder that his bid was unsuccessful. In this description 'slightly above' is some
amount that depends on the current price in the auction. 

When the bidding stops, the high bidder pays the current standing
bid.  In effect, the bidder who has submitted the highest bid ends up
paying just slightly more than the second highest bidder's bid. (At
least according to Roth and Ockenfels. It is surprising how vague all
of the auction websites are about exactly how the price you pay is
determined). (Editor Note:  This data was collected long ago.  Most of the links to eBay in the original version of this article no longer work. So it is likely that the rules have changed subsequently.  Everything written here is describing the way it was 'back in the day'.)

Some of the special rules that eBay imposes create some problems
for the 'second price' interpretation. For example, eBay interprets
every bid as an obligation to pay the seller the amount that you bid -
it is vague about the exact conditions under which you will be obliged
to make this payment.  One of the things eBay does explain is that you
may be required to pay the seller the amount you bid even if you don't
win the auction. Currently eBay recommends that bidders avoid submitting
a bid in a second auction until the first auction in which they have
bid ends. The reason is that the high bidder might withdraw his or her
bid for some legitimate reason, in which case the second high
bidder is still committed to the seller. eBay does not explain what price
you would be expected to pay if you won the auction under such circumstances.

Newsgroups complain that second high bidders are forced to pay their bid
under such circumstances, instead of the third highest bid.  You
could imagine that this creates pretty strong incentives for sellers
to bid in their own auction.  Bidders complain about this constantly
on eBay newgroups. Of course, eBay forbids sellers bidding
on their own behalf, but the practise is pretty hard to detect.

### An Example

The example given here illustrates how to read the applet
information. On June the 6th, only a single auction ended. The state of the auction
at the beginning of the day is shown below. The high bid in the auction is given in
green.  The second high bid, which is the standing bid, is given in
red. The high bidder is <em>ernzan</em> at $99.99.  Of course no one
other than ernzan knows that the bid is $99.99.  The standing bid,
submitted by <em>evermverm</em> is $90.  This bid was sumitted 2 days previously.

You can click on the `Add Next Bid Here` link to step through the rest of the bids for the day.