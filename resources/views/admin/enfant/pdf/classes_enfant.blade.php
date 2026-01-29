<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: "DejaVu Sans", sans-serif; }

        .header {
            text-align: center;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        h2, h3 {
            text-align: center;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #444;
            padding: 8px;
            font-size: 12px;
        }

        th {
            background: #eee;
        }

        .line {
            height: 2px;
            width: 100%;
            background: #000;
            margin: 10px 0;
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <div class="header">
        <strong style="font-size: 18px;">{{ $crecheInfo['name'] }}</strong><br>
        {{ $crecheInfo['address'] }}<br>
        Téléphone : {{ $crecheInfo['phone1'] }} / {{ $crecheInfo['phone2'] }}<br>
        Email : {{ $crecheInfo['email'] }}
    </div>

    <div class="line"></div>

    {{-- Informations de la Classe --}}
    <h2>Informations de la Classe</h2>

    <table>
        <tr>
            <th>Nom de la classe</th>
            <td>{{ $class->nom }}</td>
        </tr>
        <tr>
            <th>Niveau</th>
            <td>{{ $class->niveau }}</td>
        </tr>
        <tr>
            <th>Educatrice</th>
            <td>{{ $class->employe->nom }} {{ $class->employe->prenom }}</td>
        </tr>
        <tr>
            <th>Capacité</th>
            <td>{{ $class->capacite }}</td>
        </tr>
        <tr>
            <th>Places disponibles</th>
            <td>{{ $class->place_disponible }}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $class->description }}</td>
        </tr>
    </table>

    <h3>Liste des Enfants</h3>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom & Prénom</th>
                <th>Date de naissance</th>
                <th>Allergies</th>
                <th>Téléphone</th>
            </tr>
        </thead>

        <tbody>
            @foreach($enfants as $e)
                <tr>
                    <td>{{ $e->id }}</td>
                    <td>{{ $e->nom }} {{ $e->prenom }}</td>
                    <td>{{ $e->date_naissance }}</td>
                    <td>{{ $e->allergies }}</td>
                    <td>{{ $e->telephone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
