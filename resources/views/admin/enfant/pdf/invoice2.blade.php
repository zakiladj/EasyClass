<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Reçu de paiement - {{ $receipt_id }}</title>

    <style>
        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 13px;
            background: #ffffff;
            margin: 0;
            padding: 25px;
        }

        .header {
            width: 100%;
            margin-bottom: 30px;
            border-bottom: 3px solid #0056A6;
            padding-bottom: 10px;
        }

        .logo {
            float: left;
            width: 120px;
        }

        .creche-info {
            float: right;
            text-align: right;
            color: #0056A6;
            font-size: 14px;
            font-weight: bold;
        }

        .client-box {
            background: #F7F7F7;
            padding: 10px 15px;
            border-left: 4px solid #FF4FA2;
            margin-top: 20px;
            font-size: 13px;
        }

        .title {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            color: #0056A6;
            margin: 25px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background: #0056A6;
            color: white;
            padding: 8px;
            font-size: 13px;
        }

        td {
            border: 1px solid #ccc;
            padding: 7px;
        }

        .right { text-align: right; }

        .totals-table {
            width: 40%;
            float: right;
            margin-top: 20px;
        }

        .totals-table td {
            border: none !important;
            padding: 6px 0;
            font-size: 13px;
        }

        .totals-table th {
            background: none;
            color: #0056A6;
            font-size: 15px;
            border-top: 2px solid #0056A6;
        }

        .footer {
            margin-top: 80px;
            text-align: center;
            font-size: 12px;
            color: #555;
        }
        .client-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 20px;
        }
        .month-box {
            font-size: 13px;
            color: #0056A6;
            text-align: left;
            padding: 10px 0 0 15px;
        }
    </style>
</head>

<body>

    {{-- HEADER WITH LOGO --}}
    <div class="header">
        <img src="{{ public_path('upload/enfant/Ali.jpeg') }}" class="logo">

        <div class="creche-info">
            Crèche Ali wa Miriem <br>
            11 Rue Djouhel Boumedien – Sidi Bel Abbès <br>
            Tél: 0658718913 / 0659841210
        </div>

        <div style="clear: both;"></div>
    </div>

    {{-- RECEIPT NUMBER --}}
    <div style="text-align: right; color: #777;">
        Reçu N°: <strong>{{ $receipt_id }}</strong><br>
        Date: {{ $date }}
    </div>

            {{-- CLIENT INFO --}}
        <div class="client-row">
            <div class="client-box">
                <strong style="color:#0056A6;">Client :</strong><br>
                {{ $client['nom'] }} {{ $client['prenom'] }} <br>
                {{ $client['address'] }} <br>
                Tél: {{ $client['phone'] }}
            </div>

            <div class="month-box">
                <strong>Mois :</strong>
                {{ $client['abonnement_date'] }}
            </div>
        </div>

    {{-- TITLE --}}
    <div class="title">REÇU DE PAIEMENT</div>

    {{-- ITEMS TABLE --}}
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item['id'] }}</td>
                    <td>{{ $item['description'] }}</td>
                    <td class="right">{{ $item['quantity'] }}</td>
                    <td class="right">{{ number_format($item['unit_price'], 0, ',', ' ') }} DA</td>
                    <td class="right">{{ number_format($item['quantity'] * $item['unit_price'], 0, ',', ' ') }} DA</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- TOTALS SECTION WITH CONDITIONS --}}
    <table class="totals-table">

        {{-- CASE 1: aucun remise + aucun rest --}}
        @if($remise == 0 && $rest == 0)
            <tr>
                <th>Total :</th>
                <th class="right">{{ number_format($montant, 0, ',', ' ') }} DA</th>
            </tr>

        {{-- CASE 2: remise seulement --}}
        @elseif($remise > 0 && $rest == 0)
            <tr><td>Sous-total :</td><td class="right">{{ number_format($subtotal, 0, ',', ' ') }} DA</td></tr>
            <tr><td>Remise :</td><td class="right">-{{ number_format($remise, 0, ',', ' ') }} DA</td></tr>
            <tr><th>Total :</th><th class="right">{{ number_format($total_after_remise, 0, ',', ' ') }} DA</th></tr>

        {{-- CASE 3: paiement partiel sans remise --}}
        @elseif($remise == 0 && $rest > 0)
            <tr><td>Total :</td><td class="right">{{ number_format($montant, 0, ',', ' ') }} DA</td></tr>

            <tr><td>Payé :</td><td class="right">{{ number_format($payer, 0, ',', ' ') }} DA</td></tr>
            <tr><th>Rest à payer :</th><th class="right">{{ number_format($rest, 0, ',', ' ') }} DA</th></tr>

        {{-- CASE 4: remise + paiement partiel --}}
        @elseif($remise > 0 && $rest > 0)
            <tr><td>Sous-total :</td><td class="right">{{ number_format($subtotal, 0, ',', ' ') }} DA</td></tr>
            <tr><td>Remise :</td><td class="right">-{{ number_format($remise, 0, ',', ' ') }} DA</td></tr>
            <tr><td>Net à Payer :</td><td class="right"> <strong>{{ number_format($montant, 0, ',', ' ') }} DA</strong>  </td></tr>
            <tr><td>Payé :</td><td class="right">{{ number_format($payer, 0, ',', ' ') }} DA</td></tr>
            <tr><th>Rest à payer :</th><th class="right">{{ number_format($rest, 0, ',', ' ') }} DA</th></tr>
        @endif

    </table>

    <div style="clear: both;"></div>

    {{-- FOOTER --}}
    <div class="footer">
        Merci pour votre confiance.<br>
        <strong style="color: #FF4FA2;">Crèche Ali wa Miriem</strong>
    </div>

</body>
</html>
