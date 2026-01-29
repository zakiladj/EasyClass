<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            padding: 40px;
            font-size: 15px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 8px;
            margin-bottom: 30px;
        }
        .header strong {
            font-size: 18px;
        }
        .title {
            text-align: center;
            margin-top: 15px;
            margin-bottom: 35px;
            font-size: 22px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .content {
            line-height: 1.8;
            font-size: 16px;
        }
        .signature {
            margin-top: 60px;
            text-align: right;
        }
    </style>
</head>
<body>

<!-- ENTÊTE -->
<div class="header">
    <strong>{{ $creche['nom'] }}</strong><br>
    {{ $creche['adresse'] }}<br>
    Tél : {{ $creche['telephone_1'] }} / {{ $creche['telephone_2'] }}
</div>

<!-- TITRE -->
<div class="title">Attestation d'Inscription</div>

<!-- CONTENU -->
<div class="content">
    Nous soussignés, la direction de <strong>{{ $creche['nom'] }}</strong>,
    certifions que :

    <br><br>

    <strong>Nom & Prénom :</strong> {{ $eleve['nom'] }} {{ $eleve['prenom'] }}<br>
    <strong>Né(e) le :</strong> {{ \Carbon\Carbon::parse($eleve['date_naissance'])->format('d/m/Y') }}<br>
    <strong>Adresse :</strong> {{ $eleve['adresse'] }}<br>
    <strong>Section :</strong> {{ $eleve['section'] }}<br>
    <strong>Année scolaire :</strong> {{ $eleve['annee_scolaire'] }}<br>

    <br>
    La présente attestation est délivrée à la demande des parents pour servir
    et valoir ce que de droit.

    <br><br>
    Fait à Sidi Bel Abbès, le {{ $date_generation }}.
</div>

<div class="signature">
    La Direction<br><br><br>
    ___________________________
</div>

</body>
</html>
