<?php

namespace Drupal\Montoya\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\Http\Foundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Drupal\support_documents\Plugin\CurlClient;
use Drupal\support_documents\Plugin\UText;
//use Drupal\support_documents\Plugin\TopicLinks;
use Parsedown;

/**
 * Defines HelloController class.
 */
class MontoyaController extends ControllerBase {
  
  /**
   * Display the markup.
   *
   * @return array Return markup array.
   */
  public function content($page_name) {
    $client = new CurlClient ();
    $topics = array();
    //$config = \Drupal::config('support_documents.wiki_settings');
    //$url = $config -> get('wiki_url');

    $page = new UText ();
  //
/*$request = \Drupal::request();
  $session =  $request -> getSession();
  dpm($session -> get('cas_attributes'));*/
    //$url = 'https://montoya3.econ.ubc.ca/api/v4/projects/42/wikis';
    //drupal_set_message($page_name);
    if (!$page_name or ($page_name == 'index')) {
      $datas = CurlClient :: get ();
      foreach ( $datas as $data ) {
        $parts = explode ( '|', $data -> title );
        $data -> title = $parts [0];
        $data -> topic = $parts [1];
        $data -> index = $parts [2];
        if ($data -> topic == 'index') {
          $index_page = $data -> slug;
          
        } else if (in_array($data -> topic, $topics) === false) {
          $topics[] = $data -> topic;
        }
        //$wikis [] = $data;
      }
      
 
      $faq = CurlClient :: get($index_page);
      $title = $page -> get_title($faq -> title);
      $page -> add_text ( t ( '<h2>' . $title . '</h2>' ) );
      $parsedown = new Parsedown ();
      $page -> add_text($parsedown -> text($faq -> content));
      $page -> add_text('<h3>Articles</h3><ol>');
      foreach($topics as $topic) {
        $page -> add_text(TopicLinks :: get_menu($topic));
      }
      $page -> add_text ( t ( '</ol>' ) );
    } else {
      $faq = CurlClient :: get($page_name);
      if(!$faq -> title) {
        $page -> add_text("reply from <br>$faq->url<br>$faq->message");
      }
      $title = $page -> get_title($faq -> title);
      //$page -> add_text ( t ( '<h2>' . $title . '</h2>' ) );
      $parsedown = new Parsedown ();
      //drupal_set_message($page -> look_at($parsedown -> text($faq -> content)));
      $page -> add_text(t($parsedown -> text($faq -> content)));
    }
    return [ '#type' => 'markup',
      	     '#markup' => $page -> get_text(),
	   ];
  }
  public function ebay($pagename) {
    $f = new Front();
    switch($pagename) {
      case 'intro':
        return $f -> intro();
        break;
      case 'main':
        return $f -> main_page();
        break;
      case 'sniping':
        return $f -> sniping();
        break;
      case 'cross':
        return $f -> cross();
        break;
      case 'against':
        return $f -> against();
        break;
      case 'groping':
        return $f -> groping();
        break;      
    }
  }
  /*
   * display a pdf file
   * the files are retrieved from urls like
   * https://montoya.econ.ubc.ca/svn-econ/Econ600/web
   * $filename should be set a variable while $filepath should be hard coded in the routing file to be either
   * Econ600 or Econ306 (or whatever)  
   * the idea is to translate the url https://montoya.econ.ubc.ca/Econ600/preference_lecture.pdf
   * to https://montoya.econ.ubc.ca/svn-econ/Econ600/web/preference_lecture.pdf
   * in which case $filename=preference_lecture.pdf and filepath=Econ600
  */
  public function pdf($filename, $filepath) {
      $command = "/usr/bin/svn cat file:///home/peters/rpos/courses/".$filepath."/web/".$filename;
      $contents = '';
     // error_reporting(E_ALL);
      error_reporting(0);
      if(!($handle = popen($command, 'r'))) {
        $this -> error = true;
        $this -> message = "pipe failure opening handle";
      }
      while (!feof($handle)) {
        $contents .= fread($handle, 8192);
      }
      pclose($handle);
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      $response = new Response($contents);
      if($ext == 'pdf') {
      $disposition = $response -> headers -> makeDisposition(
            ResponseHeaderBag::DISPOSITION_INLINE,
            $filename
          );
        $response -> headers -> set('Content-Disposition', $disposition);
        $response -> headers -> set('Content-Type','application/pdf');
      }
      return $response;
      
    //$url = 'file:///home/peters/rpos/courses/'.$filepath.'/web/'.$filename;
   
  }
}
