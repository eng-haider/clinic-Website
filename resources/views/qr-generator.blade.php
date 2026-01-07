<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>مولد رمز QR للمريض - Smart Clinic</title>
    
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
            padding: 40px 20px;
        }

        .demo-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .demo-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            padding: 40px;
            margin-bottom: 20px;
        }

        .demo-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .demo-header h1 {
            color: #0066ff;
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .demo-header p {
            color: #6c757d;
            font-size: 1.1rem;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .form-input {
            width: 100%;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-input:focus {
            outline: none;
            border-color: #0066ff;
            box-shadow: 0 0 0 3px rgba(0, 102, 255, 0.1);
        }

        .generate-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #0066ff, #00d4ff);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
        }

        .generate-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 102, 255, 0.4);
        }

        .qr-result {
            display: none;
            text-align: center;
            margin-top: 30px;
        }

        .qr-result.show {
            display: block;
        }

        #qrcode {
            display: inline-block;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .qr-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .qr-info h3 {
            color: #0066ff;
            margin-bottom: 15px;
        }

        .qr-link {
            display: block;
            padding: 15px;
            background: white;
            border-radius: 10px;
            color: #0066ff;
            text-decoration: none;
            word-break: break-all;
            margin-bottom: 15px;
            transition: all 0.3s;
        }

        .qr-link:hover {
            background: #0066ff;
            color: white;
        }

        .copy-btn, .download-btn {
            padding: 10px 20px;
            background: #0066ff;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            margin: 5px;
        }

        .copy-btn:hover, .download-btn:hover {
            background: #0052cc;
        }

        .info-box {
            background: #d1ecf1;
            color: #0c5460;
            padding: 20px;
            border-radius: 10px;
            border-right: 4px solid #0c5460;
            margin-top: 30px;
        }

        .info-box h3 {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-box ul {
            margin-bottom: 0;
            padding-right: 20px;
        }

        .info-box li {
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div class="demo-container">
        <div class="demo-card">
            <div class="demo-header">
                <h1><i class="ri-qr-code-line"></i> مولد رمز QR للمريض</h1>
                <p>قم بتوليد رمز QR لبيانات المريض (نسخة تجريبية)</p>
            </div>

            <form id="qrForm">
                <div class="form-group">
                    <label class="form-label">رمز المريض</label>
                    <input 
                        type="text" 
                        id="patientCode" 
                        class="form-input" 
                        placeholder="أدخل رمز المريض (مثال: PAT12345)"
                        required
                        dir="ltr"
                    >
                </div>

                <button type="submit" class="generate-btn">
                    <i class="ri-qr-code-line"></i> توليد رمز QR
                </button>
            </form>

            <div class="qr-result" id="qrResult">
                <div id="qrcode"></div>
                
                <div class="qr-info">
                    <h3><i class="ri-links-line"></i> رابط المريض</h3>
                    <a href="#" id="patientLink" class="qr-link" target="_blank"></a>
                    <button class="copy-btn" id="copyBtn">
                        <i class="ri-file-copy-line"></i> نسخ الرابط
                    </button>
                    <button class="download-btn" id="downloadBtn">
                        <i class="ri-download-line"></i> تنزيل QR Code
                    </button>
                </div>
            </div>

            <div class="info-box">
                <h3>
                    <i class="ri-information-line"></i>
                    كيفية الاستخدام
                </h3>
                <ul>
                    <li>أدخل رمز المريض الذي تريد توليد QR له</li>
                    <li>اضغط على "توليد رمز QR"</li>
                    <li>سيتم عرض رمز QR والرابط</li>
                    <li>يمكنك مسح رمز QR أو استخدام الرابط مباشرة</li>
                    <li>عند مسح الكود، سيتم توجيهك لصفحة بيانات المريض وسيتم البحث تلقائياً</li>
                    <li>يمكنك تنزيل صورة QR Code لاستخدامها في الطباعة</li>
                </ul>
            </div>

            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('patient.lookup') }}" class="btn btn-primary btn-lg">
                    <i class="ri-search-line"></i> اذهب إلى صفحة البحث
                </a>
            </div>
        </div>
    </div>

    <!-- QR Code Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    
    <script>
        const qrForm = document.getElementById('qrForm');
        const qrResult = document.getElementById('qrResult');
        const qrCodeDiv = document.getElementById('qrcode');
        const patientLink = document.getElementById('patientLink');
        const copyBtn = document.getElementById('copyBtn');
        const downloadBtn = document.getElementById('downloadBtn');
        
        let currentQR = null;

        qrForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const patientCode = document.getElementById('patientCode').value.trim();
            
            if (!patientCode) {
                alert('الرجاء إدخال رمز المريض');
                return;
            }
            
            // Generate URL with patient code
            const baseUrl = '{{ route("patient.lookup") }}';
            const fullUrl = `${baseUrl}?code=${encodeURIComponent(patientCode)}`;
            
            // Clear previous QR code
            qrCodeDiv.innerHTML = '';
            
            // Generate new QR code
            currentQR = new QRCode(qrCodeDiv, {
                text: fullUrl,
                width: 256,
                height: 256,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            
            // Update link
            patientLink.href = fullUrl;
            patientLink.textContent = fullUrl;
            
            // Show result
            qrResult.classList.add('show');
            
            // Scroll to result
            qrResult.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        });

        copyBtn.addEventListener('click', function() {
            const url = patientLink.textContent;
            
            // Copy to clipboard
            navigator.clipboard.writeText(url).then(function() {
                // Change button text temporarily
                const originalHTML = copyBtn.innerHTML;
                copyBtn.innerHTML = '<i class="ri-check-line"></i> تم النسخ!';
                
                setTimeout(function() {
                    copyBtn.innerHTML = originalHTML;
                }, 2000);
            }).catch(function(err) {
                console.error('Failed to copy:', err);
                alert('فشل في نسخ الرابط');
            });
        });

        downloadBtn.addEventListener('click', function() {
            if (currentQR) {
                const canvas = qrCodeDiv.querySelector('canvas');
                if (canvas) {
                    const url = canvas.toDataURL('image/png');
                    const link = document.createElement('a');
                    link.download = `patient-qr-${document.getElementById('patientCode').value}.png`;
                    link.href = url;
                    link.click();
                }
            }
        });
    </script>
</body>
</html>
