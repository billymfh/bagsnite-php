<?php
// Set the content-type
header('Content-Type: image/png');

// using stil/gd-text
require './vendor/autoload.php';
include 'config.php';
use GDText\Box;
use GDText\Color;

// grab vars from our URL/GET
$text_player = $_GET['playername'];
$playerplace = $_GET['place'];


switch ($playerplace){
  case 1:
    $text_place = "#1";
    $text_victory = "Victory Royale!";
    break;
  case 2:
    $text_place = "  #2";
    $text_victory = "   Almost Won";
    break;
  default:
    $text_place = " #0";
    $text_victory = "  Biggest Loser";
}

switch ($text_place){
  case "#1";
  case "  #2";
    $text_desc = "had a";
  break;
  case " #0";
    $text_desc = "is the";
  break;
}

// Create the image
$im = imagecreatetruecolor(610, 180);
$backgroundColor = imagecolorallocate($im, 0, 0, 0);
imagefill($im, 0, 0, $backgroundColor);

// Create some colors
$yellow = imagecolorallocate($im,255, 250, 0);
$purple = imagecolorallocate($im,152, 0, 255);

$font = $includesDir.'BurbankBigCondensedBlack.ttf';

// using stil/gd-text because centering text is hard
$box = new Box($im);
$box->setFontFace($font); // http://www.dafont.com/franchise.font
$box->setFontColor(new Color(255, 250, 0));
$box->setTextShadow(new Color(152, 0, 255), 2, 2);
$box->setFontSize(60);
$box->setBox(20, 5, 600, 100);
$box->setTextAlign('center', 'top');
$box->draw("$text_player $text_desc");

// the position, with rotation
imagettftext($im, 90, 10, 37, 187, $purple, $font, $text_place); //shadow
imagettftext($im, 90, 10, 35, 185, $yellow, $font, $text_place); //text

// victory message
imagettftext($im, 62, 0, 151, 157, $purple, $font, $text_victory); //shadow
imagettftext($im, 62, 0, 149, 155, $yellow, $font, $text_victory); //text

// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($im);
imagedestroy($im);
?>
