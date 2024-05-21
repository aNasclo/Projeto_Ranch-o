<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Dados de exemplo
$data = [
    [
        "id" => 7410,
        "descricao" => "Coxinilho",
        "ICMs" => "0,36%, 0,268%",
        "data_da_ultima_compra" => "13/09/2022",
        "user_id" => 1,
        "vendas_totais" => [
            "SLM" => "5 Nos ultimos 3 Meses",
            "R1" => "1 Nos ultimos 3 Meses",
            "SS_Bauru" => "12 Nos ultimos 3 Meses",
            "SS_Ribeirão Preto" => "24 Nos ultimos 3 Meses",
        ],
        "abate_fiscal" => [
            "SLM" => -5,
            "R1" => +1,
            "SS_Bauru" => +12,
            "SS_Ribeirão Preto" => -24,
        ],
        "estoque" => 0,
        "estoque_minimo" => 20,
        "recomendacao" => "Enviar para SS_RP e SLM.",
    ],
    // Adicione mais itens conforme necessário
];

// Cria uma nova planilha
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Cabeçalhos
$headers = [
    'ID', 'Descrição', 'ICMs', 'Data da Última Compra', 'User ID', 
    'Vendas Totais SLM', 'Vendas Totais R1', 'Vendas Totais SS_Bauru', 
    'Vendas Totais SS_Ribeirão Preto', 'Abate Fiscal SLM', 'Abate Fiscal R1', 
    'Abate Fiscal SS_Bauru', 'Abate Fiscal SS_Ribeirão Preto', 
    'Estoque', 'Estoque Mínimo', 'Recomendação'
];

// Adiciona os cabeçalhos à primeira linha
foreach ($headers as $column => $header) {
    $cell = chr(65 + $column) . '1'; // 65 é o código ASCII para 'A'
    $sheet->setCellValue($cell, $header);
}

// Adiciona os dados à planilha
foreach ($data as $row => $item) {
    $sheet->setCellValue('A' . ($row + 2), $item['id']);
    $sheet->setCellValue('B' . ($row + 2), $item['descricao']);
    $sheet->setCellValue('C' . ($row + 2), $item['ICMs']);
    $sheet->setCellValue('D' . ($row + 2), $item['data_da_ultima_compra']);
    $sheet->setCellValue('E' . ($row + 2), $item['user_id']);
    $sheet->setCellValue('F' . ($row + 2), $item['vendas_totais']['SLM']);
    $sheet->setCellValue('G' . ($row + 2), $item['vendas_totais']['R1']);
    $sheet->setCellValue('H' . ($row + 2), $item['vendas_totais']['SS_Bauru']);
    $sheet->setCellValue('I' . ($row + 2), $item['vendas_totais']['SS_Ribeirão Preto']);
    $sheet->setCellValue('J' . ($row + 2), $item['abate_fiscal']['SLM']);
    $sheet->setCellValue('K' . ($row + 2), $item['abate_fiscal']['R1']);
    $sheet->setCellValue('L' . ($row + 2), $item['abate_fiscal']['SS_Bauru']);
    $sheet->setCellValue('M' . ($row + 2), $item['abate_fiscal']['SS_Ribeirão Preto']);
    $sheet->setCellValue('N' . ($row + 2), $item['estoque']);
    $sheet->setCellValue('O' . ($row + 2), $item['estoque_minimo']);
    $sheet->setCellValue('P' . ($row + 2), $item['recomendacao']);
}

// Salva a planilha em um arquivo
$writer = new Xlsx($spreadsheet);
$writer->save('Resumo.xlsx');

echo "Planilha 'Resumo.xlsx' criada com sucesso!";
