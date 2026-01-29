<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body{ font-family: DejaVu Sans, sans-serif; line-height: 1.6; }
        .header{ text-align: center; }
        .title{ margin-top: 20px; font-size: 22px; font-weight: bold; text-decoration: underline; }
        .info{ margin-top: 30px; font-size: 16px; }
        .creche-info{ font-size: 13px; margin-top: 20px; }
        .footer{ margin-top: 60px; text-align: right; font-size: 14px; }
    </style>
</head>

<body>

    <!-- Infos Crèche -->
    <div class="header">
        <h2>{{ $crecheInfo['name'] }}</h2>
        <p>{{ $crecheInfo['address'] }}</p>
        <p>Tél : {{ $crecheInfo['phone1'] }} / {{ $crecheInfo['phone2'] }}</p>
        <p>Email : {{ $crecheInfo['email'] }}</p>
    </div>

    <div class="title"> <center>Attestation d’Inscription</center></div>

    <div class="info">
        <center>
            <p>Nous soussignés, {{ $crecheInfo['name'] }}, attestons que :</p>
            <h3><strong>{{ $enfant->nom }} {{ $enfant->prenom }}</strong></h3>
            <p>Né(e) le  <strong>{{ \Carbon\Carbon::parse($enfant->date_naissance)->format('d/m/Y') }} </strong>à {{ $enfant->lieu_naissance }}, est inscrit(e) dans notre crèche pour l'année scolaire {{ date('Y') }} - {{ date('Y')+1 }} </p>
            <p>Cette attestation est délivrée à la demande des parents pour servir et valoir ce que de droit.</p>
        </center>

    </div>

    <div class="footer">
        Fait à Sidi Bel Abbes, le {{ $enfant->created_at->format('d/m/Y') }} <br><br><br><br>
        ____________________________ <br>
        Signature et Cachet de la Crèche
    </div>

</body>
</html>
