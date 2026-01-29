<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Liste des abonnements</title>
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
    <h3>Liste des abonnements</h3>
</div>

{{-- INFOS --}}
<div class="meta">
    <table class="meta-table">
        <tr>
            <td><strong>Nombre total des abonnements :</strong> {{ $total }}</td>
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
            <th>Titre</th>
            <th>Description</th>
            <th>Durée (jours)</th>
            <th>Prix</th>
            <th>Frais inscription</th>
            <th>Frais livres</th>
            <th>Type</th>
        </tr>
    </thead>
    <tbody>
    @foreach($abonnements as $index => $abonnement)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $abonnement->titre }}</td>
            <td>{{ $abonnement->description }}</td>
            <td style="text-align:center">{{ $abonnement->duree_jours }}</td>
            <td>{{ number_format($abonnement->prix, 2) }} DA</td>
            <td>{{ $abonnement->frais_inscription ? number_format($abonnement->frais_inscription, 2).' DA' : '-' }}</td>
            <td>{{ $abonnement->frais_livres ? number_format($abonnement->frais_livres, 2).' DA' : '-' }}</td>
            <td>{{ $abonnement->type }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
