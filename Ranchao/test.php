<?

// echo "hello world" . PHP_EOL;

// $Numeros = [1,2,3,4,5,6,7,8,9];

// foreach ($Numeros as $Numero) {
//     echo $Numero . PHP_EOL;
// }

// readfile()

// Caminho do arquivo CSV
$caminho_arquivo = 'C:/Users/Angelo/Desktop/Git_Share_AE/Ranchao/bepo.csv';

// // Abrir o arquivo CSV
// if (($handle = fopen($caminho_arquivo, "r")) !== FALSE) {
//     // Ler e exibir cada linha do arquivo CSV
//     while (($dados = fgetcsv($handle, 1000, ",")) !== FALSE) {
//         $num = count($dados);
//         echo "<p> $num campos na linha:</p>\n";
//         for ($c = 0; $c < $num; $c++) {
//             echo $dados[$c] . "<br />\n";
//         }
//     }
//     fclose($handle);
// } else {
//     echo "Erro ao abrir o arquivo.";
// }

// Abrir o arquivo CSV
if (($handle = fopen($caminho_arquivo, "r")) !== FALSE) {
    // Ler e exibir cada linha do arquivo CSV
    while (($dados = fgetcsv($handle, 1000, ",")) !== FALSE) {
        // Exibir apenas o item da primeira coluna
        echo $dados[0] . "<br />\n";
    }
    fclose($handle);
} else {
    echo "Erro ao abrir o arquivo.";
}