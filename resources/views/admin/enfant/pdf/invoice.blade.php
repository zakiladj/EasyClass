<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Reçu de paiement - {{ $receipt_id }}</title>
    <style>
        body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size:12px; }
        .header { width:100%; margin-bottom:20px; }
        .creche { float:right; text-align:right; }
        .client { float:left; text-align:left; }
        .clear { clear:both; }
        .title { text-align:center; font-size:20px; font-weight:bold; margin:20px 0; }
        table { width:100%; border-collapse: collapse; margin-top:10px; }
        th, td { border:1px solid #333; padding:8px; text-align:left; }
        th { background:#f0f0f0; }
        .right { text-align:right; }
        .no-border { border: none; }
        .totals { margin-top:10px; float:right; width:40%; }
        .signature { margin-top:80px; }
        .small { font-size:11px; color:#555; }
    </style>
</head>
<body>
    <div class="header">
        <div class="creche">
            <strong>{{ $creche['name'] }}</strong><br>
            {{ $creche['address'] }}<br>
            Tél: {{ $creche['phone1'] }} / {{ $creche['phone2'] }}
        </div>

        <div class="client">
            <strong>Client :</strong><br>
            {{ $client['nom'] }} {{ $client['prenom'] }}<br>
            {{ $client['address'] }}<br>
            Tél:{{ $client['phone']}}

        </div>
        <div class="clear"></div>
    </div>

    <div style="text-align:right;">
        <span class="small">Reçu N°: {{ $receipt_id }}</span><br>
        <span class="small">Date: {{ $date }}</span>
    </div>

    <div class="title">REÇU DE PAIEMENT</div>

    <table>
        <thead>
            <tr>
                <th style="width:8%;">ID</th>
                <th style="width:56%;">Description</th>
                <th style="width:12%;">Nombre</th>
                <th style="width:12%;">Prix unitaire (DA)</th>
                <th style="width:12%;">Montant (DA)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item['id'] }}</td>
                    <td>{{ $item['description'] }}</td>
                    <td class="right">{{ $item['quantity'] }}</td>
                    <td class="right">{{ number_format($item['unit_price'], 0, ',', ' ') }}</td>
                    <td class="right">{{ number_format($item['quantity'] * $item['unit_price'], 0, ',', ' ') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

<div class="totals">
    <table>

        {{-- ===========================
            CASE 1: لا remise ولا rest
            =========================== --}}
        @if($remise == 0 && $rest == 0)
            <tr>
                <td class="no-border">Total</td>
                <td class="right">{{ number_format($subtotal, 0, ',', ' ') }} DA</td>
            </tr>

        {{-- ===========================
            CASE 2: يوجد remise ولا rest
            =========================== --}}
        @elseif($remise > 0 && $rest == 0)
            <tr>
                <td class="no-border">Sous-total</td>
                <td class="right">{{ number_format($subtotal, 0, ',', ' ') }} DA</td>
            </tr>
            <tr>
                <td class="no-border">Remise</td>
                <td class="right">-{{ number_format($remise, 0, ',', ' ') }} DA</td>
            </tr>
            <tr>
                <th>Total</th>
                <th class="right">{{ number_format($total_after_remise, 0, ',', ' ') }} DA</th>
            </tr>

        {{-- ===========================
            CASE 3: لا remise ويوجد rest
            =========================== --}}
        @elseif($remise == 0 && $rest > 0)
            <tr>
                <td class="no-border">Total</td>
                <td class="right">{{ number_format($subtotal, 0, ',', ' ') }} DA</td>
            </tr>
            <tr>
                <td class="no-border">Payée</td>
                <td class="right">{{ number_format($payer, 0, ',', ' ') }} DA</td>
            </tr>
            <tr>
                <th>Rest à payer</th>
                <th class="right">{{ number_format($rest, 0, ',', ' ') }} DA</th>
            </tr>

        {{-- ===========================
            CASE 4: remise + rest
            =========================== --}}
        @elseif($remise > 0 && $rest > 0)
            <tr>
                <td class="no-border">Sous-total</td>
                <td class="right">{{ number_format($subtotal, 0, ',', ' ') }} DA</td>
            </tr>
            <tr>
                <td class="no-border">Remise</td>
                <td class="right">-{{ number_format($remise, 0, ',', ' ') }} DA</td>
            </tr>
            <tr>
                <td class="no-border">Payée</td>
                <td class="right">{{ number_format($payer, 0, ',', ' ') }} DA</td>
            </tr>
            <tr>
                <th>Rest à payer</th>
                <th class="right">{{ number_format($rest, 0, ',', ' ') }} DA</th>
            </tr>

        @endif

    </table>
</div>


    <div class="clear"></div>

    <div class="signature">
        <div style="float:left; width:50%;">
            <strong>Signature (Client)</strong>
            <div style="height:60px;"></div>
        </div>
        <div style="float:right; width:50%; text-align:right;">
            <strong>Signature (Crèche)</strong>
            <div style="height:60px;"></div>
        </div>
    </div>

    <div class="clear" style="margin-top:40px; text-align:center;">
        <span class="small">Merci pour votre paiement.</span>
    </div>
</body>
</html>
