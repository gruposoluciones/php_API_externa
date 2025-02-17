<?php
const API_URL = "https://whenisthenextmcufilm.com/api";

// Inicializar una nueva sesión de cURL
$ch = curl_init(API_URL);

// Configurar opciones de cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Ejecutar la petición y manejar errores
$result = curl_exec($ch);
if (curl_errno($ch)) {
    die("Error en la solicitud cURL: " . curl_error($ch));
}
curl_close($ch);

// Decodificar la respuesta JSON
$data = json_decode($result, true);

// Verificar si los datos son válidos
if (json_last_error() !== JSON_ERROR_NONE || !isset($data["title"])) {
    die("Error al decodificar la respuesta de la API o datos incompletos.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Spoiler</title>
    <meta name="description" content="Próxima película de MARVEL">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css">
    <style>
        :root {
            color-scheme: light dark;
        }

        body {
            display: grid;
            place-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 1rem;
        }

        img {
            display: block;
            margin: 0 auto;
            border-radius: 16px;
        }

        hgroup {
            text-align: center;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <main>
        <section>
            <img src="<?= htmlspecialchars($data["poster_url"]) ?>" width="300" alt="Poster de <?= htmlspecialchars($data["title"]) ?>">
        </section>

        <hgroup>
            <h3><?= htmlspecialchars($data["title"]) ?> ... SE ESTRENA EN:  <?= htmlspecialchars($data["days_until"]) ?> días!!!</h3>
            <p>Fecha de Estreno: <?= htmlspecialchars($data["release_date"]) ?></p>
            <p>Lo Podrás ver por: <?= htmlspecialchars($data["type"]) ?></p>
        </hgroup>
    </main>
</body>
</html>