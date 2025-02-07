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
        <h2>7 WONDERS</h2>

        <div class="d-flex justify-content-center">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>WONDER</th>
                        <th>LOCATION</th>
                        <th>IMAGE</th>
                        <th>EDIT</th>
                        <th>DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- FOREACH TABLE -->
                    <?php foreach($wonders as $wonder): ?>
                    <tr>
                        <td><?= $wonder['id']?></td>
                        <td><?= $wonder['wonder']?></td>
                        <td><?= $wonder['location']?></td>
                        <td><img width="150px" src="<?= base_url('assets/img/'.$wonder['imagen'])?>"></td>
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