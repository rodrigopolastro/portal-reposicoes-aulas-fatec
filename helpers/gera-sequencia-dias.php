<?php

//Retorna um array com uma sequencia de {quantidadeDias} dias 
//no formato YYYY-mm-ddd a partir de uma data {dataInicial}
function geraSequenciaDias($dataInicial, $quantidadeDias)
{
    $sequenciaDias = [];
    $datetime = new DateTimeImmutable($dataInicial);

    for ($incrementoDias = 0; $incrementoDias < $quantidadeDias; $incrementoDias++) {
        $strIncremento = 'P' . $incrementoDias . 'D';
        $dataStr = $datetime->add(new DateInterval($strIncremento))->format('Y-m-d');
        array_push($sequenciaDias, $dataStr);
    }

    return $sequenciaDias;
}
