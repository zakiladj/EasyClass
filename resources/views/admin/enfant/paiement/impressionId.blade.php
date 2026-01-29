    <!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Fiche de paiement</title>
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
        .right { text-align: right; }
    </style>
</head>
<body>

{{-- EN-TÊTE --}}
<div class="header">
    <div class="creche-name">{{ $creche['name'] }}</div>
    <div class="small">{{ $creche['address'] }}</div>
    <div class="small">Tél: {{ $creche['phone1'] }} / {{ $creche['phone2'] }}</div>
    <hr>
    <h3>Fiche de paiement employé</h3>
</div>

{{-- INFOS EMPLOYE + MOIS --}}
<div class="meta">
    <table class="meta-table">
        <tr>
            <td><strong>Employé :</strong> {{ $control->employes->nom ?? '' }} {{ $control->employes->prenom ?? '' }}</td>
            <td><strong>Poste :</strong> {{ $control->employes->poste ?? '' }}</td>
            <td><strong>Mois :</strong> {{ $monthName }} {{ $control->year }}</td>
        </tr>
        <tr>
            <td><strong>Date d’impression :</strong> {{ date('d/m/Y') }}</td>
            <td><strong>ID Control :</strong> {{ $control->id }}</td>
            <td><strong>Etat :</strong> {{ $control->etat == 1 ? 'Active' : 'Clôturé' }}</td>
        </tr>
    </table>
</div>

{{-- RESUME --}}
<div class="meta">
    <table class="meta-table">
        <tr>
            <td><strong>Salaire Net :</strong> {{ number_format($control->employes->salaire, 2) }} DA</td>
            <td><strong>Total payé :</strong> {{ number_format($control->paid_total, 2) }} DA</td>
            <td><strong>Reste :</strong> {{ number_format($control->rest, 2) }} DA</td>
        </tr>
        <tr>
            <td><strong>Avances :</strong> {{ number_format($control->advance_total, 2) }} DA</td>
            <td><strong>Primes :</strong> {{ number_format($control->bonus_total, 2) }} DA</td>
            <td><strong>Déductions :</strong> {{ number_format($control->deductions_total, 2) }} DA</td>
        </tr>
    </table>
</div>

{{-- TABLEAU DES OPERATIONS --}}
<h4>Historique des opérations</h4>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>Type</th>
            <th class="right">Montant (DA)</th>
            <th>Note</th>
        </tr>
    </thead>
    <tbody>
        @forelse($payments as $i => $p)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $p->payment_date ? \Carbon\Carbon::parse($p->payment_date)->format('d/m/Y') : '' }}</td>
                {{-- <td>{{ $p->type_action }}</td> --}}
                <td>{{ $types[$p->type_action] ?? $p->type_action }}</td>
                <td class="right">{{ number_format($p->amount, 2) }}</td>
                <td>{{ $p->note }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align:center;">Aucune opération.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<br>
<div class="right">
    <strong>Total opérations :</strong> {{ number_format($totalPayments, 2) }} DA
</div>

</body>
</html>
