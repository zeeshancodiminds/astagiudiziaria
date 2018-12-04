<?php

require_once "vendor/autoload.php";
require_once "connection.php";
require_once "functions.php";
require_once "all_links.php";
use FastSimpleHTMLDom\Document;


/*$pageNo = 75;
    foreach($allLinks as $all){
echo "No Page ".$pageNo;

    $html = Document::file_get_html($all);
    //$html = new Document(file_get_contents('https://www.astagiudiziaria.com/inserzioni/appartamento-posto-al-piano-secondo-con-cantina-e-autorimessa-in-correggio-re-7907'));

    // Find all post blocks
    $post = [];

    $title = $html->find(".card-content h3 a");

    foreach($title as $post) {
        insertLinks($con,$post->href);
        echo "<br>";
    }

    $pageNo++;
}*/

$html = Document::file_get_html("https://www.astagiudiziaria.com/inserzioni/lotto-edificabile-a-scarlino-gr-lotto-9-446110");

//$procedura = $html->find(".main-info .secondary-info:nth-child(4) strong")->plaintext;

getDetailPage($con,$html);

/*
 *
 * $procedura = $instance->find(".main-info .secondary-info:nth-child(4) strong")->plaintext;
$status = $instance->find(".status.background-immobili")->plaintext;
$largePic = $instance->find(".featured-image.test-ratio .portrait")->src;
$NUMERO_PROCEDURA = $instance->find(".dati-vendita-group table tr:nth-child(2) td:nth-child(2)")->plaintext;
$NUMERO_IVG = $instance->find(".dati-vendita-group table tr:nth-child(3) td:nth-child(2)")->plaintext;
$DESCRIZIONE_VENDITA = $instance->find(".dati-vendita-group table tr:nth-child(5) td:nth-child(2)")->plaintext;
$minOffer = $instance->find(".item-base-price .background-immobili")->plaintext;
*
*
*/





?>