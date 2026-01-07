# Laravel Integration - Patient QR Code System

## إضافة مكتبة QR Code إلى Laravel

### 1. تثبيت المكتبة

```bash
composer require simplesoftwareio/simple-qrcode
```

### 2. إنشاء Controller للوصفات الطبية

قم بإنشاء `app/Http/Controllers/PrescriptionController.php`:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Patient;

class PrescriptionController extends Controller
{
    /**
     * عرض الوصفة الطبية مع QR Code
     */
    public function show($patientId)
    {
        $patient = Patient::findOrFail($patientId);

        // توليد رابط البحث عن المريض
        $lookupUrl = config('app.url') . '/patient-lookup.html?code=' . $patient->code;

        // توليد QR Code
        $qrCode = QrCode::size(200)
            ->format('png')
            ->generate($lookupUrl);

        return view('prescriptions.show', [
            'patient' => $patient,
            'qrCode' => base64_encode($qrCode),
            'lookupUrl' => $lookupUrl
        ]);
    }

    /**
     * طباعة الوصفة الطبية
     */
    public function print($patientId)
    {
        $patient = Patient::findOrFail($patientId);
        $lookupUrl = config('app.url') . '/patient-lookup.html?code=' . $patient->code;

        $qrCode = QrCode::size(200)
            ->format('png')
            ->generate($lookupUrl);

        return view('prescriptions.print', [
            'patient' => $patient,
            'qrCode' => base64_encode($qrCode),
            'lookupUrl' => $lookupUrl
        ]);
    }

    /**
     * تنزيل QR Code كصورة
     */
    public function downloadQrCode($patientId)
    {
        $patient = Patient::findOrFail($patientId);
        $lookupUrl = config('app.url') . '/patient-lookup.html?code=' . $patient->code;

        $qrCode = QrCode::size(300)
            ->format('png')
            ->generate($lookupUrl);

        return response($qrCode)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="patient-' . $patient->code . '-qr.png"');
    }
}
```

### 3. إضافة Routes

في `routes/web.php`:

```php
use App\Http\Controllers\PrescriptionController;

Route::prefix('prescriptions')->group(function () {
    Route::get('/{patient}/show', [PrescriptionController::class, 'show'])
        ->name('prescriptions.show');

    Route::get('/{patient}/print', [PrescriptionController::class, 'print'])
        ->name('prescriptions.print');

    Route::get('/{patient}/qr-code', [PrescriptionController::class, 'downloadQrCode'])
        ->name('prescriptions.qr-code');
});
```

### 4. إنشاء View للوصفة الطبية

`resources/views/prescriptions/show.blade.php`:

```blade
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>وصفة طبية - {{ $patient->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
        }
        .prescription-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 30px;
            border: 2px solid #0066ff;
            border-radius: 15px;
        }
        .prescription-header {
            text-align: center;
            border-bottom: 3px solid #0066ff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .qr-section {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            margin-top: 30px;
        }
        .patient-info {
            background: #e7f3ff;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="prescription-container">
            <!-- Header -->
            <div class="prescription-header">
                <h1>وصفة طبية</h1>
                <h3>Smart Clinic</h3>
                <p>العنوان | الهاتف | البريد الإلكتروني</p>
            </div>

            <!-- Patient Info -->
            <div class="patient-info">
                <h4>معلومات المريض</h4>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>الاسم:</strong> {{ $patient->name }}</p>
                        <p><strong>العمر:</strong> {{ $patient->age }} سنة</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>الهاتف:</strong> {{ $patient->phone }}</p>
                        <p><strong>التاريخ:</strong> {{ now()->format('Y-m-d') }}</p>
                    </div>
                </div>
            </div>

            <!-- Prescription Content -->
            <div class="prescription-content">
                <h5>العلاج الموصوف:</h5>
                <!-- Add prescription details here -->
            </div>

            <!-- QR Code Section -->
            <div class="qr-section">
                <h5>لعرض السجل الطبي الكامل</h5>
                <p>قم بمسح الكود التالي:</p>
                <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code">
                <p class="mt-2">
                    <small>أو استخدم الرابط:</small><br>
                    <a href="{{ $lookupUrl }}" target="_blank">{{ $lookupUrl }}</a>
                </p>
            </div>

            <!-- Print Button -->
            <div class="text-center mt-4 no-print">
                <button onclick="window.print()" class="btn btn-primary btn-lg">
                    طباعة الوصفة
                </button>
                <a href="{{ route('prescriptions.qr-code', $patient->id) }}"
                   class="btn btn-success btn-lg"
                   download>
                    تنزيل QR Code
                </a>
            </div>
        </div>
    </div>
</body>
</html>
```

### 5. إنشاء View للطباعة

`resources/views/prescriptions/print.blade.php`:

```blade
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طباعة وصفة - {{ $patient->name }}</title>
    <style>
        @page {
            size: A4;
            margin: 20mm;
        }
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
        }
        .prescription-container {
            border: 2px solid #000;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .qr-code {
            text-align: center;
            margin-top: 30px;
            padding: 15px;
            border: 1px dashed #000;
        }
        .patient-info {
            margin-bottom: 20px;
            padding: 15px;
            background: #f0f0f0;
        }
    </style>
</head>
<body onload="window.print(); window.close();">
    <div class="prescription-container">
        <div class="header">
            <h1>وصفة طبية</h1>
            <h2>Smart Clinic</h2>
        </div>

        <div class="patient-info">
            <p><strong>اسم المريض:</strong> {{ $patient->name }}</p>
            <p><strong>العمر:</strong> {{ $patient->age }} سنة</p>
            <p><strong>التاريخ:</strong> {{ now()->format('Y-m-d') }}</p>
        </div>

        <div class="prescription-content">
            <!-- Add prescription content here -->
        </div>

        <div class="qr-code">
            <p><strong>للوصول إلى السجل الطبي الكامل</strong></p>
            <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code" width="200">
            <p style="font-size: 12px; margin-top: 10px;">
                امسح الكود أو زر: {{ $lookupUrl }}
            </p>
        </div>
    </div>
</body>
</html>
```

## استخدام في Filament Admin Panel

إذا كنت تستخدم Filament، يمكنك إضافة Action للمريض:

```php
<?php

namespace App\Filament\Resources\PatientResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ViewPatient extends ViewRecord
{
    protected static string $resource = PatientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('generateQrCode')
                ->label('عرض QR Code')
                ->icon('heroicon-o-qr-code')
                ->modalContent(function ($record) {
                    $lookupUrl = config('app.url') . '/patient-lookup.html?code=' . $record->code;
                    $qrCode = QrCode::size(300)->generate($lookupUrl);

                    return view('filament.components.qr-modal', [
                        'qrCode' => base64_encode($qrCode),
                        'url' => $lookupUrl
                    ]);
                })
                ->modalWidth('md'),

            Actions\Action::make('printPrescription')
                ->label('طباعة وصفة')
                ->icon('heroicon-o-printer')
                ->url(fn ($record) => route('prescriptions.print', $record))
                ->openUrlInNewTab(),
        ];
    }
}
```

## Configuration

أضف في `config/app.php` أو `.env`:

```env
APP_URL=https://your-domain.com
PATIENT_LOOKUP_URL=https://your-domain.com/patient-lookup.html
```

## API Endpoint للبحث

تأكد من وجود API endpoint في `routes/api.php`:

```php
use App\Http\Controllers\Api\PatientLookupController;

Route::prefix('public')->group(function () {
    Route::post('patient/lookup', [PatientLookupController::class, 'lookup']);
});
```

ملف Controller: `app/Http/Controllers/Api/PatientLookupController.php`:

```php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;

class PatientLookupController extends Controller
{
    public function lookup(Request $request)
    {
        $request->validate([
            'code' => 'required|string'
        ]);

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
            'doctor' => $patient->doctor,
            'cases' => $patient->cases,
            'bills' => $patient->bills,
            'bills_summary' => [
                'total_bills' => $patient->bills->sum('price'),
                'paid_bills' => $patient->bills->where('is_paid', 1)->sum('price'),
                'unpaid_bills' => $patient->bills->where('is_paid', 0)->sum('price'),
                'bills_count' => $patient->bills->count(),
                'paid_count' => $patient->bills->where('is_paid', 1)->count(),
                'unpaid_count' => $patient->bills->where('is_paid', 0)->count(),
            ],
            'images' => $patient->images,
            'reservations' => $patient->reservations,
            'cases_count' => $patient->cases->count(),
            'reservations_count' => $patient->reservations->count(),
        ]);
    }
}
```

## ملاحظات مهمة

1. تأكد من إضافة حقل `code` في جدول patients إذا لم يكن موجوداً
2. استخدم middleware للحماية إذا لزم الأمر
3. تأكد من ضبط CORS للسماح بالوصول من النطاقات الأخرى
4. استخدم HTTPS في الإنتاج

---

**تم التطوير بواسطة GitHub Copilot** 🤖
