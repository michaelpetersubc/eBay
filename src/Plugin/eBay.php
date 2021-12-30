<?php

namespace Drupal\eBay\Plugin;

use Drupal\eBay\Plugin\Utility;


class eBay {

  public function driver($start_from, $auction_end, $limit_results_to, $front_page = false) {
    $page = new Utility();
    $db = \Drupal :: database();
    $auctions = new \stdClass;
    $start_at = urldecode($start_from);
    $start_at_loop = $start_at;
    $auction_ending_day = urldecode($auction_end);
    $auctions -> limit_results_to = $limit_results_to;
    $auctions -> auctions = array(); 
    $auctions -> front_page = array(); 
    $keep_going = true;
    
    while($keep_going) {
    
      //code to find the next bid - complicated because it has to be made in an auction ending today
      //******* first the query asks for the very next bid time and the auction where this bid was submitted
      $query = "select bid_time as revised_auction_time,auction_number as tentative_auction,
       bidder as tentative_next_bidder from ebay.ebay where bidder!='' and
       date_format(bid_time,'%Y-%m-%d')=date_format(?,'%Y-%m-%d')
       and bid_time>? order by bid_time asc limit 1";
      //print "$first_query";
      if($result = db_query($query, array($auction_ending_day, $start_at_loop)) -> fetchAll()) {
        if( count($result) > 0) {
    
          $line = $result[0];
        } else $keep_going = false;
      } else $keep_going = false;
      //in case the query succeeds, check that the bid is submitted in an auction ending
      //today ($auction_ending_day)
      if($keep_going) {
        $query = "select seller from ebay.ebay where seller!='' and auction_number=?
      and date_format(ending_time,'%Y-%m-%d')=date_format(?,'%Y-%m-%d')";
        //the query asks for a seller with the right auction number and ending date
        // if such a seller exists, break out of the loop
        //if not the end date is wrong, revise the auction end time and do the query again
        if(($result = db_query($query, array($line -> tentative_auction, 
            $auction_ending_day)) -> fetchAll()) 
            and (count($result) > 0)) $keep_going = false;
        else $start_at_loop = $line -> revised_auction_time;
      }
    }
    //end while keep going=0
    
    /*  at this point, $revised_auction_time, $tentative_auction, and $tentative_next_bidder define
     the next bid time, the next bidder and the auction number of the next bid
     this information is used in one_auction
     */
    $encoded_revised_auction_time = urlencode($line -> revised_auction_time);
  
    $query_counter = 0;
    //select all the auctions with the right ending day
    $first_query = "select auction_number from ebay.ebay where seller!='' 
    		and date_format(ending_time,'%Y-%m-%d')=date_format(?,'%Y-%m-%d')";
    
    if($first_result = db_query($first_query, array($auction_ending_day)) -> fetchAll()) {
      // if there are some auctions ending, go through the display for each one
      if(count($first_result) > 0) {
        foreach ($first_result as $first_line) {
          $auction_number = $first_line -> auction_number;
          $query_counter++;
    
          //this routine displays the bids made to the auction number being analyzed
          //include("./one_auction.php");
          $auctions -> auctions[] = $this -> one_auction($auction_number, $start_at, 
              $limit_results_to, 
              $auction_end, $encoded_revised_auction_time);
        }
      } else $auctions = false;
    }
    if ($front_page) {
      //$page -> add_text ("<h2>View more results</h2><table border 1><tr><td>");
      /*$query = "select count(seller) as number_of_auctions,date_format(ending_time,'%Y-%m-%d') 
          as end_string,date_format(ending_time,'%m-%d') as e from ebay where seller !='' group by e,ending_time";
      //print "$first_query"; seller*/
      $query = "select count(seller) as number_of_auctions,date_format(ending_time,'%Y-%m-%d') 
          as end_string,date_format(ending_time,'%m-%d') as e from ebay.ebay
          where seller != '' 
          order by e asc group by ending_time";
     // $this_result = DB::table('ebay') -> select(DB::raw("
     //   count(seller) as number_of_auctions,date_format(ending_time,'%Y-%m-%d') 
     //     as end_string,date_format(ending_time,'%m-%d') as e")) -> where('seller', '<>', '')
     //     -> orderBy('e', 'asc') -> groupBy('ending_time') -> get();
     $this_result = db_query($query,'1') -> fetchAll();
        if(count($result)  >= 0) {
         $n = 1;
         $saved_line = false;
         $e = false;
          foreach($this_result as $next_line) {
           if(($e) and ($e != $next_line -> e)) {
            $saved_line -> auction_count = $n;
            $auctions -> front_page[] = $saved_line;
            $saved_line = $next_line;
            $n =1 ;
            $e = $next_line -> e;
           } else {
            $e = $next_line -> e;
            $saved_line = $next_line;
            $n++;
           }
           
/*            $page -> add_text ("|<a href=\"?auction_end=$next_line->end_string
                &start_from=$next_line->end_string+00:00:00&limit_results_to=$auctions->limit_results_to\">
                $next_line->e($next_line->number_of_auctions)</a>| ");*/
          }
        
        //$page -> add_text ("</td></tr></table>");
      }
  }
   
    //return $page -> get_text();
    return  $auctions;
    //return false;
  }
  
    //draw return an auction object for rendering
    public function one_auction($auction_number, $start_at, $limit_results_to, 
        $auction_end, $encoded_revised_auction_time) {

      $auction = new \stdClass;
      $auction -> bidders = array();
      $auction -> next_time = false;
      $auction -> number = $auction_number;
      $auction -> start_at = $start_at;
      $auction -> limit_results_to = $limit_results_to;
      $auction -> end = $auction_end;
      $auction -> encoded_revised_auction_time = $encoded_revised_auction_time;
      $query = "select bid_time as next_time,bidder as next_bidder from ebay.ebay where bidder!=''
    and auction_number=? and bid_time>? order by bid_time asc limit 1";
      // print "$query<br>";
      if ($result = $db -> query( $query, array (
          $auction -> number,
          $auction -> start_at
      ) ) -> fetchAll()) {
        if (count($result) > 0) {
          $line = $result[0];
          $auction -> next_time = $line -> next_time;
          $auction -> next_bidder = $line -> next_bidder;
        } else {
         $auction -> next_time = false;
         $auction -> next_bibber = false;
        }
        
      }
      // get maximum bid in this auction
      $query = "select max(bid_amount) as max_bid from ebay.ebay where bidder!=''
    and auction_number=? and bid_time<=?";
      // print "$query<br>";
      $result = db_query( $query, [
          $auction -> number,
          $auction -> start_at
      ]) -> fetchAll();
      $line = $result[0];
      $auction -> max_bid = $line -> max_bid;
      
      // get second higest bid in this auction
      if ($auction -> max_bid) {
        $query = "select max(bid_amount) as second_bid from ebay.ebay where bidder!=''
    and auction_number=? and bid_amount<? and bid_time<=?";
        // print "$query<br>";
        $result = db_query( $query, [
            $auction -> number,
            $auction -> max_bid,
            $auction -> start_at
        ] ) -> fetchAll();
        $line = $result[0];
        $auction -> second_bid = $line -> second_bid;
        // print "$second_bid<br>";
      }
      // get auction characteristics
      $query = "select seller,date_format(starting_time,'%a %M %e') as nice_starting_day,
    date_format(starting_time,'%T') as nice_starting_time,
  date_format(ending_time,'%a %M %e') as nice_ending_day,
    date_format(ending_time,'%T') as nice_ending_time
  from ebay.ebay where auction_number=? and seller!='' limit 1";
      // print "$query<br>";
      $result = $db -> query( $query, [$auction -> number] ) -> fetchAll();
      $line = $result[0];
      $auction -> seller = $line -> seller;
      $auction -> nice_starting_day = $line -> nice_starting_day;
      $auction -> nice_starting_time = $line -> nice_starting_time;
      $auction -> nice_ending_day = $line -> nice_ending_day;
      $auction -> nice_ending_time = $line -> nice_ending_time;
           
      
      $query = "SELECT bidder,bid_amount,bid_time,date_format(bid_time,'%a %T') as nice_bid_time
      FROM ebay.ebay where bidder!='' and auction_number=? and bid_time<=?
      order by bid_time desc limit ".$auction -> limit_results_to;
      if (($result = db_query( $query, array (
          $auction -> number,
          $auction -> start_at,
          //$auction -> limit_results_to
      ) ) -> fetchAll()) and (count($result) > 0)) {
       foreach ($result as $line ) {
        $auction -> bidders[] = $line;
        /*          $bidder = $line -> bidder;
         $bid_amount = $line -> bid_amount;
         $bid_time = $line -> bid_time;
         $nice_bid_time = $line -> nice_bid_time;
         */
       }
      }
      // print "The maximum bid is $max_bid<br>the next time is $next_time";
      if ($auction -> next_time !='finished') {
        $auction -> new_start_from = urlencode ( $auction -> next_time );
      } else
       $auction -> new_start_from = 'finished';

      
        return $auction;      
    }
    //write out the auction in html
    public function getDays($limit_results_to) {
      //an array containing days of the month with the number of auctions to use at the bottom of the page
      $query = "select count(seller) as number_of_auctions,date_format(ending_time,'%Y-%m-%d') 
          as end_string,$limit_results_to as limit_results_to from ebay.ebay where seller !='' group by end_string";
      $result = db_query($query,[1]) -> fetchAll();
      return $result;      
    }

}
