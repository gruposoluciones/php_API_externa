<?php
const API_URL = "https://whenisthenextmcufilm.com/api";

// Función para obtener datos de la API
function fetchApiData($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);

    if (curl_errno($ch)) {
        curl_close($ch);
        die("Error en la solicitud cURL: " . curl_error($ch));
    }

    curl_close($ch);
    $data = json_decode($result, true);

    if (json_last_error() !== JSON_ERROR_NONE || !isset($data["title"])) {
        die("Error al decodificar la respuesta de la API o datos incompletos.");
    }

    return $data;
}

// Obtener datos de la API
$data = fetchApiData(API_URL);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Próxima Película de Marvel</title>
    <meta name="description" content="Próxima película de MARVEL">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: black; /* Fondo negro */
            color: white; /* Texto blanco para contraste */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 1rem; /* Espaciado interno para dispositivos pequeños */
            text-align: center;
            font-family: Arial, sans-serif; /* Fuente legible */
        }
        img {
            max-width: 90%; /* Imagen responsive con margen */
            height: auto;
            border-radius: 16px;
            margin-bottom: 1rem; /* Espaciado debajo de la imagen */
        }
        h3 {
            font-size: 1.5rem; /* Tamaño de texto adaptable */
            margin: 0.5rem 0;
        }
        p {
            font-size: 1rem; /* Tamaño de texto adaptable */
            margin: 0.5rem 0;
        }
        @media (min-width: 768px) {
            h3 {
                font-size: 2rem; /* Tamaño de texto más grande en tabletas */
            }
            p {
                font-size: 1.2rem; /* Tamaño de texto más grande en tabletas */
            }
            img {
                max-width: 70%; /* Imagen más grande en tabletas */
            }
        }
        @media (min-width: 1024px) {
            h3 {
                font-size: 2.5rem; /* Tamaño de texto más grande en computadoras */
            }
            p {
                font-size: 1.5rem; /* Tamaño de texto más grande en computadoras */
            }
            img {
                max-width: 50%; /* Imagen más grande en computadoras */
            }
        }
    </style>
</head>
<body>
    <main>
        <section>
            <img src="<?= htmlspecialchars($data["poster_url"]) ?>" alt="Poster de <?= htmlspecialchars($data["title"]) ?>">
        </section>

        <hgroup>
            <h3><?= htmlspecialchars($data["title"]) ?> ... SE ESTRENA EN: <?= htmlspecialchars($data["days_until"]) ?> DIAS!!!</h3>
            <p>Fecha de Estreno: <?= htmlspecialchars($data["release_date"]) ?></p>
            <p>Lo Podrás ver por: <?= htmlspecialchars($data["type"]) ?></p>
        </hgroup>
    </main>
</body>
</html>