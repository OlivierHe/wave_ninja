<?php
/**
 *  * User: Olivier Herzog
 * Date: 28/08/2017
 * Time: 18:28
 */

namespace WaveNinja\App;



class ImgMod
{
    

    public function annotateImage($image_file, $typeFr, $timeStamp, $fillColor, $backgroundColor)
    {
        $imagick = new \Imagick(realpath($image_file));
     
        $draw = new \ImagickDraw();
        $draw->setFillColor($backgroundColor);
        $draw->rectangle( 48, 740, 300, 777 ); 
        $imagick->drawImage($draw);
     
        
        $draw->setFillColor($fillColor);
        $draw->setTextUnderColor($backgroundColor);
        $draw->setFontSize(16);

        $time = ucfirst(strftime("%A %d/%m/%G à %H:%M", $timeStamp->getTimeStamp()));
        $text = $typeFr . "\n" . $time;
     
        $draw->setFont("fonts/Arial.ttf");
        $imagick->annotateimage($draw, 48, 754, 1, $text);
        $imagick->writeImage(realpath($image_file));
        return 'done annotation';
    }

    public function morphImages($images, $type)
    {
    
        $imagick = new \Imagick(realpath($images[count($images) - 1]));
     
        foreach ($images as $image) {
            $nextImage = new \Imagick(realpath($image));
            $imagick->addImage($nextImage);
        }
     
        $imagick->resetIterator();
        $morphed = $imagick->morphImages(2);
       
        $morphed->writeImages((realpath('../Public/img/surf_prev/' .$type. '/')) .'\m.png', 1);
    }
}
