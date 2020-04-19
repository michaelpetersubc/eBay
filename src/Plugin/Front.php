<?php
namespace Drupal\montoya\Plugin;

class Front {
  
	public function main_page () {
	  $request = \Drupal::request();
		$auction_end = false;
		$start_from = false;
		$limit_results_to = false;
		if($request -> get('auction_end')) {
			$auction_end = $request -> get('auction_end');
			if(strlen($auction_end) != 10) die("Invalid ending date");
		}
		if($request -> get('start_from')) {
			$start_from = $request -> get('start_from');
			if((strlen($start_from) > 0) and (strlen($start_from) != 19)) die("Invalid starting date");
		}
		if($request -> get('limit_results_to')) {
			$limit_results_to = $request -> get('limit_results_to');
			if(!is_numeric($limit_results_to)) die("Invalid limit for results");
		}
		if(!$auction_end ) $auction_end = "2001-06-06";
		if(!$start_from) $start_from = "2001-06-06+00:00:01";
		if(!$limit_results_to) $limit_results_to = 5;
		$ebay = new Ebay();
		return view('ebay', 
		    array('auctions' => $ebay -> driver($start_from, $auction_end, $limit_results_to, true)));
	}
	
	public function intro($start_from = false, $auction_end = false, $limit_results_to = false) {
	  $ebay = new Ebay();
	  $request = \Drupal::request();
	  if($request -> get('auction_end')) {
	    $auction_end = $request -> get('auction_end');
	    if(strlen($auction_end) != 10) die("Invalid ending date");
	  }
	  if($request -> get('start_from')) {
	    $start_from = $request -> get('start_from');
	    if((strlen($start_from) > 0) and (strlen($start_from) != 19)) die("Invalid starting date");
	  }
	  if($request -> get('limit_results_to')) {
	    $limit_results_to = $request -> get('limit_results_to');
	    if(!is_numeric($limit_results_to)) die("Invalid limit for results");
	  }
	  if(!$auction_end ) $auction_end = "2001-06-06";
	  if(!$start_from) $start_from = "2001-06-06+00:00:01";
	  if(!$limit_results_to) $limit_results_to = 5;

	  return view('ebay_intro', array(
	     'auctions' => $ebay -> driver($start_from, "2001-06-06", $limit_results_to),
	  ));
	  
	}
	public function sniping($start_from = false, $auction_end = false, $limit_results_to = false) {
	 $ebay = new Ebay();
	 $request = \Drupal::request();
	 if($request -> get('auction_end')) {
	  $auction_end = $request -> get('auction_end');
	  if(strlen($auction_end) != 10) die("Invalid ending date");
	 }
	 if($request -> get('start_from')) {
	  $start_from = $request -> get('start_from');
	  if((strlen($start_from) > 0) and (strlen($start_from) != 19)) die("Invalid starting date");
	 }
	 if($request -> get('limit_results_to')) {
	  $limit_results_to = $request -> get('limit_results_to');
	  if(!is_numeric($limit_results_to)) die("Invalid limit for results");
	 }
	 if(!$auction_end ) $auction_end = "2001-06-19";
	 if(!$start_from) $start_from = "2001-06-19+00:00:01";
	 if(!$limit_results_to) $limit_results_to = 5;
	
	 return view('sniping', array(
	   'auctions' => $ebay -> driver($start_from, $auction_end, $limit_results_to),
	 ));
	  
	}
	public function cross($start_from = false, $auction_end = false, $limit_results_to = false) {
	 $ebay = new Ebay();
	 $request = \Drupal::request();
	 if($request -> get('auction_end')) {
	  $auction_end = $request -> get('auction_end');
	  if(strlen($auction_end) != 10) die("Invalid ending date");
	 }
	 if($request -> get('start_from')) {
	  $start_from = $request -> get('start_from');
	  if((strlen($start_from) > 0) and (strlen($start_from) != 19)) die("Invalid starting date");
	 }
	 if($request -> get('limit_results_to')) {
	  $limit_results_to = $request -> get('limit_results_to');
	  if(!is_numeric($limit_results_to)) die("Invalid limit for results");
	 }
	 if(!$auction_end ) $auction_end = "2001-06-10";
	 if(!$start_from) $start_from = "2001-06-10+00:00:01";
	 if(!$limit_results_to) $limit_results_to = 5;
	
	 return view('cross', array(
	   'auctions' => $ebay -> driver($start_from, $auction_end, $limit_results_to),
	 ));
	  
	}
	public function against($start_from = false, $auction_end = false, $limit_results_to = false) {
	 $ebay = new Ebay();
	 $request = \Drupal::request();
	 if($request -> get('auction_end')) {
	  $auction_end = $request -> get('auction_end');
	  if(strlen($auction_end) != 10) die("Invalid ending date");
	 }
	 if($request -> get('start_from')) {
	  $start_from = $request -> get('start_from');
	  if((strlen($start_from) > 0) and (strlen($start_from) != 19)) die("Invalid starting date");
	 }
	 if($request -> get('limit_results_to')) {
	  $limit_results_to = $request -> get('limit_results_to');
	  if(!is_numeric($limit_results_to)) die("Invalid limit for results");
	 }
	 if(!$auction_end ) $auction_end = "2001-06-29";
	 if(!$start_from) $start_from = "2001-06-29+00:00:01";
	 if(!$limit_results_to) $limit_results_to = 12;
	
	 return view('against', array(
	   'auctions' => $ebay -> driver($start_from, $auction_end, $limit_results_to),
	 ));
	  
	}
	public function groping($start_from = false, $auction_end = false, $limit_results_to = false) {
	 $ebay = new Ebay();
	 $request = \Drupal::request();
	 if($request -> get('auction_end')) {
	  $auction_end = $request -> get('auction_end');
	  if(strlen($auction_end) != 10) die("Invalid ending date");
	 }
	 if($request -> get('start_from')) {
	  $start_from = $request -> get('start_from');
	  if((strlen($start_from) > 0) and (strlen($start_from) != 19)) die("Invalid starting date");
	 }
	 if($request -> get('limit_results_to')) {
	  $limit_results_to = $request -> get('limit_results_to');
	  if(!is_numeric($limit_results_to)) die("Invalid limit for results");
	 }
	 if(!$auction_end ) $auction_end = "2001-06-27";
	 if(!$start_from) $start_from = "2001-06-27+00:00:01";
	 if(!$limit_results_to) $limit_results_to = 5;
	
	 return view('groping', [
	   'auctions' => $ebay -> driver($start_from, $auction_end, $limit_results_to),
	 ]
	     );
	  
	}
}