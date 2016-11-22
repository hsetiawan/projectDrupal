<?php

namespace Drupal\rest_api\TwigExtension;

use Drupal\Core\Render\Markup;

class UrlExtension extends \Twig_Extension {
  /**
   * Here is where we declare our new filter.
   * @return array
   */
  public function getFilters() {
    return array(
      'urlpath' => new \Twig_Filter_Function(
        array('Drupal\rest_api\TwigExtension\UrlExtension', 'urlPathFilter') // Here we are self referencing the function we use to filter the string value.
      )
    );
  }

  /**
   * This is the same name we used on the services.yml file
   * @return string
   */
  public function getName() {
    return "urlpath.twig_extension";
  }

  /**
   * @param $string
   * @return float
   */
  public static function urlPathFilter($string) {

    if($string instanceof Markup) { // we check if the $string is an instance of Markup Object.

      // strip_tags help us to remove all the HTML markup.

      // if $string is an instance of Markup we use the method __toString() to convert it to string.

      $striped_markup = strip_tags($string->__toString());
      var_dump($striped_markup);

      // On avarage we read 130 words per minute.

      // the PHP function str_word_count counts the number of words of any given string.

      $wpm = str_word_count($striped_markup)/130; // $wpm = Words Per Minute.

      $reading_time = ceil($wpm); // Round the float number to an integer.

      return $reading_time; // we return an integer with the number of minutes we need to read something.

    } else {

      return $string;

    }

  }

}
