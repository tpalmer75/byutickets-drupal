<?php 

/* Template.php */


/**
* Theme override for theme_preprocess_image()
*/
function byutickets_preprocess_image(&$variables) {
  $attributes = &$variables['attributes'];

  foreach (array('width', 'height') as $key) {
    unset($attributes[$key]);
    unset($variables[$key]);
  }
}


function byutickets_preprocess_page(&$vars) { 
  if (isset($vars['node']->type)) { 
    $vars['theme_hook_suggestions'][] = 'page__' . $vars['node']->type;
  } 
} // See more at: http://www.digett.com/blog/01/11/2012/overriding-page-templates-content-type-drupal-7#sthash.2fF0aj3k.dpuf



/* Func: get_schedule()
* Desc: Get schedule from byucougars.com
*/
function get_schedule($url) {
  $content = get_data($url);

  if ( !$content ) {
    // Fail here
    return 'Could not get schedule';
  }

  return get_element('schedule-table', $content);
}


/* Func: get_data()
* Desc: Get the data from a URL
*/
function get_data($url)
{
 $ch = curl_init();
 $timeout = 5;
 curl_setopt($ch,CURLOPT_URL,$url);
 curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
 curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
 $data = curl_exec($ch);
 curl_close($ch);
 return $data;
}


/* Func: get_element()
* Desc: Extract an element from a DOMObject
*/
function get_element($id, $doc) {

 $DOM = new DOMDocument;
 libxml_use_internal_errors(true);
 $DOM->loadHTML($doc);
 libxml_clear_errors();

 //get the calendar
 $el = $DOM->getElementByID($id);
 $tmpDOM = new DOMDocument();
 $tmpDOM->appendChild($tmpDOM->importNode($el, true));
 $el = $tmpDOM->saveHTML();
 return $el;
}


?>