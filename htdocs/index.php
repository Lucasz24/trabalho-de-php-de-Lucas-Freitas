<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Países</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <?php
    
    $url = 'https://restcountries.com/v3.1/all';

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    $paises = json_decode($response, true);
    ?>
    <h1>Lista de Países</h1>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Informações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($paises as $pais) : ?>
                <?php if (isset($pais['name']['common']) && isset($pais['cca2'])): ?>
                    <tr>
                        <td><?= htmlspecialchars($pais['name']['common']); ?></td>
                        <td><a href="pais.php?codigo=<?= htmlspecialchars($pais['cca2']); ?>">Informações</a></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
