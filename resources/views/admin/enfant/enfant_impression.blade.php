<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Liste des enfants</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 10px; }
        .creche-name { font-size: 18px; font-weight: bold; }
        .meta { margin: 10px 0 15px 0; }
        .meta-table { width: 100%; border-collapse: collapse; }
        .meta-table td { padding: 6px 8px; border: 1px solid #ddd; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #f2f2f2; }
        .small { font-size: 11px; }
    </style>
</head>
<body>

    {{-- EN-TÊTE --}}
    <div class="header">
        <div class="creche-name">{{ $creche['name'] }}</div>
        <div class="small">{{ $creche['address'] }}</div>
        <div class="small">Tél: {{ $creche['phone1'] }} / {{ $creche['phone2'] }}</div>
        <hr>
        <h3>Liste des enfants</h3>
    </div>

    {{-- INFOS (Année scolaire + Total) --}}
    <div class="meta">
        <table class="meta-table">
            <tr>
                <td><strong>Année scolaire :</strong> {{ $anneeScolaire }}</td>
                <td><strong>Nombre total d’enfants :</strong> {{ $total }}</td>
                <td><strong>Date d’impression :</strong> {{ date('d/m/Y') }}</td>
            </tr>
        </table>
    </div>

    {{-- TABLEAU --}}
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date naissance</th>
                <th>Sexe</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Date inscription</th>
                <th>Statut</th>
                <th>Code barre</th>
            </tr>
        </thead>
        <tbody>
        @foreach($enfants as $index => $enfant)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $enfant->nom }}</td>
                <td>{{ $enfant->prenom }}</td>
                <td>{{ $enfant->date_naissance ? \Carbon\Carbon::parse($enfant->date_naissance)->format('d/m/Y') : '' }}</td>
                <td>{{ $enfant->sexe }}</td>
                <td>{{ $enfant->telephone }}</td>
                <td>{{ $enfant->adresse }}</td>
                <td>{{ $enfant->date_inscription ? \Carbon\Carbon::parse($enfant->date_inscription)->format('d/m/Y') : '' }}</td>
                <td>{{ $enfant->allergies }}</td>
                <td style="text-align:center">
                    @if($enfant->codebarre)
                        <img
                            src="data:image/png;base64,{{ DNS1D::getBarcodePNG($enfant->codebarre, 'C128') }}"
                            alt="barcode"
                            width="120"
                            height="40"
                        >
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</body>
</html>
