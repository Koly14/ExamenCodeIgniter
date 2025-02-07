<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        table {
            width: 100%;
            border-collapse: collapse; /* Une los bordes para evitar doble borde */
            border: 2px solid; /* Borde exterior de la tabla */
        }
        th, td {
            border: 1px solid; /* Bordes internos */
            padding: 8px;
        }
        th {
            background-color: #007bff;
            color: white;
        }

    </style>

</head>

<body>

    <div class="container text-center">
        <h2>FACTS</h2>

        <div class="d-flex justify-content-center">
            <table>
                <thead>
                    <tr>
                        <th>FACT ID</th>
                        <th>WONDER ID</th>
                        <th>FACT TEXT</th>
                        <th>EDIT</th>
                        <th>DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- FOREACH TABLE -->
                    <?php foreach($facts as $fact): ?>
                    <tr>
                        <td><?= $fact['fact_id']?></td>
                        <td><?= $fact['wonder_id']?></td>
                        <td><?= $fact['fact_text']?></td>
                        <td><button>EDIT</button></td>
                        <td><button>DELETE</button></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>