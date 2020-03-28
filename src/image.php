<?php
if (isset($_GET)) {
  $width = $_GET['width'] ?? 1280;
  $height = $_GET['height'] ?? 720;
  $im = new Imagick();
  $im->readImage('uploads/' . $_GET['isbn'] . '.pdf[0]');
  $im->setImageBackgroundColor('white');
  $im->setImageAlphaChannel(Imagick::ALPHACHANNEL_REMOVE);
  $im->mergeImageLayers(Imagick::LAYERMETHOD_FLATTEN);
  $im->scaleImage($width, $height, true);
  $im->setImageBackgroundColor('#018786');
  $im->extentImage($width, $height,
    -($width - $im->getImageWidth()) / 2,
    -($height - $im->getImageHeight()) / 2);
  $im->setImageFormat('webp');
  header('Content-Type: image/webp');
  echo $im->getImageBlob();
}
?>
