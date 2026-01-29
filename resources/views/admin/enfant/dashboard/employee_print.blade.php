<!doctype html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <title>طباعة مدفوعات الموظفين</title>
  <style>
    body { font-family: Tahoma, Arial; margin: 20px; color:#111; }
    h2,h3 { margin: 0 0 10px; }
    .meta { margin-bottom: 15px; }
    .box { border:1px solid #ddd; padding:12px; margin:12px 0; border-radius:8px; }
    table { width:100%; border-collapse: collapse; margin-top:10px; }
    th, td { border:1px solid #ddd; padding:8px; font-size: 13px; }
    th { background:#f3f3f3; }
    .totals { display:flex; gap:10px; flex-wrap:wrap; }
    .totalCard { flex:1; min-width:220px; background:#fafafa; padding:10px; border:1px solid #eee; border-radius:8px; }
    .right { text-align:right; }

    /* يمنع قلب الأرقام في RTL */
    .ltr-number{
      direction: ltr;
      unicode-bidi: bidi-override;
      display: inline-block;
      white-space: nowrap;
    }

    /* محاذاة عمود الأرقام */
    td.num, th.num { text-align:right; }

    @media print {
      .no-print { display:none; }
      .page-break { page-break-before: always; }
    }
  </style>
</head>
<body>

<div class="no-print" style="margin-bottom:10px;">
  <button onclick="window.print()">🖨️ طباعة الآن</button>
</div>

<h2>تقرير مدفوعات الموظفين</h2>
<div class="meta">
  <div><b>الفترة:</b> من <span class="ltr-number">{{ $from }}</span> إلى <span class="ltr-number">{{ $to }}</span></div>
  <div><b>Preset:</b> {{ $preset ?? '-' }}</div>
</div>

<div class="box">
  <h3>الملخص</h3>
  <div class="totals">
    <div class="totalCard">
      <div>إجمالي مدفوعات الموظفين</div>
      <b class="ltr-number">{{ number_format($empTotal,0,',',' ') }} DZD</b>
    </div>
  </div>
</div>

<div class="box">
  <h3>مدفوعات الموظفين يوميًا</h3>
  <table>
    <thead>
      <tr>
        <th>التاريخ</th>
        <th class="num">المجموع (DZD)</th>
      </tr>
    </thead>
    <tbody>
      @forelse($empDaily as $r)
        <tr>
          <td><span class="ltr-number">{{ $r->d }}</span></td>
          <td class="num"><span class="ltr-number">{{ number_format($r->total,0,',',' ') }} DZD</span></td>
        </tr>
      @empty
        <tr><td colspan="2" class="right">لا توجد بيانات في هذه الفترة</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="box page-break">
  <h3>تفاصيل مدفوعات الموظفين</h3>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>الموظف</th>
        <th>نوع العملية</th>
        <th>التاريخ</th>
        <th class="num">المبلغ (DZD)</th>
        <th>ملاحظة</th>
      </tr>
    </thead>
    <tbody>
      @forelse($empPayments as $p)
        <tr>
          <td><span class="ltr-number">{{ $p->id }}</span></td>
          <td>
            <span class="ltr-number">{{ optional($p->employes)->nom }} {{ optional($p->employes)->prenom }}</span>
            {{-- إذا عندك join للاسم: {{ $p->employe_name }} --}}
          </td>
          <td>{{ $p->type_action }}</td>
          <td><span class="ltr-number">{{ \Carbon\Carbon::parse($p->payment_date)->toDateString() }}</span></td>
          <td class="num"><span class="ltr-number">{{ number_format($p->amount,0,',',' ') }} DZD</span></td>
          <td>{{ $p->note }}</td>
        </tr>
      @empty
        <tr><td colspan="6" class="right">لا توجد مدفوعات</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

</body>
</html>
