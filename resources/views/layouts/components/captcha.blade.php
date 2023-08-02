@php
    ob_start();
    $image = imagecreate(100, 30);
    $background_color = imagecolorallocate($image, 23, 162, 184);
    $text_color = imagecolorallocate($image, 255, 255, 255);
    imagestring($image, 5, 30, 5,$array[0].' '.$array[1].' '.$array[2], $text_color);
    header("Content-Type: image/png");
    imagejpeg($image, NULL, 100);
    $rawImageBytes = ob_get_clean();
@endphp
<label>حاصل عبارت رو به رو ؟  <img id="dont_show" src='data:image/jpeg;base64, {{base64_encode( $rawImageBytes )}} ' /> </label>
