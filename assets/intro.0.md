<html><head><title>A Day in the Life of eBay</title></head>
<body>
<h2>A Day in the Life of eBay</h2>
Mingli Zheng has written an applet that makes it possible to follow
the bidding that occurred last June and July on eBay in the market for Pentium
800 mhz processors. This applet illustrates many of the 'strange'
features of eBay bidding that have been discussed in the literature.
Since the applet shows the alternatives that bidders had available at
the times that they chose to bid, it is related to the paper that
Sergei Severinov and I have written <a
href="./papers/reserve_prices55.pdf">Internet
Auctions with Many Traders</a>. In that paper we analyze an indirect
mechanism that resembles the indirect mechanism that is effectively
used on eBay.
<p>
This note describes how to use the applet, and the data that was used to
construct it.  If you already know all about it and just want to play
around with it, you can directly to the <a
href="ebay.php?auction_end=2001-06-04&start_from=2001-06-04+00:00:00&limit_results_to=5">php
version</a>, or use Mingli's <a
href="http://www.chass.utoronto.ca/~mzheng/AuctionApplet.html">Java
version</a>.  Since the Java version runs on your own machine, it is
considerable faster than the php version, which  makes repeated
network calls.  The java version requires the java runtime
environment.  If you haven't got this installed, your browser should
point you to the right location when you click on the link.  If you
don't want the runtime environment or can't install on your machine,
then you are stuck with the slower php version.
<h3>The Data</h3>
The auctions involve sales of used Pentium 800mhz processors.  Though
the processors were second hand, product quality was probably not an
important issue.  Processors in this speed range were only introduced
in 2000, so none of the processors could have been in service for too
long.  Many were sold in their original packaging.  All of the
auctions ended in June or early July of 2001. As is apparent from the
applet, the average price at which these things traded was a little
over $100US.
<p>
The processors were chosen because they are about as close as one can
get on eBay to a homogenous commodity.  According to the paper with
Sergei Severinov that I mentioned above, behavior should be
considerably different in auctions where there are many alternatives
available, and that is what this dataset was supposed to capture.  
<p>
For additional information on the dataset, and for some of the
econometric analysis that he has done on this and subsequently
collected data, refer to Mingli Zheng's work at <a
href="http://www.chass.utoronto.ca/~mzheng">http://www.chass.utoronto.ca/~mzheng</a>.
<h3>A little about eBay</h3>
Crudely speaking, eBay consists of a set independently run, ascending
second price auctions. Each seller registers his or her product with
eBay and sets a starting bid, as well as a possibly secret reserve
price.  Auctions run for 3, 5, 7, or 10 days (as the seller
chooses). <p>Bidding is carried out on behalf of buyers by a proxy
bidder. The exact procedure that the proxy bidder uses to adjust
prices is quite difficult to figure out - the <a
href="http://pages.ebay.com/help/buyerguide/bidding-how.html">ebay
website</a> in not particularly helpful in this regard.  A description
that provides a bit more information, (based on the authors own experiences), is given in the paper by <a
href="http://www.economics.harvard.edu/~aroth/papers/eBay.veryshortaer.pdf">Roth
and Ockenfels</a>.<p>
The essential idea is that when buyers submit a 'bid' to the proxy
bidder, they are telling the proxy bidder the maximum amount that they
are willing to pay. The proxy bidder knows the maximum amount that the
current high bidder in any auction has said he is willing to pay.
When a new bidder enters his 'bid' into the ebay software, the proxy
bidder does one of two things.  If the new bid is <em>higher</em> than
the maximum amount the current high bidder is willing to pay, then the
proxy bidder raises the <em>standing bid</em> in the auction until
it is just slightly above the maximum amount the current high bidder is
willing to pay. Any new bidder in the auction has to bid
above this standing bid. <p>
If the new bidders maximum willingness to pay is less than the maximum
amount the current high bidder is willing to pay, then the proxy
bidder will raise the standing bid just slightly above
this new bidder's value and inform the new bidder that his bid was unsuccessful. In this description 'slightly above' is some
amount that depends on the current price in the auction.  See <a href="http://pages.ebay.com/help/basics/e_bid_conf3.html">http://pages.ebay.com/help/basics/e_bid_conf3.html</a>.
<p>
When the bidding stops, the high bidder pays the current standing
bid.  In effect, the bidder who has submitted the highest bid ends up
paying just slightly more than the second highest bidder's bid. (At
least according to Roth and Ockenfels. It is surprising how vague all
of the auction websites are about exactly how the price you pay is
determined).
<p>Some of the special rules that eBay imposes create some problems
for the 'second price' interpretation. For example, eBay interprets
every bid as an obligation to pay the seller the amount that you bid -
it is vague about the exact conditions under which you will be obliged
to make this payment.  One of the things eBay does explain is that you
may be required to pay the seller the amount you bid even if you don't
win the auction. Currently eBay recommends that bidders avoid submitting
a bid in a second auction until the first auction in which they have
bid ends. The reason is that the high bidder might withdraw his or her
bid for some legitimate reason, in which case the second high
bidder is still committed to the seller. 
<p>EBay does not explain what price
you would be expected to pay if you won the auction under such circumstances.
Newsgroups complain that second high bidders are forced to pay their bid
under such circumstances, instead of the third highest bid.  You
could imagine that this creates pretty strong incentives for sellers
to bid in their own auction.  Bidders complain about this constantly
on eBay newgroups. Of course, eBay forbids sellers bidding
on their own behalf, but the practise is pretty hard to detect.
<h3>An Example</h3>
The example given here illustrates how to read the applet
information. On June the 6th, only a single auction ended. The state of the auction
at midnight is shown below. The high bid in the auction is given in
green.  The second high bid, which is the standing bid, is given in
red. The high bidder is <em>ernzan</em> at $99.99.  Of course no one
other than ernzan knows that the bid is $99.99.  The standing bid,
submitted by <em>evermverm</em> is $90.  This bid was sumitted 2 days ago.
