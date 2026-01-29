<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: "DejaVu Sans", sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #555; padding: 8px; font-size: 13px; }
        th { background: #eee; }
        h2 { text-align: center; }
    </style>
</head>
<body>
        <div class="header">

        @if(isset($crecheInfo['logo']))
            <img src="{{ $crecheInfo['logo'] }}" alt="Logo" style="width:80px; margin-bottom:10px;">
        @endif

        <strong style="font-size: 18px;">{{ $crecheInfo['name'] }}</strong><br>
        {{ $crecheInfo['address'] }}<br>
        Téléphone : {{ $crecheInfo['phone1'] }} /{{ $crecheInfo['phone2'] }} <br>
        Email : {{ $crecheInfo['email'] }}
        </div>

    <h2>Informations de la Classe  {{ $classe->nom }}</h2>

    <table>
        <tr>
            <th>ID</th>
            <td>{{ $classe->id }}</td>
        </tr>
        <tr>
            <th>Nom de la classe</th>
            <td>{{ $classe->nom }}</td>
        </tr>
        <tr>
            <th>Niveau</th>
            <td>{{ $classe->niveau }}</td>
        </tr>
        <tr>
            <th>Capacité</th>
            <td>{{ $classe->capacite }}</td>
        </tr>
        <tr>
            <th>Places disponibles</th>
            <td>{{ $classe->place_disponible }}</td>
        </tr>
        <tr>
            <th>Enseignant</th>
            <td>{{ $classe->employe->nom }} {{ $classe->employe->prenom }} </td>
        </tr>
        <tr>
            <th>Année scolaire</th>
            <td>{{ $classe->annee }}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $classe->description }}</td>
        </tr>
        <tr>
            <th>Date de création</th>
            <td>{{ $classe->created_at }}</td>
        </tr>
        <tr>
            <th>Date de mise à jour</th>
            <td>{{ $classe->updated_at }}</td>
        </tr>
    </table>

</body>
</html>
