<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
/* لتمركز البطاقة في وسط الصفحة */
       html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            background: white;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f5f5f5; /* اختياري */

        }
        .card-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        /* 🟦 Logo */
        .logo {
            width: 45px;
            position: absolute;
            top: 10px;
            left: 10px;
        }
        /* 🟦 جسم البطاقة */
        .card {
            width: 242.65pt;    /* نفس عرض صفحة PDF */
            height: 153.06pt;   /* نفس ارتفاع صفحة PDF */
            border: 2px solid #004F9E;
            padding: 5px;
            border-radius: 8px;
            position: relative;
            background: white;
            box-sizing: border-box;

             /* font-family: 'DejaVu Sans', sans-serif; */
        }
        /* 🟪 العنوان الرئيسي */
        .header-title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #004F9E; /* أزرق */
        }
        .header-subtitle {
            text-align: center;
            font-size: 11px;
            font-weight: bold;
            margin-top: 2px;
            margin-bottom: 5px;
            color: #FF4FA3; /* وردي */
        }
        hr {
            border: none;
            height: 2px;
            background: #FF4FA3; /* وردي */
            margin-top: 5px;
            margin-bottom: 10px;
        }
        /* 🟦 معلومات الطفل */
        .info {
            width: 60%;
            float: left;
            font-size: 12px;
            line-height: 1.3;
            color: #004F9E;
            font-weight: bold;
        }
        /* 🟪 صورة الطفل */
        .child-photo {
            width: 40%;
            float: right;
            text-align: center;
        }
        .child-photo img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #FF4FA3; /* وردي */
        }
        /* 🟦 كود الطفل */
        .code-enfant {
            position: absolute;
            bottom: 50px;
            left: 10px;
            font-size: 11px;
            font-weight: bold;
            color: #004F9E;
        }
        /* 🟪 الباركود */
        .barcode {
            position: absolute;
            bottom: 10px;
            left: 10px;
        }

        .clearfix {
            clear: both;
        }
/* خلفية البطاقة */
        .back-card {
            width: 242.65pt;
            height: 153.06pt;
            border: 2px solid #004F9E;
            border-radius: 8px;
            background: white;
            position: relative;
            box-sizing: border-box;
            padding: 0; /* مهم جدًا */
            /* font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif */
             /* font-family: 'DejaVu Sans', sans-serif; */
        }
        /* الشعار */
        .back-logo {
            width: 130px;
            position: absolute;
            top: 10pt;
            left: 50%;
            transform: translateX(-50%);
        }
        /* البريد الإلكتروني في الوسط */
        .back-email {
            position: absolute;
            bottom: 35pt;
            width: 100%;
            text-align: center;
            font-size: 10px;
            font-weight: bold;
            color: #FF4FA3; /* وردي */
        }
        /* العنوان أسفل اليسار */
        .back-address {
            position: absolute;
            bottom: 10pt;
            left: 10pt;
            width: 55%;
            font-size: 10px;
            line-height: 1.2;
            color: #004F9E;
        }
        /* الهواتف أسفل اليمين */
        .back-phones {
            position: absolute;
            bottom: 10pt;
            right: 10pt;
            width: 40%;
            text-align: right;
            font-size: 10px;
            line-height: 1.2;
            color: #004F9E;
        }
    </style>
</head>

<body>
    <div class="card">

        <!-- Logo -->
        <img src="{{ public_path('upload/enfant/Ali.jpeg') }}" class="logo">

        <!-- Titre -->
        <div class="header-title">
            Crèche Ali Wa Meriem
        </div>

         <br>

        <hr>

        <!-- Infos -->
        <div class="card-row">
            <div class="info">
                <strong>Nom :</strong> {{ $enfant->nom }} <br>
                <strong>Prénom :</strong> {{ $enfant->prenom }} <br>
                <strong>Date naissance :</strong> {{ $enfant->date_naissance }} <br>
                <strong>Téléphone :</strong> {{ $enfant->telephone }} <br>
                <strong>Année Scolaire :</strong>
                {{ \Carbon\Carbon::parse($enfant->created_at)->format('Y') }} -
                {{ \Carbon\Carbon::parse($enfant->created_at)->addYear()->format('Y') }}
            </div>

            <div class="child-photo">
                <img src="{{ public_path('upload/enfant/' . $enfant->image) }}" alt="Photo Enfant">
            </div>
        </div>

        <!-- Photo Enfant -->


        <div class="clearfix"></div>

        <!-- Code Enfant -->
        <div class="code-enfant">
            Code Enfant :
        </div>

        <!-- Barcode -->
        <div class="barcode">
            {!! DNS1D::getBarcodeHTML($enfant->codebarre, 'C128', 1.2, 40) !!}
        </div>
 <div class="back-card">
    <!-- الشعار -->
    <img src="{{ public_path('upload/enfant/Ali.jpeg') }}" class="back-logo">
    <!-- البريد الإلكتروني -->
    {{-- <div class="back-email">
        <strong>{{ $crecheInfo['email'] }}</strong>
    </div> --}}
    <!-- العنوان -->
    <div class="back-address">
       <strong>{{ $crecheInfo['address'] }}</strong>
    </div>
    <!-- الهواتف -->
    <div class="back-phones">
        {{ $crecheInfo['phone1'] }} <br>
        {{ $crecheInfo['phone2'] }}
    </div>

</div>
    </div>
</body>
</html>
