<!doctype html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <title>طباعة الإحصائيات</title>
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

    /* ✅ يمنع قلب الأرقام في RTL */
    .ltr-number{
      direction: ltr;
      unicode-bidi: bidi-override;
      display: inline-block;
      white-space: nowrap;
    }

    /* ✅ محاذاة عمود الأرقام */
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

<h2>تقرير الإحصائيات</h2>
<div class="meta">
  <div><b>الفترة:</b> من {{ $from }} إلى {{ $to }}</div>
  <div><b>Preset:</b> {{ $preset ?? '-' }}</div>
</div>

<div class="box">
  <h3>الملخص</h3>
  <div class="totals">
    <div class="totalCard">
      <div>إجمالي مدفوعات الأطفال</div>
      <b class="ltr-number">{{ number_format($childTotal,0,',',' ') }} DZD</b>
    </div>
    <div class="totalCard">
      <div>إجمالي الإيرادات</div>
      <b class="ltr-number">{{ number_format($revenuTotal,0,',',' ') }} DZD</b>
    </div>
    <div class="totalCard">
      <div>إجمالي المصاريف</div>
      <b class="ltr-number">{{ number_format($chargesTotal,0,',',' ') }} DZD</b>
    </div>
  </div>
</div>

<div class="box">
  <h3>مدفوعات الأطفال يوميًا</h3>
  <table>
    <thead>
      <tr>
        <th>التاريخ</th>
        <th class="num">المجموع (DZD)</th>
      </tr>
    </thead>
    <tbody>
      @forelse($childDaily as $r)
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
  <h3>تفاصيل مدفوعات الأطفال</h3>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>التاريخ</th>
        <th class="num">المدفوع</th>
        <th class="num">الإجمالي</th>
        <th class="num">الباقي</th>
        <th>ملاحظة</th>
      </tr>
    </thead>
    <tbody>
      @forelse($childPayments as $p)
        <tr>
          <td><span class="ltr-number">{{ $p->id }}</span></td>
          <td><span class="ltr-number">{{ \Carbon\Carbon::parse($p->date_paiement)->toDateString() }}</span></td>
          <td class="num"><span class="ltr-number">{{ number_format($p->payee,0,',',' ') }} DZD</span></td>
          <td class="num"><span class="ltr-number">{{ number_format($p->total,0,',',' ') }} DZD</span></td>
          <td class="num"><span class="ltr-number">{{ number_format($p->rest_pay,0,',',' ') }} DZD</span></td>
          <td>{{ $p->note }}</td>
        </tr>
      @empty
        <tr><td colspan="6" class="right">لا توجد مدفوعات</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

{{-- <div class="box">
  <h3>المصاريف مقابل الإيرادات يوميًا</h3>
  <table>
    <thead>
      <tr>
        <th>التاريخ</th>
        <th class="num">مصاريف</th>
        <th class="num">إيرادات</th>
      </tr>
    </thead>
    <tbody>
      @forelse($feesDaily as $f)
        <tr>
          <td><span class="ltr-number">{{ $f->d }}</span></td>
          <td class="num"><span class="ltr-number">{{ number_format($f->charges,0,',',' ') }} DZD</span></td>
          <td class="num"><span class="ltr-number">{{ number_format($f->revenu,0,',',' ') }} DZD</span></td>
        </tr>
      @empty
        <tr><td colspan="3" class="right">لا توجد بيانات</td></tr>
      @endforelse
    </tbody>
  </table>
</div> --}}

{{-- <div class="box">
  <h3>تفاصيل القيود المحاسبية</h3>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>التاريخ</th>
        <th>النوع</th>
        <th class="num">المبلغ</th>
        <th>المصدر</th>
        <th>ملاحظات</th>
      </tr>
    </thead>
    <tbody>
      @forelse($feesDetails as $e)
        <tr>
          <td><span class="ltr-number">{{ $e->id }}</span></td>
          <td><span class="ltr-number">{{ \Carbon\Carbon::parse($e->entry_date)->toDateString() }}</span></td>
          <td>{{ $e->type }}</td>
          <td class="num"><span class="ltr-number">{{ number_format($e->amount,0,',',' ') }} DZD</span></td>
          <td><span class="ltr-number">{{ $e->source_type }} #{{ $e->source_id }}</span></td>
          <td>{{ $e->notes }}</td>
        </tr>
      @empty
        <tr><td colspan="6" class="right">لا توجد قيود</td></tr>
      @endforelse
    </tbody>
  </table>
</div> --}}

<script>
  // إذا تحب يطبع مباشرة كي يفتح الصفحة:
  // window.onload = () => window.print();
</script>

</body>
</html>
