<?php


function createDetailsPage($con, $dataArray)
{


    /*
     *
     * $dataArray = array(
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
     *
     */


    $sql = "INSERT INTO `property_details`(`title`, `offerta_minima`, `Tipo_di_vendita`, `Procedura`, `property_status`, `large_pic`, `pdf`, `property_link`, `status`) VALUES ('" . $dataArray["title"]. "','" . $dataArray["offerta_minima"]. "','" . $dataArray["Tipo_di_vendita"]. "','" . $dataArray["Procedura"]. "','" . $dataArray["property_status"]. "','" . $dataArray["large_pic"]. "','" . $dataArray["pdf"]. "','" . $dataArray["property_link"]. "',1)";


    if ($con->query($sql) === TRUE) {
        $lastInsertId = $con->insert_id;
        $sql = "INSERT INTO `property_details_informazioni_vendita`(`TIPO_PROCEDURA`, `NUMERO_PROCEDURA`, `NUMERO_IVG`, `last_updated`, `TIPO_VENDITA`, `DESCRIZIONE_VENDITA`, `INFORMAZIONI_AGGIUNTIVE_SULLA_VENDITA`, `OFFERTA_MINIMA`, `INFORMAZIONI_AGGIUNTIVE_SULLA_VENDITA_2`, `CONTROPARTE_ISTITUZIONALE`, `GIUDICE`, `DELEGATO_ALLA_VENDITA`, `CUSTODE`, `CURATORE`, `property_id`) VALUES ('" . $dataArray["TIPO_PROCEDURA"]. "','" . $dataArray["NUMERO_PROCEDURA"]. "','" . $dataArray["NUMERO_IVG"]. "','" . $dataArray["last_updated"]. "','" . $dataArray["TIPO_VENDITA"]. "','" . $dataArray["DESCRIZIONE_VENDITA"]. "','" . $dataArray["INFORMAZIONI_AGGIUNTIVE_SULLA_VENDITA"]. "','" . $dataArray["CONTROPARTE_ISTITUZIONALE"]. "','" . $dataArray["GIUDICE"]. "','" .$dataArray["DELEGATO_ALLA_VENDITA"]. "','" . $dataArray["CUSTODE"]. "','" . $dataArray["DELEGATO_ALLA_VENDITA"]. "','" . $dataArray["CUSTODE"]. "','" . $dataArray["CURATORE"]. "','" . $lastInsertId . "')";
        $con->query($sql);
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    $con->close();
}

?>