<?php
require_once 'voiture.php';

$voiture1 = new Voiture("BE132456789", new dateTime("2009/03/25"), 30001, "C30 2009", "Volvo", "rouge", 1361);
$voiture1->setImage("https://www.automoblog.net/wp-content/uploads/2009/06/volvo-c30-blog-5.jpg");

$voiture2 = new Voiture("DE132456789", new dateTime("2009/03/24"), 30002, "C30 2009", "Volvo", "jaune", 1361);
$voiture2->setImage("https://s31.wheelsage.org/format/picture/picture-preview-large/volvo/c30/autowp.ru_volvo_c30_drive_6.jpg");

$voiture3 = new Voiture("FR132456789", new dateTime("2009/03/23"), 30003, "C30 2009", "Volvo", "bleue", 1361);
$voiture3->setImage("https://cloud.leparking.fr/2020/03/29/01/39/volvo-c30-2009-volvo-1-6d-r-design-coupe-bleu_7512451926.jpg");

$voiture4 = new Voiture("BE987654321", new dateTime("2012/06/25"), 85000, "GT86 2.0 D-4S 2012", "Toyota", "rouge", 1205);
$voiture4->setImage("https://static.choisir.com/image/upload/w_392/automobile/photos/versions/toyota/gt86/2012/toyota-gt86-coupe-2p-2012-lowaggressive-rouge-rubis.jpg");

$voiture5 = new Voiture("DE987654321", new dateTime("2012/06/26"), 85001, "GT86 2.0 D-4S 2012", "Toyota", "blanche", 1205);
$voiture5->setImage("https://prod.pictures.autoscout24.net/listing-images/ee97a02d-f8a5-4855-995c-0c5457b7d464_c9920ec7-a8ee-4836-b4f0-14e7a1d8c4f8.jpg/640x480_white-background.jpg");

$voiture6 = new Voiture("FR987654321", new dateTime("2012/06/27"), 85002, "GT86 2.0 D-4S 2012", "Toyota", "bleue", 1205);
$voiture6->setImage("https://www.turbo.fr/sites/default/files/styles/article_690x405/public/migration/test/field_image/000000004908632.jpg?itok=XHlMAjvK");

$voiture7 = new Voiture("BE111111111", new dateTime("2015/09/15"), 112000, "A4 3.0 TDI 218hp sport", "Audi", "bleue", 1515);
$voiture7->setImage("https://auto.cdn-rivamedia.com/photos/annonce/big/audi-a4-avant-v6-30-tdi-218-s-tronic-7-sport-120974325.jpg");

$voiture8 = new Voiture("DE111111111", new dateTime("2015/09/16"), 112001, "A4 3.0 TDI 218hp sport", "Audi", "blanche", 1515);
$voiture8->setImage("https://www.frenchdriver.fr/media/upload/2016/11/essai-audi-a4-allroad-2016-frenchdriver-1-001.jpg");

$voiture9 = new Voiture("FR111111111", new dateTime("2015/09/17"), 112002, "A4 3.0 TDI 218hp sport", "Audi", "rouge", 1515);
$voiture9->setImage("https://www.largus.fr/images/photos/rsi/_G_JPG/Voitures/AUDI/A4/V_B9/Ph1/Berline_4_portes/troisquartavant1.jpg");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table class="table" style="border: 1px solid black;">
        <thead>
            <tr>
                <th style="border: 1px solid black;">Photo</th>
                <th style="border: 1px solid black;">Num Imma</th>
                <th style="border: 1px solid black;">Date Mise Circu</th>
                <th style="border: 1px solid black;">Kilomètrage</th>
                <th style="border: 1px solid black;">Modèle</th>
                <th style="border: 1px solid black;">Marque</th>
                <th style="border: 1px solid black;">Couleur</th>
                <th style="border: 1px solid black;">Poids</th>
            </tr>
        </thead>
        <tbody>
            <?php
                /* echo $voiture1->display();
                echo $voiture2->display();
                echo $voiture3->display();
                echo $voiture4->display();
                echo $voiture5->display();
                echo $voiture6->display();
                echo $voiture7->display();
                echo $voiture8->display();
                echo $voiture9->display(); */

                foreach(Voiture::getInstances_() as $instance){
                    echo $instance->display();
                }
            ?>
        </tbody>
    </table>
</body>
</html>