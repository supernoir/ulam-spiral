<?php

namespace UlamSpiral;

require_once './vendor/meyfa/php-svg/autoloader.php';
use SVG\SVG;
use SVG\Nodes\Shapes\SVGRect;

class UlamSpiral
{

  public function buildSpiral($preset)
  {
    $arr = [];
    $counter = 1;
    $multiplier = 1;
    for ($i = 0; $i < $preset; $i++) {
      if ($i % 4  === 0) {
        $counter = 1;
      } else {
        $counter = $counter + 1;
      }
      for ($j = 1; $j <= $multiplier; $j++) {
        $arr[] = $counter;
      }
      $arr[] = $counter;

      $multiplier = $multiplier + 1;
    }
    return $arr;
  }


  /**
   * Creates SVG image
   */
  public function createGraphic($directions)
  {
    $width = 640;
    $height = 480;
    $image = new SVG($width, $height);
    $doc = $image->getDocument();
    $fill_regular = "333333";
    $fill_prime = "#8e44ad";
    $rectSize = 5;
    $offset = 7;

    $currentHeight = $height / 2;
    $currentWidth = $width / 2;

    for ($i = 0; $i < count($directions); $i++) {
      switch ($directions[$i]) {
        case 0:
          $currentHeight = $currentHeight;
          break;
        case 1:
          $currentWidth = $currentWidth + $offset;
          break;
        case 2:
          $currentHeight = $currentHeight - $offset;
          break;
        case 3:
          $currentWidth = $currentWidth - $offset;
          break;
        case 4:
          $currentHeight = $currentHeight + $offset;
          break;
      }

      $rect = new SVGRect($currentWidth, $currentHeight, $rectSize, $rectSize);
      if (self::isPrime($i)) {
        $rect->setStyle('fill', $fill_prime);
      } else {
        $rect->setStyle('fill', $fill_regular);
      }
      $rect->setStyle('fill-opacity', 0.5);
      $doc->addChild($rect);
    }
    echo $image;
  }

  protected static function isPrime($num)
  {
    for ($i = 2; $i <= $num / 2; $i++) {
      if ($num % $i == 0) {
        return false;
      } else {
        return true;
      }
    }
  }

  public function createSpiral($preset)
  {
    $arr = self::buildSpiral($preset);
    return self::createGraphic($arr);
  }
}

$preset = 60;
$ulam = new UlamSpiral($preset);
$ulam->createSpiral($preset);
