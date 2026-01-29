<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Liste des catégories</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 10px; }
        .creche-name { font-size: 18px; font-weight: bold; }
        .meta { margin: 10px 0 15px 0; }
        .meta-table { width: 100%; border-collapse: collapse; }
        .meta-table td { padding: 6px 8px; border: 1px solid #ddd; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; vertical-align: top; }
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
    <h3>Liste des catégories</h3>
</div>

{{-- INFOS --}}
<div class="meta">
    <table class="meta-table">
        <tr>
            <td><strong>Nombre total des catégories :</strong> {{ $total }}</td>
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
            <th>Type</th>
            <th>Note</th>
            <th>Active</th>
            <th>Créé par</th>

            <th>Créé le</th>
            <th>Modifié le</th>
        </tr>
    </thead>
    <tbody>
    @foreach($categories as $index => $cat)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $cat->name }}</td>
            <td>{{ $cat->type }}</td>
            <td>{{ $cat->note }}</td>
            <td style="text-align:center">{{ $cat->is_active ? 'Oui' : 'Non' }}</td>
            <td style="text-align:center">{{ $cat->creator->name }}</td>

            <td>{{ $cat->created_at ? \Carbon\Carbon::parse($cat->created_at)->format('d/m/Y H:i') : '' }}</td>
            <td>{{ $cat->updated_at ? \Carbon\Carbon::parse($cat->updated_at)->format('d/m/Y H:i') : '' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
