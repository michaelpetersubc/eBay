<?php

namespace Drupal\eBay\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\Http\Foundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Drupal\support_documents\Plugin\CurlClient;
use Drupal\support_documents\Plugin\UText;
use Drupal\eBay\Plugin\eBay;
use Drupal\eBay\Plugin\Utility;
//use Drupal\support_documents\Plugin\TopicLinks;
use Parsedown;

/**
 * Defines HelloController class.
 */
class eBayController extends ControllerBase {
  
  /**
   * Display the markup.
   *
   * @return array Return markup array.
   * 
   */
  public function main () {
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
    return [
        '#theme' => 'main',
        '#auctions' => $ebay -> driver($start_from, $auction_end, $limit_results_to),
        '#days' => $ebay -> getDays($limit_results_to),
    ];
//    return view('ebay',
  //      array('auctions' => $ebay -> driver($start_from, $auction_end, $limit_results_to, true)));
  }
  
  public function intro($start_from = false, $auction_end = false, $limit_results_to = false) {
    $ebay = new eBay();
    $u = new Utility();
    $parsedown = new Parsedown();
    $module_handler = \Drupal::service('module_handler');
    $assets_path = $module_handler -> getModule('eBay') -> getPath();
    $test_path = $assets_path.'/assets';
    $part1 = $parsedown -> text(file_get_contents($test_path.'/intro.0.md'));
    $part2 = $parsedown -> text(file_get_contents($test_path.'/intro.1.md'));
//    drupal_set_message($u -> look_at($part1));

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
    //drupal_set_message($u -> look_at($ebay -> driver($start_from, "2001-06-06", $limit_results_to)));
    return [
        '#theme' => 'intro',
        '#part1' => $part1,
        '#part2' => $part2,
        //'#description' => $line -> description,
        '#auctions' => $ebay -> driver($start_from, "2001-06-06", $limit_results_to),    
];
    
  }
  public function sniping($start_from = false, $auction_end = false, $limit_results_to = false) {
    $ebay = new eBay();
    $u = new Utility();
    $parsedown = new Parsedown();
    $module_handler = \Drupal::service('module_handler');
    $assets_path = $module_handler -> getModule('eBay') -> getPath();
    $test_path = $assets_path.'/assets';
    $part1 = $parsedown -> text(file_get_contents($test_path.'/sniping.md'));
    // $part2 = $parsedown -> text(file_get_contents($test_path.'/intro.1.md'));
    //    drupal_set_message($u -> look_at($part1));
    
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
    //drupal_set_message($u -> look_at($ebay -> driver($start_from, "2001-06-10", $limit_results_to)));
    return [
        '#theme' => 'cross',
        '#part1' => $part1,
        //'#description' => $line -> description,
        '#auctions' => $ebay -> driver($start_from, "2001-06-19", $limit_results_to),
        '#days' => $ebay -> getDays($limit_results_to),
    ];
    
  }
  public function cross($start_from = false, $auction_end = false, $limit_results_to = false) {
    $ebay = new eBay();
    $u = new Utility();
    $parsedown = new Parsedown();
    $module_handler = \Drupal::service('module_handler');
    $assets_path = $module_handler -> getModule('eBay') -> getPath();
    $test_path = $assets_path.'/assets';
    $part1 = $parsedown -> text(file_get_contents($test_path.'/cross.md'));
   // $part2 = $parsedown -> text(file_get_contents($test_path.'/intro.1.md'));
    //    drupal_set_message($u -> look_at($part1));
    
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
    //drupal_set_message($u -> look_at($ebay -> driver($start_from, "2001-06-10", $limit_results_to)));
    return [
        '#theme' => 'cross',
        '#part1' => $part1,
        //'#description' => $line -> description,
        '#auctions' => $ebay -> driver($start_from, "2001-06-10", $limit_results_to),
        '#days' => $ebay -> getDays($limit_results_to),
    ];
    
  }
  public function against($start_from = false, $auction_end = false, $limit_results_to = false) {
    $ebay = new eBay();
    $u = new Utility();
    $parsedown = new Parsedown();
    $module_handler = \Drupal::service('module_handler');
    $assets_path = $module_handler -> getModule('eBay') -> getPath();
    $test_path = $assets_path.'/assets';
    $part1 = $parsedown -> text(file_get_contents($test_path.'/against.md'));
    // $part2 = $parsedown -> text(file_get_contents($test_path.'/intro.1.md'));
    //    drupal_set_message($u -> look_at($part1));
    
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
    if(!$limit_results_to) $limit_results_to = 5;
    //drupal_set_message($u -> look_at($ebay -> driver($start_from, "2001-06-10", $limit_results_to)));
    return [
        '#theme' => 'cross',
        '#part1' => $part1,
        //'#description' => $line -> description,
        '#auctions' => $ebay -> driver($start_from, "2001-06-29", $limit_results_to),
        '#days' => $ebay -> getDays($limit_results_to),
    ];
  }
  public function groping($start_from = false, $auction_end = false, $limit_results_to = false) {
    $ebay = new eBay();
    $u = new Utility();
    $parsedown = new Parsedown();
    $module_handler = \Drupal::service('module_handler');
    $assets_path = $module_handler -> getModule('eBay') -> getPath();
    $test_path = $assets_path.'/assets';
    $part1 = $parsedown -> text(file_get_contents($test_path.'/groping.md'));
    // $part2 = $parsedown -> text(file_get_contents($test_path.'/intro.1.md'));
    //    drupal_set_message($u -> look_at($part1));
    
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
    //drupal_set_message($u -> look_at($ebay -> driver($start_from, "2001-06-10", $limit_results_to)));
    return [
        '#theme' => 'groping',
        '#part1' => $part1,
        //'#description' => $line -> description,
        '#auctions' => $ebay -> driver($start_from, "2001-06-27", $limit_results_to),
        '#days' => $ebay -> getDays($limit_results_to),
    ];
  }
 }
