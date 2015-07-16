<?php

$text = $_GET['text'];
$text = strtolower($text);

$len = strlen($text);

// Create a 100*30 image
$im = imagecreate($len * 10, 16);

$black = imagecolorallocate($im, 0, 0, 0);
imagecolortransparent($im, $black);

// White background and blue text
$textcolor = imagecolorallocate($im, 0, 0, 0);

// Write the string at the top left
whitespaces_imagestring($im, 5, 0, 0, $text, $textcolor);

// Output the image
header('Content-type: image/png');

imagepng($im);
imagedestroy($im);

function whitespaces_imagestring($image, $font, $x, $y, $string, $color) {
    $font_height = imagefontheight($font);
    $font_width = imagefontwidth($font);
    $image_height = imagesy($image);
    $image_width = imagesx($image);
    $max_characters = (int) ($image_width - $x) / $font_width ;
    $next_offset_y = $y;

    for($i = 0, $exploded_string = explode("\n", $string), $i_count = count($exploded_string); $i < $i_count; $i++) {
        $exploded_wrapped_string = explode("\n", wordwrap(str_replace("\t", "    ", $exploded_string[$i]), $max_characters, "\n"));
        $j_count = count($exploded_wrapped_string);
        for($j = 0; $j < $j_count; $j++) {
            imagestring($image, $font, $x, $next_offset_y, $exploded_wrapped_string[$j], $color);
            $next_offset_y += $font_height;

            if($next_offset_y >= $image_height - $y) {
                return;
            }
        }
    }
}
