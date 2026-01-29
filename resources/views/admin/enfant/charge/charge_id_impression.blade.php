<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Bon de dépense</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color:#111; }
        .row { width: 100%; }
        .header { border-bottom: 2px solid #000; padding-bottom: 8px; margin-bottom: 12px; }
        .title { font-size: 18px; font-weight: bold; text-transform: uppercase; }
        .muted { color: #444; font-size: 11px; }
        .right { text-align: right; }
        .center { text-align: center; }
        .box { border: 1px solid #000; padding: 10px; border-radius: 2px; }
        table { width: 100%; border-collapse: collapse; }
        .info td { padding: 6px 8px; border: 1px solid #ddd; vertical-align: top; }
        .info .label { width: 28%; font-weight: bold; background: #f3f3f3; }
        .items th, .items td { border: 1px solid #000; padding: 8px; }
        .items th { background: #f3f3f3; }
        .total { margin-top: 10px; font-size: 16px; font-weight: bold; }
        .sign { margin-top: 18px; }
        .sign td { padding: 18px 10px; border: 1px solid #000; height: 70px; vertical-align: bottom; }
        .small { font-size: 10.5px; }
    </style>
</head>
<body>

{{-- HEADER --}}
<div class="header">
    <table class="row">
        <tr>
            <td>
                <div style="font-size:16px; font-weight:bold;">{{ $creche['name'] }}</div>
                <div class="muted">{{ $creche['address'] }}</div>
                <div class="muted">Tél: {{ $creche['phone1'] }} / {{ $creche['phone2'] }}</div>
            </td>
            <td class="right">
                <div class="title">Bon de dépense</div>
                <div class="muted"><strong>Réf:</strong> CH-{{ str_pad($charge->id, 6, '0', STR_PAD_LEFT) }}</div>
                <div class="muted"><strong>Date:</strong> {{ $charge->date_charge ? \Carbon\Carbon::parse($charge->date_charge)->format('d/m/Y') : date('d/m/Y') }}</div>
                <div class="muted"><strong>Mois:</strong> {{ ucfirst($mois) }} {{ $annee }}</div>
                <div class="muted"><strong>Année scolaire:</strong> {{ $anneeScolaire }}</div>
            </td>
        </tr>
    </table>
</div>

{{-- INFO BLOCK --}}
<div class="box">
    <table class="info">
        <tr>
            <td class="label">Titre / Objet</td>
            <td>{{ $charge->nom }}</td>
            <td class="label">Catégorie</td>
            <td>{{ $charge->category?->name ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Fournisseur</td>
            <td>{{ $charge->fournisseur?->nom_commercial ?? '-' }}</td>
            <td class="label">Créé par</td>
            <td>{{ $charge->creator?->name ?? $charge->created_by ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Note / Détail</td>
            <td colspan="3">{{ $charge->note ?? '-' }}</td>
        </tr>
    </table>
</div>

{{-- LIGNE DE FACTURATION --}}
<div style="margin-top: 12px;">
    <table class="items">
        <thead>
            <tr>
                <th style="width:6%;" class="center">#</th>
                <th>Description</th>
                <th style="width:20%;" class="right">Montant</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="center">1</td>
                <td>
                    <strong>{{ $charge->nom }}</strong><br>
                    <span class="small">
                        Catégorie: {{ $charge->category?->name ?? '-' }} —
                        Fournisseur: {{ $charge->fournisseur?->nom_commercial ?? '-' }}
                    </span>
                </td>
                <td class="right">{{ number_format($charge->montant, 2, ',', ' ') }} DA</td>
            </tr>
        </tbody>
    </table>

    <div class="total right">
        TOTAL À PAYER : {{ number_format($charge->montant, 2, ',', ' ') }} DA
    </div>
</div>

{{-- SIGNATURES --}}
<div class="sign">
    <table class="sign" style="width:100%; border-collapse:collapse;">
        <tr>
            <td class="center"><strong>Responsable</strong><br><span class="small">Signature & Cachet</span></td>
            <td class="center"><strong>Caissier(ère)</strong><br><span class="small">Signature</span></td>
            <td class="center"><strong>Fournisseur</strong><br><span class="small">Signature</span></td>
        </tr>
    </table>
</div>

<div class="center muted" style="margin-top:10px;">
    Document généré automatiquement — {{ $creche['name'] }}
</div>

</body>
</html>
