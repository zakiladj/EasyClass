<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Attestation de travail - {{ $attestation_no }}</title>
    <style>
        body{
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 12.5px;
            margin: 0;
            padding: 26px 30px;
            color: #111;
        }

        /* Corporate header */
        .topbar{
            width: 100%;
            border-bottom: 2px solid #0B3A6E;
            padding-bottom: 10px;
            margin-bottom: 18px;
        }
        .brand-left{ float:left; width: 55%; }
        .brand-right{ float:right; width: 45%; text-align:right; }

        .company{
            font-size: 16px;
            font-weight: 800;
            color: #0B3A6E;
            letter-spacing: 0.2px;
        }
        .company-sub{
            margin-top: 4px;
            line-height: 1.4;
            color:#444;
        }
        .refbox{
            margin-top: 2px;
            font-size: 12px;
            color:#333;
            line-height: 1.5;
        }
        .refbox strong{ color:#0B3A6E; }

        .clear{ clear: both; }

        /* Title block */
        .title-wrap{
            margin: 18px 0 12px;
            text-align: center;
        }
        .title{
            font-size: 22px;
            font-weight: 900;
            color:#0B3A6E;
            letter-spacing: 1px;
        }
        .subtitle{
            margin-top: 6px;
            font-size: 12px;
            color:#555;
        }

        /* Object / Intro */
        .object{
            border-left: 4px solid #0B3A6E;
            padding: 10px 12px;
            background: #F5F8FC;
            margin: 14px 0 16px;
        }
        .object .label{
            font-weight: 800;
            color:#0B3A6E;
        }

        /* Employee card */
        .card{
            border: 1px solid #E5E7EB;
            padding: 12px 14px;
            margin-top: 8px;
        }
        table{
            width: 100%;
            border-collapse: collapse;
        }
        .info td{
            border: 1px solid #E5E7EB;
            padding: 8px 10px;
            vertical-align: top;
        }
        .info td.k{
            width: 32%;
            background: #FBFCFE;
            color:#0B3A6E;
            font-weight: 700;
        }

        .para{
            margin-top: 12px;
            line-height: 1.75;
            text-align: justify;
        }

        /* Signature / Stamp */
        .sign-area{
            margin-top: 26px;
            width: 100%;
        }
        .sign-left{
            float:left;
            width: 48%;
            font-size: 12px;
            color:#333;
        }
        .sign-right{
            float:right;
            width: 48%;
            text-align: center;
        }
        .box-stamp{
            margin-top: 10px;
            height: 95px;
            border: 1px dashed #9AA4B2;
            color:#6B7280;
            font-size: 11px;
            line-height: 95px;
        }
        .sig-line{
            margin-top: 18px;
            border-top: 1px solid #111;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }

        /* Footer */
        .footer{
            margin-top: 55px;
            border-top: 1px solid #E5E7EB;
            padding-top: 10px;
            text-align: center;
            font-size: 11px;
            color:#666;
        }
    </style>
</head>
<body>

    <div class="topbar">
        <div class="brand-left">
            <div class="company">{{ $crecheInfo['name'] }}</div>
            <div class="company-sub">
                {{ $crecheInfo['address'] }}<br>
                Tél: {{ $crecheInfo['phone1'] }} / {{ $crecheInfo['phone2'] }}  <br> Email: {{ $crecheInfo['email'] }}
            </div>
        </div>

        <div class="brand-right">
            <div class="refbox">
                Référence : <strong>{{ $attestation_no }}</strong><br>
                Date : {{ $date }}<br>
                Ville : Sidi Bel Abbès
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <div class="title-wrap">
        <div class="title">ATTESTATION DE TRAVAIL</div>
        <div class="subtitle">Document officiel — Ressources Humaines</div>
    </div>

    <div class="object">
        <span class="label">Objet :</span>
        Attestation de travail de M./Mme <strong>{{ $employe->nom }} {{ $employe->prenom }}</strong>
    </div>

    <div class="card">
        <table class="info">
            <tr>
                <td class="k">Nom & Prénom</td>
                <td>{{ $employe->nom }} {{ $employe->prenom }}</td>
            </tr>
            <tr>
                <td class="k">Poste</td>
                <td>{{ $employe->poste }}</td>
            </tr>
            <tr>
                <td class="k">Date d'embauche</td>
                <td>{{ $employe->date_embauche ? \Carbon\Carbon::parse($employe->date_embauche)->format('d/m/Y') : '-' }}</td>
            </tr>
            <tr>
                <td class="k">Adresse</td>
                <td>{{ $employe->address ?? '-' }}</td>
            </tr>
            <tr>
                <td class="k">Téléphone</td>
                <td>
                    {{ $employe->telephone ?? '-' }}
                    @if(!empty($employe->telephone2))
                        / {{ $employe->telephone2 }}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="k">Email</td>
                <td>{{ $employe->email ?? '-' }}</td>
            </tr>
            <tr>
                <td class="k">Niveau</td>
                <td>{{ $employe->niveau ?? '-' }}</td>
            </tr>



        </table>

        <p class="para">
            Je soussigné(e), la Direction de <strong>{{ $crecheInfo['name'] }}</strong>, certifie que la personne susmentionnée
            est employée au sein de notre établissement et exerce ses fonctions à ce jour.
            La présente attestation est délivrée à l’intéressé(e) pour servir et valoir ce que de droit.
        </p>
    </div>

    <div class="sign-area">
        <div class="sign-left">
            <strong>Observations :</strong><br>
            Document établi sur demande de l’intéressé(e).<br>
            Toute rature ou modification rend ce document invalide.
        </div>

        <div class="sign-right">
            <strong>Signature & Cachet</strong>
            <div class="box-stamp">Emplacement cachet</div>
            <div class="sig-line"></div>
            <div style="margin-top:6px;font-size:11px;color:#444;">La Direction</div>
        </div>
        <div class="clear"></div>
    </div>

    <div class="footer">
        {{ $crecheInfo['name'] }} — {{ $crecheInfo['address'] }} — Tél: {{ $crecheInfo['phone1'] }}
    </div>

</body>
</html>
