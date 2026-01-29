<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Liste des employés</title>
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

@php
    use Milon\Barcode\Facades\DNS1D;
@endphp

{{-- EN-TÊTE --}}
<div class="header">
    <div class="creche-name">{{ $creche['name'] }}</div>
    <div class="small">{{ $creche['address'] }}</div>
    <div class="small">Tél: {{ $creche['phone1'] }} / {{ $creche['phone2'] }}</div>
    <hr>
    <h3>Liste des employés</h3>
</div>

{{-- INFOS --}}
<div class="meta">
    <table class="meta-table">
        <tr>
            <td><strong>Nombre total des employés :</strong> {{ $total }}</td>
            <td><strong>Date d’impression :</strong> {{ date('d/m/Y') }}</td>
            <td><strong>Année scolaire :</strong> {{ $anneeScolaire }}</td>
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
            <th>Téléphone</th>
            <th>Poste</th>
            <th>Salaire</th>
            <th>Date embauche</th>
            <th>Niveau</th>
            <th>Code barre</th>
        </tr>
    </thead>
    <tbody>
    @foreach($employes as $index => $employe)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $employe->nom }}</td>
            <td>{{ $employe->prenom }}</td>
            <td>{{ $employe->telephone }}</td>
            <td>{{ $employe->poste }}</td>
            <td>{{ $employe->salaire }}</td>
            <td>{{ $employe->date_embauche ? \Carbon\Carbon::parse($employe->date_embauche)->format('d/m/Y') : '' }}</td>
            <td>{{ $employe->niveau }}</td>
            <td>
                @php
                    $barcode = new \Milon\Barcode\DNS1D();
                @endphp

                @if($employe->code_barre)
                    <img
                        src="data:image/png;base64,{{ $barcode->getBarcodePNG($employe->code_barre, 'C128') }}"
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
