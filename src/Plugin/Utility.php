<?php
namespace Drupal\eBay\Plugin;

class Utility {
  public  $row_count = 1, $color1 = "CCFFFF", $color2="99FFCC", $print = 0, $output_string = '';
// text manipulation functions
  public function add_text($str) {
    if($str !== false) $this -> output_string .= $str;
  }
  public function print_output() {
    print "$this -> output_string";
  }
  public function get_text() {
    if($this -> print == 0) return $this -> output_string;
    else print $this -> output_string;
  }
  public function print_off(){
    $this -> print = 0;
  }
  public function print_on(){
    $this -> print = 1;
  }
  //debugging function
  public function look_at($array) {
      //for debugging -echos an array with a nice format in drupal
      $string = "<pre>";
      $string .= print_r($array, TRUE);
      $string .= "</pre>";
      return \Drupal\Core\Render\Markup::create($string);
  }
  
  public function u_now($time = false) {
      if(!$time) $time = \Drupal::time() -> getCurrentTime();
          return date("Y-m-d H:i:s", $time);          
  }
  public function validateDate($url_encoded_date, $format = 'Y-m-d') {
    $date_string = urldecode($url_encoded_date);
    if(!($d = \DateTime::createFromFormat($format, $date_string))) return false;
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    if($d -> format($format) === $date_string) return $date_string;
    else return false;
}

}