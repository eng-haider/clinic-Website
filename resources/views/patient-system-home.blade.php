<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>نظام البحث عن المريض - الصفحة الرئيسية</title>
    
    <!-- Bootstrap CSS RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    
    <!-- RemixIcon CSS -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    
    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 50px 20px;
            text-align: center;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        h1 {
            color: #0066ff;
            margin-bottom: 20px;
            font-size: 2.5rem;
        }
        .subtitle {
            color: #6c757d;
            font-size: 1.2rem;
            margin-bottom: 40px;
        }
        .action-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-top: 40px;
        }
        .action-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 30px;
            border-radius: 15px;
            color: white;
            text-decoration: none;
            display: block;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            color: white;
        }
        .action-card i {
            font-size: 4rem;
            margin-bottom: 20px;
        }
        .action-card h3 {
            margin-bottom: 10px;
            font-size: 1.5rem;
        }
        .action-card p {
            margin: 0;
            opacity: 0.9;
            font-size: 0.95rem;
        }
        .info-section {
            background: #e7f3ff;
            padding: 30px;
            border-radius: 15px;
            margin-top: 40px;
            text-align: right;
        }
        .info-section h3 {
            color: #0066ff;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }
        .info-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .info-list li {
            padding: 10px 0;
            border-bottom: 1px solid #d0e8ff;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .info-list li:last-child {
            border-bottom: none;
        }
        .info-list i {
            color: #0066ff;
            font-size: 1.2rem;
        }
        .routes-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            margin-top: 30px;
            text-align: right;
        }
        .routes-section h4 {
            color: #333;
            margin-bottom: 15px;
        }
        .route-item {
            background: white;
            padding: 12px 15px;
            margin: 10px 0;
            border-radius: 8px;
            font-family: 'Courier New', monospace;
            text-align: left;
            direction: ltr;
            color: #0066ff;
            font-size: 0.9rem;
        }
        .badge-success {
            background: #28a745;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>
            <i class="ri-hospital-line"></i><br>
            نظام البحث عن المريض
        </h1>
        <p class="subtitle">
            <span class="badge-success">✓ جاهز للاستخدام</span>
            <br><br>
            تم دمج النظام بنجاح في Laravel Project
        </p>
        
        <div class="action-cards">
            <a href="{{ route('patient.lookup') }}" class="action-card">
                <i class="ri-search-line"></i>
                <h3>البحث عن مريض</h3>
                <p>ابحث عن بيانات المريض باستخدام الكود أو امسح رمز QR</p>
            </a>
            
            <a href="{{ route('qr.generator') }}" class="action-card">
                <i class="ri-qr-code-line"></i>
                <h3>مولد QR Code</h3>
                <p>قم بتوليد رمز QR لأي مريض للاختبار</p>
            </a>
            
            <a href="{{ route('patient.lookup', ['code' => 'PAT12345']) }}" class="action-card">
                <i class="ri-test-tube-line"></i>
                <h3>اختبار سريع</h3>
                <p>جرب النظام مع كود تجريبي</p>
            </a>
        </div>
        
        <div class="info-section">
            <h3><i class="ri-information-line"></i> المميزات</h3>
            <ul class="info-list">
                <li>
                    <i class="ri-check-line"></i>
                    <span>واجهة عربية كاملة مع دعم RTL</span>
                </li>
                <li>
                    <i class="ri-check-line"></i>
                    <span>مسح QR Code باستخدام كاميرا الجهاز</span>
                </li>
                <li>
                    <i class="ri-check-line"></i>
                    <span>بحث يدوي بإدخال كود المريض</span>
                </li>
                <li>
                    <i class="ri-check-line"></i>
                    <span>عرض شامل لجميع بيانات المريض</span>
                </li>
                <li>
                    <i class="ri-check-line"></i>
                    <span>تصميم متجاوب لجميع الأجهزة</span>
                </li>
                <li>
                    <i class="ri-check-line"></i>
                    <span>متوافق مع API الخارجي</span>
                </li>
            </ul>
        </div>
        
        <div class="routes-section">
            <h4><i class="ri-route-line"></i> الروابط المتوفرة</h4>
            
            <div class="route-item">
                <strong>GET</strong> /patient-lookup
            </div>
            <div class="route-item">
                <strong>GET</strong> /qr-generator
            </div>
            <div class="route-item">
                <strong>POST</strong> /api/patient/lookup
            </div>
        </div>
        
        <div style="margin-top: 40px; padding-top: 30px; border-top: 2px solid #e0e0e0;">
            <p style="color: #6c757d; margin: 0;">
                📖 للمزيد من المعلومات، راجع ملف <strong>PATIENT_LOOKUP_SYSTEM.md</strong>
            </p>
            <p style="color: #6c757d; margin-top: 10px;">
                تم التطوير بواسطة <strong>GitHub Copilot</strong> 🤖
            </p>
        </div>
    </div>
</body>
</html>
