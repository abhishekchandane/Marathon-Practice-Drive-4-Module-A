<?php
 
$cellSize = isset($_GET['cell_size']) ? (int)$_GET['cell_size'] : 50;
if ($cellSize <= 0) $cellSize = 50;

 
$srcImageName = 'original.jpg'; 
if (!file_exists($srcImageName)) die("Source image not found.");

$srcImg = imagecreatefromjpeg($srcImageName);
$width = imagesx($srcImg);
$height = imagesy($srcImg);

 
$mosaicImg = imagecreatetruecolor($width, $height);

 
for ($x = 0; $x < $width; $x += $cellSize) {
    for ($y = 0; $y < $height; $y += $cellSize) {
       
        $currentCellW = (($x + $cellSize) > $width) ? ($width - $x) : $cellSize;
        $currentCellH = (($y + $cellSize) > $height) ? ($height - $y) : $cellSize;
        
         
        $tmp = imagecreatetruecolor(1, 1);
        imagecopyresampled($tmp, $srcImg, 0, 0, $x, $y, 1, 1, $currentCellW, $currentCellH);
        
        
        $colorIndex = imagecolorat($tmp, 0, 0);
        imagedestroy($tmp);
        
         
        imagefilledrectangle($mosaicImg, $x, $y, $x + $currentCellW - 1, $y + $currentCellH - 1, $colorIndex);
    }
}

 
header('Content-Type: image/jpeg');
imagejpeg($mosaicImg);

 
imagedestroy($srcImg);
imagedestroy($mosaicImg);
?>
