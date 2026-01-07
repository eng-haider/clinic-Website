# Patient Lookup System - Laravel Integration

## 📋 نظرة عامة

تم دمج نظام البحث عن المريض بنجاح في مشروع Laravel. النظام يوفر:

-   🔍 صفحة بحث عن المريض مع QR Scanner
-   📱 مولد QR Code للاختبار
-   🔌 API endpoint للاتصال بالنظام الخارجي
-   🎨 واجهة عربية كاملة مع دعم RTL

---

## 📁 الملفات التي تم إنشاؤها

### 1. Views (البلاديات)

```
resources/views/
├── patient-lookup.blade.php     # صفحة البحث الرئيسية
└── qr-generator.blade.php       # صفحة توليد QR codes
```

### 2. Controllers

```
app/Http/Controllers/
└── PatientLookupController.php  # Controller الرئيسي
```

### 3. Routes

تم إضافة Routes في `routes/web.php`:

-   `/patient-lookup` - صفحة البحث
-   `/qr-generator` - صفحة توليد QR
-   `/api/patient/lookup` - API endpoint

---

## 🚀 كيفية الاستخدام

### 1. تشغيل الخادم

```bash
cd laravel-clinic
php artisan serve
```

### 2. الوصول إلى الصفحات

**صفحة البحث:**

```
http://localhost:8000/patient-lookup
```

**مولد QR:**

```
http://localhost:8000/qr-generator
```

**بحث مباشر بالكود:**

```
http://localhost:8000/patient-lookup?code=PAT12345
```

---

## 🔧 الـ Routes المتوفرة

### Web Routes

```php
// Patient Lookup
Route::get('/patient-lookup', [PatientLookupController::class, 'index'])
    ->name('patient.lookup');

Route::get('/qr-generator', [PatientLookupController::class, 'qrGenerator'])
    ->name('qr.generator');

Route::post('/api/patient/lookup', [PatientLookupController::class, 'lookup'])
    ->name('api.patient.lookup');
```

### استخدام في Blade

```blade
{{-- رابط صفحة البحث --}}
<a href="{{ route('patient.lookup') }}">بحث عن مريض</a>

{{-- رابط مع كود --}}
<a href="{{ route('patient.lookup', ['code' => 'PAT12345']) }}">
    عرض بيانات المريض
</a>

{{-- رابط مولد QR --}}
<a href="{{ route('qr.generator') }}">توليد QR Code</a>
```

---

## 💻 استخدام الـ Controller

### PatientLookupController

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PatientLookupController extends Controller
{
    // عرض صفحة البحث
    public function index()
    {
        return view('patient-lookup');
    }

    // عرض صفحة توليد QR
    public function qrGenerator()
    {
        return view('qr-generator');
    }

    // البحث عن مريض من API خارجي
    public function lookup(Request $request)
    {
        $request->validate([
            'code' => 'required|string'
        ]);

        try {
            $response = Http::post('https://smartclinicv5.tctate.com/api/public/patient/lookup', [
                'code' => $request->code
            ]);

            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء جلب البيانات'
            ], 500);
        }
    }
}
```

---

## 🎨 المميزات

### ✅ صفحة البحث (patient-lookup.blade.php)

-   **بحث يدوي**: إدخال الكود مباشرة
-   **QR Scanner**: مسح QR Code باستخدام الكاميرا
-   **رابط مباشر**: دعم URL parameters (`?code=XXX`)
-   **عرض شامل للبيانات**:
    -   معلومات المريض الأساسية
    -   ملخص الفواتير
    -   الحالات الطبية
    -   الفواتير
    -   المواعيد
    -   الصور الطبية

### ✅ مولد QR (qr-generator.blade.php)

-   **توليد QR Code**: إنشاء QR تلقائياً
-   **نسخ الرابط**: نسخ رابط البحث للحافظة
-   **تنزيل QR**: حفظ صورة QR Code
-   **معاينة مباشرة**: عرض QR والرابط فوراً

---

## 🔌 التكامل مع نظامك

### 1. في Filament Admin Panel

أضف Action في Resource:

```php
use Filament\Actions;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

protected function getHeaderActions(): array
{
    return [
        Actions\Action::make('viewPatientLookup')
            ->label('عرض بيانات المريض')
            ->icon('heroicon-o-magnifying-glass')
            ->url(fn ($record) => route('patient.lookup', ['code' => $record->code]))
            ->openUrlInNewTab(),

        Actions\Action::make('generateQR')
            ->label('توليد QR Code')
            ->icon('heroicon-o-qr-code')
            ->url(fn ($record) => route('qr.generator') . '?code=' . $record->code)
            ->openUrlInNewTab(),
    ];
}
```

### 2. في Blade Templates

```blade
{{-- عرض رابط للبحث --}}
<a href="{{ route('patient.lookup', ['code' => $patient->code]) }}"
   class="btn btn-primary">
    <i class="ri-search-line"></i> عرض بيانات المريض
</a>

{{-- توليد QR Code مباشرة --}}
@php
    $qrUrl = route('patient.lookup', ['code' => $patient->code]);
@endphp

{!! QrCode::size(200)->generate($qrUrl) !!}
```

### 3. في API

إذا كنت تريد إنشاء API endpoint خاص بك:

```php
// routes/api.php
use App\Http\Controllers\Api\PatientApiController;

Route::post('/patient/lookup', [PatientApiController::class, 'lookup']);
```

```php
// app/Http/Controllers/Api/PatientApiController.php
public function lookup(Request $request)
{
    $patient = Patient::where('code', $request->code)
        ->with(['cases', 'bills', 'reservations', 'images'])
        ->first();

    if (!$patient) {
        return response()->json([
            'success' => false,
            'message' => 'Patient not found'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'patient' => $patient,
        // ... باقي البيانات
    ]);
}
```

---

## 📱 استخدام في الطباعة

### طباعة وصفة مع QR Code

```blade
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <title>وصفة طبية - {{ $patient->name }}</title>
    <style>
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="prescription">
        <h1>وصفة طبية</h1>

        <div class="patient-info">
            <p><strong>المريض:</strong> {{ $patient->name }}</p>
            <p><strong>التاريخ:</strong> {{ now()->format('Y-m-d') }}</p>
        </div>

        <div class="qr-section">
            <p>لعرض السجل الطبي الكامل، امسح هذا الكود:</p>
            @php
                $lookupUrl = route('patient.lookup', ['code' => $patient->code]);
            @endphp
            {!! QrCode::size(200)->generate($lookupUrl) !!}
        </div>
    </div>

    <button onclick="window.print()" class="no-print">طباعة</button>
</body>
</html>
```

---

## 🔐 الأمان

### CSRF Protection

جميع POST requests محمية بـ CSRF token:

```javascript
// في patient-lookup.blade.php
const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').content;

fetch(API_URL, {
    method: "POST",
    headers: {
        "X-CSRF-TOKEN": CSRF_TOKEN,
    },
    body: JSON.stringify({ code: code }),
});
```

### Validation

```php
// في Controller
$request->validate([
    'code' => 'required|string'
]);
```

---

## 🎨 التخصيص

### تغيير الألوان

في `patient-lookup.blade.php` أو `qr-generator.blade.php`:

```css
:root {
    --primary-color: #00d4ff;
    --secondary-color: #0066ff;
    --success-color: #28a745;
    --danger-color: #dc3545;
}
```

### تغيير API URL

في `PatientLookupController.php`:

```php
$response = Http::post('YOUR_API_URL_HERE', [
    'code' => $request->code
]);
```

---

## 🧪 الاختبار

### 1. اختبار البحث

```bash
# افتح المتصفح
http://localhost:8000/patient-lookup?code=TEST123
```

### 2. اختبار API

```bash
curl -X POST http://localhost:8000/api/patient/lookup \
  -H "Content-Type: application/json" \
  -H "X-CSRF-TOKEN: YOUR_TOKEN" \
  -d '{"code": "TEST123"}'
```

### 3. اختبار QR Generator

```bash
http://localhost:8000/qr-generator
```

---

## 📦 المتطلبات

### المكتبات المطلوبة

```bash
# لتوليد QR codes في Laravel
composer require simplesoftwareio/simple-qrcode
```

### CDN المستخدمة

-   Bootstrap 5.3 RTL
-   RemixIcon 3.5
-   html5-qrcode (للماسح الضوئي)
-   QRCode.js (لتوليد QR)
-   Cairo Font (خط عربي)

---

## 🐛 حل المشاكل

### المشكلة: CSRF Token Missing

**الحل:**

```blade
<meta name="csrf-token" content="{{ csrf_token() }}">
```

### المشكلة: الكاميرا لا تعمل

**الحل:**

-   استخدم HTTPS أو localhost
-   امنح إذن الكاميرا في المتصفح

### المشكلة: API لا يستجيب

**الحل:**

-   تحقق من أن الخادم الخارجي يعمل
-   تحقق من إعدادات CORS
-   افتح Developer Console للتحقق من الأخطاء

---

## 📚 الروابط السريعة

-   صفحة البحث: `/patient-lookup`
-   مولد QR: `/qr-generator`
-   API Endpoint: `/api/patient/lookup`

---

## ✅ Checklist للنشر

-   [ ] تحديث API URL في Controller
-   [ ] تفعيل HTTPS
-   [ ] اختبار QR Scanner على HTTPS
-   [ ] اختبار على أجهزة مختلفة
-   [ ] إضافة روابط في القائمة الرئيسية
-   [ ] اختبار مع بيانات حقيقية
-   [ ] إعداد CORS إذا لزم الأمر

---

## 🎉 الاستخدام الكامل

### سيناريو عملي:

1. **في لوحة التحكم**: عرض زر "توليد QR" لكل مريض
2. **عند الطباعة**: إضافة QR Code في أسفل الوصفة
3. **المريض**: يمسح QR Code بهاتفه
4. **النظام**: يفتح صفحة البحث تلقائياً
5. **العرض**: جميع بيانات المريض بشكل منظم

---

**تم التطوير بواسطة GitHub Copilot** 🤖  
**التاريخ**: January 3, 2026
