// Patient Lookup JavaScript
const API_URL = 'https://smartclinicv5.tctate.com/api/public/patient/lookup';

let html5QrCode = null;
let isScannerActive = false;

// DOM Elements
const searchInput = document.getElementById('searchInput');
const searchBtn = document.getElementById('searchBtn');
const qrScannerBtn = document.getElementById('qrScannerBtn');
const qrScannerContainer = document.getElementById('qrScannerContainer');
const loadingSpinner = document.getElementById('loadingSpinner');
const errorMessage = document.getElementById('errorMessage');
const errorText = document.getElementById('errorText');
const patientInfoSection = document.getElementById('patientInfoSection');

// Event Listeners
searchBtn.addEventListener('click', handleSearch);
searchInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        handleSearch();
    }
});
qrScannerBtn.addEventListener('click', toggleQrScanner);

// Check URL parameters on page load
window.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const code = urlParams.get('code');
    
    if (code) {
        searchInput.value = code;
        handleSearch();
    }
});

// Handle Search
async function handleSearch() {
    const code = searchInput.value.trim();
    
    if (!code) {
        showError('الرجاء إدخال رمز المريض');
        return;
    }
    
    await fetchPatientData(code);
}

// Toggle QR Scanner
function toggleQrScanner() {
    if (isScannerActive) {
        stopQrScanner();
    } else {
        startQrScanner();
    }
}

// Start QR Scanner
function startQrScanner() {
    qrScannerContainer.style.display = 'block';
    qrScannerBtn.innerHTML = '<i class="ri-stop-circle-line"></i> <span>إيقاف المسح</span>';
    
    html5QrCode = new Html5Qrcode("qr-reader");
    
    const config = {
        fps: 10,
        qrbox: { width: 250, height: 250 }
    };
    
    html5QrCode.start(
        { facingMode: "environment" },
        config,
        onScanSuccess,
        onScanError
    ).then(() => {
        isScannerActive = true;
    }).catch(err => {
        console.error('Error starting QR scanner:', err);
        showError('فشل في تشغيل الماسح الضوئي. الرجاء التحقق من إذن الكاميرا.');
        stopQrScanner();
    });
}

// Stop QR Scanner
function stopQrScanner() {
    if (html5QrCode && isScannerActive) {
        html5QrCode.stop().then(() => {
            qrScannerContainer.style.display = 'none';
            qrScannerBtn.innerHTML = '<i class="ri-qr-scan-2-line"></i> <span>مسح رمز QR</span>';
            isScannerActive = false;
            html5QrCode.clear();
        }).catch(err => {
            console.error('Error stopping QR scanner:', err);
        });
    }
}

// On Scan Success
function onScanSuccess(decodedText, decodedResult) {
    console.log('QR Code scanned:', decodedText);
    
    // Stop scanner
    stopQrScanner();
    
    // Extract code from URL or use directly
    let code = decodedText;
    
    // If it's a URL, try to extract code parameter
    try {
        const url = new URL(decodedText);
        const urlCode = url.searchParams.get('code');
        if (urlCode) {
            code = urlCode;
        }
    } catch (e) {
        // Not a URL, use as is
    }
    
    searchInput.value = code;
    fetchPatientData(code);
}

// On Scan Error
function onScanError(errorMessage) {
    // Handle scan error - usually just no QR code in view
    // Don't show error to user as this happens continuously
}

// Fetch Patient Data from API
async function fetchPatientData(code) {
    hideError();
    showLoading();
    hidePatientInfo();
    
    try {
        const response = await fetch(API_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ code: code })
        });
        
        const data = await response.json();
        
        if (data.success && data.patient) {
            displayPatientData(data);
        } else {
            showError('لم يتم العثور على بيانات للمريض');
        }
    } catch (error) {
        console.error('Error fetching patient data:', error);
        showError('حدث خطأ أثناء جلب البيانات. الرجاء المحاولة مرة أخرى.');
    } finally {
        hideLoading();
    }
}

// Display Patient Data
function displayPatientData(data) {
    const patient = data.patient;
    
    // Patient Header
    const patientHeader = document.getElementById('patientHeader');
    const sexIcon = patient.sex === 1 ? 'ri-men-line' : 'ri-women-line';
    const sexText = patient.sex === 1 ? 'ذكر' : 'أنثى';
    
    patientHeader.innerHTML = `
        <h2><i class="ri-user-line"></i> ${patient.name}</h2>
        <div class="patient-meta">
            <div class="meta-item">
                <i class="${sexIcon}"></i>
                <span>${sexText}</span>
            </div>
            <div class="meta-item">
                <i class="ri-calendar-line"></i>
                <span>العمر: ${patient.age} سنة</span>
            </div>
            <div class="meta-item">
                <i class="ri-phone-line"></i>
                <span>${patient.phone || 'غير متوفر'}</span>
            </div>
            ${patient.email ? `
            <div class="meta-item">
                <i class="ri-mail-line"></i>
                <span>${patient.email}</span>
            </div>
            ` : ''}
        </div>
    `;
    
    // Patient Basic Info
    const patientBasicInfo = document.getElementById('patientBasicInfo');
    patientBasicInfo.innerHTML = `
        <div class="info-card">
            <h4>رقم المريض</h4>
            <p>#${patient.id}</p>
        </div>
        <div class="info-card">
            <h4>تاريخ الميلاد</h4>
            <p>${formatDate(patient.birth_date)}</p>
        </div>
        ${patient.address ? `
        <div class="info-card">
            <h4>العنوان</h4>
            <p>${patient.address}</p>
        </div>
        ` : ''}
        ${patient.systemic_conditions ? `
        <div class="info-card">
            <h4>الحالات الجهازية</h4>
            <p>${patient.systemic_conditions}</p>
        </div>
        ` : ''}
        <div class="info-card">
            <h4>تاريخ التسجيل</h4>
            <p>${formatDateTime(patient.created_at)}</p>
        </div>
        <div class="info-card">
            <h4>عدد الحالات</h4>
            <p>${data.cases_count}</p>
        </div>
        <div class="info-card">
            <h4>عدد المواعيد</h4>
            <p>${data.reservations_count}</p>
        </div>
    `;
    
    // Bills Summary
    if (data.bills_summary) {
        displayBillsSummary(data.bills_summary);
    }
    
    // Cases
    if (data.cases && data.cases.length > 0) {
        displayCases(data.cases);
    }
    
    // Bills
    if (data.bills && data.bills.length > 0) {
        displayBills(data.bills);
    }
    
    // Reservations
    if (data.reservations && data.reservations.length > 0) {
        displayReservations(data.reservations);
    }
    
    // Images
    if (data.images && data.images.length > 0) {
        displayImages(data.images);
    }
    
    // Show patient info section
    showPatientInfo();
}

// Display Bills Summary
function displayBillsSummary(summary) {
    const billsSummaryCard = document.getElementById('billsSummaryCard');
    const billsSummaryGrid = document.getElementById('billsSummaryGrid');
    
    billsSummaryGrid.innerHTML = `
        <div class="summary-item">
            <div class="value">${formatCurrency(summary.total_bills)}</div>
            <div class="label">إجمالي الفواتير</div>
        </div>
        <div class="summary-item">
            <div class="value">${formatCurrency(summary.paid_bills)}</div>
            <div class="label">المدفوع</div>
        </div>
        <div class="summary-item">
            <div class="value">${formatCurrency(summary.unpaid_bills)}</div>
            <div class="label">غير المدفوع</div>
        </div>
        <div class="summary-item">
            <div class="value">${summary.bills_count}</div>
            <div class="label">عدد الفواتير</div>
        </div>
        <div class="summary-item">
            <div class="value">${summary.paid_count}</div>
            <div class="label">المدفوعة</div>
        </div>
        <div class="summary-item">
            <div class="value">${summary.unpaid_count}</div>
            <div class="label">غير المدفوعة</div>
        </div>
    `;
    
    billsSummaryCard.style.display = 'block';
}

// Display Cases
function displayCases(cases) {
    const casesCard = document.getElementById('casesCard');
    const casesTableBody = document.getElementById('casesTableBody');
    
    casesTableBody.innerHTML = cases.map(caseItem => `
        <tr>
            <td>${formatDateTime(caseItem.created_at)}</td>
            <td>${caseItem.doctor || 'غير متوفر'}</td>
            <td><span class="badge badge-info">${translateCategory(caseItem.category)}</span></td>
            <td>${caseItem.chief_complain || 'غير متوفر'}</td>
            <td>${caseItem.diagnosis || 'غير متوفر'}</td>
            <td>${caseItem.treatment || 'غير متوفر'}</td>
            <td>${caseItem.tooth_number || '-'}</td>
        </tr>
    `).join('');
    
    casesCard.style.display = 'block';
}

// Display Bills
function displayBills(bills) {
    const billsCard = document.getElementById('billsCard');
    const billsTableBody = document.getElementById('billsTableBody');
    
    billsTableBody.innerHTML = bills.map(bill => `
        <tr>
            <td>${formatDateTime(bill.created_at)}</td>
            <td>${bill.doctor || 'غير متوفر'}</td>
            <td>${formatCurrency(bill.price)}</td>
            <td>${bill.payment_date ? formatDate(bill.payment_date) : 'غير مدفوع'}</td>
            <td>
                <span class="badge ${bill.is_paid ? 'badge-success' : 'badge-danger'}">
                    ${bill.is_paid ? 'مدفوع' : 'غير مدفوع'}
                </span>
            </td>
        </tr>
    `).join('');
    
    billsCard.style.display = 'block';
}

// Display Reservations
function displayReservations(reservations) {
    const reservationsCard = document.getElementById('reservationsCard');
    const reservationsTableBody = document.getElementById('reservationsTableBody');
    
    reservationsTableBody.innerHTML = reservations.map(reservation => `
        <tr>
            <td>${formatDate(reservation.reservation_start_date)}</td>
            <td>${reservation.doctor || 'غير متوفر'}</td>
            <td>${reservation.reservation_from_time}</td>
            <td>${reservation.reservation_to_time}</td>
            <td>
                <span class="badge ${reservation.is_waiting ? 'badge-warning' : 'badge-info'}">
                    ${reservation.is_waiting ? 'في الانتظار' : (reservation.status || 'محجوز')}
                </span>
            </td>
            <td>${reservation.notes || '-'}</td>
        </tr>
    `).join('');
    
    reservationsCard.style.display = 'block';
}

// Display Images
function displayImages(images) {
    const imagesCard = document.getElementById('imagesCard');
    const imagesGrid = document.getElementById('imagesGrid');
    
    imagesGrid.innerHTML = images.map(image => `
        <div class="image-card">
            <i class="ri-image-2-line"></i>
            <p>صورة #${image.id}</p>
            <small>${formatDateTime(image.created_at)}</small>
        </div>
    `).join('');
    
    imagesCard.style.display = 'block';
}

// Utility Functions
function formatDate(dateString) {
    if (!dateString) return 'غير متوفر';
    const date = new Date(dateString);
    return date.toLocaleDateString('ar-IQ', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
}

function formatDateTime(dateString) {
    if (!dateString) return 'غير متوفر';
    const date = new Date(dateString);
    return date.toLocaleDateString('ar-IQ', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

function formatCurrency(amount) {
    if (!amount && amount !== 0) return 'غير متوفر';
    return new Intl.NumberFormat('ar-IQ', {
        style: 'currency',
        currency: 'IQD',
        minimumFractionDigits: 0
    }).format(amount);
}

function translateCategory(category) {
    const categories = {
        'endo': 'علاج العصب',
        'ortho': 'تقويم',
        'prosth': 'تعويض',
        'perio': 'لثة',
        'surgery': 'جراحة',
        'pedo': 'أطفال',
        'general': 'عام'
    };
    return categories[category] || category;
}

function showError(message) {
    errorText.textContent = message;
    errorMessage.classList.add('show');
    
    setTimeout(() => {
        hideError();
    }, 5000);
}

function hideError() {
    errorMessage.classList.remove('show');
}

function showLoading() {
    loadingSpinner.style.display = 'block';
}

function hideLoading() {
    loadingSpinner.style.display = 'none';
}

function showPatientInfo() {
    patientInfoSection.style.display = 'block';
}

function hidePatientInfo() {
    patientInfoSection.style.display = 'none';
    
    // Hide all cards
    document.getElementById('billsSummaryCard').style.display = 'none';
    document.getElementById('casesCard').style.display = 'none';
    document.getElementById('billsCard').style.display = 'none';
    document.getElementById('reservationsCard').style.display = 'none';
    document.getElementById('imagesCard').style.display = 'none';
}
