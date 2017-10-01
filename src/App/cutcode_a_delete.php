           /*
        $parisDate = $this->dateArray->currentPastDate->setTimezone(new \DateTimeZone('Europe/Paris'));
        $today = mb_ereg_replace("(:)", '_', $parisDate->format("Y-m-d\TH:i:s\Z"));
        $todayFile =  $path . $types[0][0] . "/" . $today . ".png";
 
        $imgPath = "../Public/img/surf_prev/mean_wave_direction/2017-09-24T02_00_00Z.png";
            $imagick = new \Imagick(realpath($imgPath));
 
            $draw = new \ImagickDraw();
            $draw->setFillColor('#FFFFCC'); 
            $draw->rectangle( 48, 740, 300, 777 ); 
            $imagick->drawImage($draw);

            $draw->setTextUnderColor('#FFFFCC');
            $draw->setFillColor('rgb(0, 0, 0)');
            $draw->setFontSize(16);


            
            $parisDate = $this->dateArray->currentPastDate->setTimezone(new \DateTimeZone('Europe/Paris'));
            //$text = $parisDate->format("l d/m/Y à H:i");
            $text = strftime("%A %d/%m/%G à %H:%M",$parisDate->getTimestamp());

      
            $draw->setFont("fonts/Arial.ttf");
            $imagick->annotateimage($draw, 48, 754, 1, "Directions des vagues \n".$text);
            
            //$imagick->writeImage(realpath($imgPath));
            header("Content-Type: image/jpg");
            echo $imagick->getImageBlob();
        */


        /* changement de timezone pas ici
        $parisDate = $this->dateArray->currentPastDate->setTimezone(new \DateTimeZone('Europe/Paris'));
        $today = mb_ereg_replace("(:)", '_', $parisDate->format("Y-m-d\TH:i:s\Z"));
        $todayFile =  $path . $types[0][0] . "/" . $today . ".png"; */

     /*     $imagick = new \Imagick(realpath($todayFile));
 
            $draw = new \ImagickDraw();
            $draw->setFillColor('rgb(0, 0, 0)');
         
            $draw->setStrokeWidth(1);
            $draw->setTextUnderColor('#FFFFCC');
            $draw->setFontSize(10);

            $parisDate = $this->dateArray->currentPastDate->setTimezone(new \DateTimeZone('Europe/Paris'));
            $text = $parisDate->format("Y-m-d\TH:i:s\Z");

      
            $draw->setFont("fonts/Arial.ttf");
            $imagick->annotateimage($draw, 48, 746, 0, $text);
         
            $imagick->writeImage(realpath($todayFile));*/

        // ligne morph image

   
    

        // interpolation morphing ici 

        //$this->morphImages($images);


        // downloading new version
        /*
        echo 'Today file is '.$todayFile.'<br>';
        if (file_exists($todayFile)) {
            

            $existingFile = date("Y-m-d\TH:00:00\Z", filemtime($todayFile));
            echo 'Existing file is ' . $existingFile . '<br>';


            $exFileDatetime = new \DateTime();
            $exFileDatetime->setTimestamp(filemtime($todayFile));
            $todDatetime = new \DateTime();
            echo 'Today is ' . $todDatetime->format("Y-m-d\TH:i:s\Z") . '<br>';

            $interval = $exFileDatetime->diff($todDatetime);
            echo 'The interval is '.$interval->format('%H:%i:%s').'<br>';
            if (($interval->format('%H'))< "03") {
                return 'uptodate';
            }
        } */


        /*
        $date->setTimezone(new \DateTimeZone('Europe/Paris'));
        $timeStamp = $date->format("Y-m-d\TH:i:s\Z");
        $imgName = mb_ereg_replace("(:)", '_', $timeStamp);
        */

    //$this->annotateImage($image_file, $typeFr, $timeStamp, '#000000','#FFFFCC');
