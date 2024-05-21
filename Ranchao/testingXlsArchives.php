<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

// Caminho para o arquivo Excel
$inputFileName = 'C:/Users/Angelo/Desktop/Git_Share_AE/Ranchao/modelo.xls';

// Identifica o tipo do arquivo e cria o leitor apropriado
$spreadsheet = IOFactory::load($inputFileName);

// Obtém a planilha ativa (primeira planilha)
$worksheet = $spreadsheet->getActiveSheet();

/** 
*  // Aqui se pega todos os arquivos do excel!

* // Itera sobre as linhas e colunas da planilha
* foreach ($worksheet->getRowIterator() as $row) {
*     $cellIterator = $row->getCellIterator();
*     $cellIterator->setIterateOnlyExistingCells(false); // Para também iterar células vazias

*     foreach ($cellIterator as $cell) {
*         echo $cell->getValue() . "\t";
*     }
*     echo "\n";
* }

* Itera sobre as células da coluna A, começando da linha 2 e pegando os 3 primeiros itens
*/

/**
 * Aqui se pega os valores de quantidades de estoque no sistema
* $data = [];
* for ($row = 2; $row <= 4; $row++) { // 2 a 4 para pegar os 3 primeiros itens
*     $cellA = $worksheet->getCell('X' . $row);
*     $cellB = $worksheet->getCell('Y' . $row);
*     $valueA = $cellA->getValue();
*     $valueB = $cellB->getValue();
*     $data[] = [$valueA, $valueB];
* }

* // Imprime os valores obtidos
* print_r($data);
*/

// $data = [];
// for ($row = 3; $row <= 5; $row++) { // 3 a 5 para pegar os 3 primeiros itens após o cabeçalho
//     $cellA = $worksheet->getCell('X' . $row);
//     $cellB = $worksheet->getCell('Y' . $row);
//     $valueA = (int)$cellA->getValue();
//     $valueB = (int)$cellB->getValue();
//     $data[] = [$valueA, $valueB];
// }

// // Verifica a diferença de estoque
// foreach ($data as $item) {
//     $estoque = $item[0];
//     $estoqueMinimo = $item[1];

//     if ($estoque < $estoqueMinimo) {
//         $falta = $estoqueMinimo - $estoque;
//         echo "Estoque: $estoque, Estoque Mínimo: $estoqueMinimo. Faltam $falta unidades para atingir o estoque mínimo.\n";
//     } else {
//         $excesso = $estoque - $estoqueMinimo;
//         echo "Estoque: $estoque, Estoque Mínimo: $estoqueMinimo. Está $excesso unidades acima do estoque mínimo.\n";
//     }
// }


$data = [];
for ($row = 3; $row <= 5; $row++) { // 3 a 5 para pegar os 3 primeiros itens após o cabeçalho
    $cellA = $worksheet->getCell('A' . $row);
    $cellB = $worksheet->getCell('B' . $row);
    $cellX = $worksheet->getCell('X' . $row);
    $cellY = $worksheet->getCell('Y' . $row);
    $numeroItem = $cellA->getValue();
    $nomeItem = $cellB->getValue();
    $estoque = (int)$cellX->getValue();
    $estoqueMinimo = (int)$cellY->getValue();
    $data[] = [$numeroItem, $nomeItem, $estoque, $estoqueMinimo];
}

// Verifica a diferença de estoque
foreach ($data as $item) {
    $numeroItem = $item[0];
    $nomeItem = $item[1];
    $estoque = $item[2];
    $estoqueMinimo = $item[3];

    if ($estoque < $estoqueMinimo) {
        $falta = $estoqueMinimo - $estoque;
        echo "Codigo: $numeroItem ($nomeItem): Estoque: $estoque, Estoque Mínimo: $estoqueMinimo. É necessario comprar: $falta unidades para atingir o estoque mínimo.\n";
        return;
    }
    $excesso = $estoque - $estoqueMinimo;
    echo "Codigo $numeroItem ($nomeItem): Estoque: $estoque, Estoque Mínimo: $estoqueMinimo.  Este produto está com: $excesso unidades acima do estoque mínimo.\n";
}