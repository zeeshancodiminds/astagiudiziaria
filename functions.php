<?php


function insertLinks($conn,$link){
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO `links`(`link`, `reading`, `status`) VALUES ('".$link."',1,1)";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}


function getDetailPage($conn,$html){

    $title = "N/A";
    $procedura = "N/A";
    $status = "N/A";
    $largePic = "N/A";
    $NUMERO_PROCEDURA = "N/A";
    $NUMERO_IVG = "N/A";
    $DESCRIZIONE_VENDITA = "N/A";
    $updateDate = "N/A";
    $INSTITUTIONAL_COUNTERPART = "N/A"; //Law Court
    $GIUDICE = "N/A"; // Judge
    $PDF = [];
    $mainDesc = "N/A";
    $item_base_price = "N/A";

    $status = $html->find(".status.background-immobili")->plaintext;
    $mainDesc = $html->find(".description")->innertext;
    $largePic = $html->find(".featured-image.test-ratio img");
    $title = $html->find(".main-info .immobili")->plaintext;

    foreach($largePic as $largpicData){
        if($largpicData->src){
            $largePic = $largpicData->src;
        }
    }

//$NUMERO_PROCEDURA = $html->find(".dati-vendita-group table tr:nth-child(2) td:nth-child(2)")->plaintext;

//$NUMERO_IVG = $html->find(".dati-vendita-group table tr:nth-child(3) td:nth-child(2)")->plaintext;


    $INSTITUTIONAL_COUNTERPART = ""; //Law Court
    $GIUDICE = ""; // Judge
    $currntRow = "";

    $InformazioniVendita = $html->find(".dati-vendita-group table tr");

    foreach($InformazioniVendita as $InformazioniVenditaData){
        //echo $InformazioniVenditaData->find("td:nth-child(1)")->plaintext;
        if($InformazioniVenditaData->find("td:nth-child(1)")->plaintext == "Numero Procedura"){
            $NUMERO_PROCEDURA = $InformazioniVenditaData->find("td:nth-child(2)")->plaintext;
        }else if($InformazioniVenditaData->find("td:nth-child(1)")->plaintext == "Numero IVG"){
            $NUMERO_IVG = $InformazioniVenditaData->find("td:nth-child(2)")->plaintext;
        }else if($InformazioniVenditaData->find("td:nth-child(1)")->plaintext == "Descrizione vendita"){
            $DESCRIZIONE_VENDITA = $InformazioniVenditaData->find("td:nth-child(2)")->plaintext;
        }else if($InformazioniVenditaData->find("td:nth-child(1)")->plaintext == "Tipo Procedura"){
            $TIPO_VENDITA  = $InformazioniVenditaData->find("td:nth-child(2)")->plaintext;
        }
    }


    $updateDate = $html->find(".pure-u-md-8-24");

    foreach($updateDate as $findUpdateDate){
        $updateDate[] =  $findUpdateDate->find("p");
    }

    $findPDF = $html->find("a");


    foreach($findPDF as $allPdf){

        if(strpos($allPdf->href, '.pdf') > 0){
            $PDF[] = $allPdf->href;
        }

    }

    $SOGGETTITable = $html->find(".soggetti-table tr");

    $currntRow = "";

    foreach($SOGGETTITable as $SOGGETTIData){

        if($currntRow == "Controparte Istituzionale"){
            $INSTITUTIONAL_COUNTERPART = $SOGGETTIData->find("td:nth-child(2)")->plaintext;
        }else if($currntRow == "Giudice"){
            $GIUDICE = $SOGGETTIData->find("td:nth-child(2)")->plaintext;
        }else if($currntRow == "Prezzo base:"){
            $item_base_price = $SOGGETTIData->find("td:nth-child(2)")->plaintext;
        }
        $currntRow = $SOGGETTIData->find(".title-td")->plaintext;

    }


    echo $procedura;
    echo "<br>";
    echo $status;
    echo "<br>";
    echo $largePic;
    echo "<br>";
    echo $NUMERO_PROCEDURA ;
    echo "<br>";
    echo $NUMERO_IVG;
    echo "<br>";
    echo $DESCRIZIONE_VENDITA ;
    echo "<br>";
    echo $updateDate[0];
    echo "<br>";
    echo $INSTITUTIONAL_COUNTERPART; //Law Court
    echo "<br>";
    echo $GIUDICE ; // Judge
    echo "<br>";
    print_r($PDF);
    echo "<br>";
    print_r($mainDesc);
    echo "<br>";


    $dataArray = array(
        "title" => $title,
        "property_link" => "N/A",
        "pdf" => json_encode($PDF),
        "large_pic" => $largePic,
        "offerta_minima" => $item_base_price,
        "property_status" => $status,
        "Tipo_di_vendita" => "N/A",
        "Procedura" => $procedura,
        "TIPO_PROCEDURA"=> "N/A",
        "NUMERO_PROCEDURA"=> $NUMERO_PROCEDURA,
        "NUMERO_IVG"=> $NUMERO_IVG,
        "last_updated"=> $updateDate[0],
        "TIPO_VENDITA"=> "N/A",
        "DESCRIZIONE_VENDITA"=> $DESCRIZIONE_VENDITA,
        "INFORMAZIONI_AGGIUNTIVE_SULLA_VENDITA"=> "N/A",
        "OFFERTA_MINIMA"=> $item_base_price,
        "INFORMAZIONI_AGGIUNTIVE_SULLA_VENDITA_2"=> "N/A",
        "CONTROPARTE_ISTITUZIONALE"=> $INSTITUTIONAL_COUNTERPART,
        "GIUDICE"=> $GIUDICE,
        "DELEGATO_ALLA_VENDITA"=> "N/A",
        "CUSTODE"=>"",
        "CURATORE"=>"",
    );
    return $dataArray;
}

?>