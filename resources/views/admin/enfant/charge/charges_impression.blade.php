<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Liste des charges</title>
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
        .right { text-align: right; }
        .center { text-align: center; }
        tfoot td {
            font-size: 16px;
            font-weight: bold;
            background-color: #f5f5f5;
            padding-top: 10px;
        }
    </style>
</head>
<body>

{{-- EN-TÊTE --}}
<div class="header">
    <div class="creche-name">{{ $creche['name'] }}</div>
    <div class="small">{{ $creche['address'] }}</div>
    <div class="small">Tél: {{ $creche['phone1'] }} / {{ $creche['phone2'] }}</div>
    <hr>
    <h3>Liste des charges</h3>
</div>

{{-- INFOS --}}
<div class="meta">
    <table class="meta-table">
        <tr>
            <td><strong>Année scolaire :</strong> {{ $anneeScolaire }}</td>
            <td><strong>Mois :</strong> {{ ucfirst($mois) }} {{ $annee }}</td>
            <td><strong>Date d’impression :</strong> {{ date('d/m/Y') }}</td>
        </tr>
        <tr>
            <td colspan="3" class="right">
                <strong>Somme totale des charges :</strong>
                {{ number_format($somme, 2, ',', ' ') }} DA
            </td>
        </tr>
    </table>
</div>

{{-- TABLEAU --}}
<table>
    <thead>
        <tr>
            <th class="center">#</th>
            <th>Nom</th>
            <th>Catégorie</th>
            <th class="right">Montant</th>
            <th class="center">Date</th>
            <th>Fournisseur</th>
            <th>Note</th>
            <th class="center">Pièce</th>
        </tr>
    </thead>

    <tbody>
    @foreach($charges as $index => $charge)
        <tr>
            <td class="center">{{ $index + 1 }}</td>
            <td>{{ $charge->nom }}</td>
            <td>{{ $charge->category?->name ?? '-' }}</td>
            <td class="right">{{ number_format($charge->montant, 2, ',', ' ') }} DA</td>
            <td class="center">
                {{ $charge->date_charge ? \Carbon\Carbon::parse($charge->date_charge)->format('d/m/Y') : '' }}
            </td>
            <td>{{ $charge->fournisseur?->nom_commercial ?? '-' }}</td>
            <td>{{ $charge->note ?? '-' }}</td>
            <td class="center">{{ $charge->attachment ? 'Oui' : 'Non' }}</td>
        </tr>
    @endforeach
    </tbody>

    {{-- TOTAL DU MOIS --}}
    <tfoot>
        <tr>
            <td colspan="8" class="right">
                TOTAL DES CHARGES – {{ Str::upper($mois) }} {{ $annee }} :
                <span class="text-danger">{{ number_format($somme, 2, ',', ' ') }} DA</span>
            </td>
        </tr>
    </tfoot>
</table>

</body>
</html>
