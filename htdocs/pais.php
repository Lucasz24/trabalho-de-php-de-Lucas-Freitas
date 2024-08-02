<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>País</title>
</head>
<body>
    <?php
    
    if (!isset($_GET['codigo'])) {
        die('Código do país não especificado.');
    }

    $codigoPais = $_GET['codigo'];

    $url = 'https://restcountries.com/v3.1/alpha/' . $codigoPais;

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    ]);

    $response = curl_exec($curl);

    curl_close($curl);

    $pais = json_decode($response, true);

    if (empty($pais)) {
        die('País não encontrado.');
    }

    $pais = $pais[0];
    ?>
    <h1><?= htmlspecialchars($pais['name']['common']); ?></h1>
    <p><strong>Continente:</strong> <?= htmlspecialchars($pais['region']); ?></p>
    <p><strong>População:</strong> <?= number_format($pais['population']); ?></p>
    <p><strong>Bandeira:</strong></p>
    <img src="<?= htmlspecialchars($pais['flags']['png']); ?>" alt="Bandeira de <?= htmlspecialchars($pais['name']['common']); ?>" style="width: 150px;">
    <br><br>
    <a href="index.php">Voltar para a lista de países</a>
</body>
</html>
