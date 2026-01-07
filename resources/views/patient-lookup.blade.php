@extends('layouts.app')

@section('title', __('Patient Lookup') . ' - ' . config('app.name'))

@push('styles')
<style>
    /* ============================================
       MEDICAL-GRADE PATIENT PROFILE SYSTEM
       Design: Clean, Professional, Accessible
       Typography: Cairo Font - Optimized for readability
       Target: Doctors & Medical Staff
       ============================================ */
    
    /* Global Typography & RTL */
    * {
        font-family: 'Cairo', sans-serif !important;
    }
    
    body {
        background: #f0f2f5;
        color: #1a1f36;
    }
    
    /* Force RTL for all patient-related sections */
    .search-box,
    .search-box *,
    #patientProfile,
    #patientProfile *,
    .loading-box,
    .error-box {
        direction: rtl;
        text-align: right;
    }
    
    /* ============================================
       SEARCH SECTION - Medical Interface
       ============================================ */
    .search-box {
        background: #ffffff;
        padding: 30px 40px;
        border-radius: 24px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        margin-bottom: 40px;
        border: 2px solid #e2e8f0;
        position: relative;
        overflow: hidden;
    }
    
    .search-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #4a7ab5 0%, #2a5a8f 100%);
        opacity: 0.9;
    }
    
    .search-box:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        border-color: #2a5a8f;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .icon-wrapper {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #4a7ab5 0%, #2a5a8f 100%);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        box-shadow: 0 6px 16px rgba(42,90,143,0.4);
        animation: float 3s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    
    .icon-wrapper i {
        font-size: 2rem;
        color: #ffffff;
    }
    
    .search-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: #000000;
        margin-bottom: 0.5rem;
        letter-spacing: -0.5px;
        line-height: 1.3;
        text-align: center;
    }
    
    .search-subtitle {
        font-size: 1rem;
        color: #4a5568;
        line-height: 1.7;
        max-width: 600px;
        margin: 0 auto 1.5rem;
        text-align: center;
    }
    
    .search-input-group {
        max-width: 750px;
        margin: 0 auto 20px;
        position: relative;
        display: flex;
        gap: 12px;
        align-items: center;
    }
    
    .search-input {
        flex: 1;
        padding: 0.875rem 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 14px;
        font-size: 1rem;
        font-weight: 500;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        direction: rtl;
        text-align: right;
        background: #ffffff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        min-height: 50px;
        color: #000000;
    }
    
    .search-input:focus {
        outline: none;
        border-color: #2a5a8f;
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(42,90,143,0.15);
        transform: translateY(-2px);
    }
    
    .search-input::placeholder {
        color: #a0aec0;
        font-weight: 400;
    }
    
    .search-button {
        background: linear-gradient(135deg, #4a7ab5 0%, #2a5a8f 100%);
        color: #ffffff;
        padding: 0.875rem 1.5rem;
        border: none;
        border-radius: 14px;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 700;
        transition: all 0.3s ease;
        min-height: 50px;
        box-shadow: 0 4px 14px rgba(74,122,181,0.4);
        position: relative;
        overflow: hidden;
        white-space: nowrap;
    }
    
    .search-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }
    
    .search-button:hover::before {
        left: 100%;
    }
    
    .search-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(74,122,181,0.5);
    }
    
    .search-button:active {
        transform: translateY(-1px);
    }
    }
    
    .search-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(var(--theme-color-rgb), 0.35);
    }
    
    .search-button:active {
        transform: translateY(0);
    }
    
    .search-button i {
        margin-left: 6px;
    }
    
    /* QR Scanner - Icon Button */
    .qr-scan-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        color: #2a5a8f;
        text-decoration: none;
        border-radius: 14px;
        transition: all 0.3s ease;
        background: #f7fafc;
        border: 2px solid #e2e8f0;
        flex-shrink: 0;
    }
    
    .qr-scan-link:hover {
        background: #edf2f7;
        border-color: #2a5a8f;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(42,90,143,0.2);
    }
    
    .qr-scan-link i {
        font-size: 1.5rem;
    }
    
    .qr-scan-link span {
        display: none;
    }
    
    #qrScannerContainer {
        display: none;
        margin-top: 20px;
        max-width: 550px;
        margin-left: auto;
        margin-right: auto;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 6px 24px rgba(0,0,0,0.12);
        border: 2px solid #e2e8f0;
    }
    
    /* ============================================
       LOADING STATE
       ============================================ */
    .loading-box {
        display: none;
        text-align: center;
        padding: 120px 40px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
    }
    
    .spinner {
        border: 7px solid #e2e8f0;
        border-top: 7px solid var(--theme-color);
        border-radius: 50%;
        width: 80px;
        height: 80px;
        animation: spin 0.8s linear infinite;
        margin: 0 auto 30px;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .loading-text {
        font-size: 1.25rem;
        color: #4a5568;
        font-weight: 600;
    }
    
    /* ============================================
       ERROR ALERTS - Medical Grade
       ============================================ */
    .error-box {
        display: none;
        background: #fff5f5;
        border: 2px solid #feb2b2;
        border-left: 6px solid #f56565;
        padding: 20px 26px;
        border-radius: 14px;
        margin-bottom: 30px;
        max-width: 750px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .error-box.show {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    
    .error-box i {
        font-size: 2rem;
        color: #c53030;
        flex-shrink: 0;
    }
    
    .error-text {
        color: #742a2a;
        font-weight: 600;
        font-size: 1.0625rem;
        line-height: 1.6;
    }
    
    /* ============================================
       PATIENT PROFILE CARD - Matching Search Box Style
       ============================================ */
    .patient-profile {
        display: none;
    }
    
    .profile-header {
        background: linear-gradient(135deg, #2a5a8f 0%, #1a3a5c 100%);
        border-radius: 24px;
        box-shadow: 0 10px 40px rgba(0,10,45,0.3);
        margin-bottom: 40px;
        overflow: hidden;
        border: none;
        position: relative;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .profile-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #4a7ab5 0%, #2a5a8f 100%);
        opacity: 0.9;
    }
    
    .profile-header:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 60px rgba(0,0,0,0.12);
    }
    
    .profile-cover {
        background: linear-gradient(135deg, #4a7ab5 0%, #2a5a8f 100%);
        height: 150px;
        position: relative;
        overflow: hidden;
    }
    
    /* Decorative pattern */
    .profile-cover::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 50%, rgba(255,255,255,0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 50%, rgba(255,255,255,0.08) 0%, transparent 50%);
        opacity: 0.8;
    }
    
    .profile-photo-section {
        padding: 0 50px;
        margin-top: -80px;
        position: relative;
        z-index: 10;
    }
    
    .profile-photo-wrapper {
        display: flex;
        align-items: flex-end;
        gap: 32px;
        direction: rtl;
    }
    
    .profile-photo {
        width: 160px;
        height: 160px;
        border-radius: 20px;
        background: white;
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
        border: 4px solid white;
        transition: all 0.3s ease;
    }
    
    .profile-photo:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 32px rgba(0,0,0,0.2);
    }
    
    .profile-photo-icon {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #4a7ab5 0%, #2a5a8f 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 5rem;
    }
    
    .profile-main-info {
        flex: 1;
        padding-bottom: 20px;
        text-align: left;
    }
    
    /* Patient Name - Large & Bold for Elderly */
    .profile-name {
        font-size: 2.25rem;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 10px;
        direction: ltr;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }
    
    .profile-id {
        color: #b8c5d6;
        font-size: 1rem;
        margin-bottom: 16px;
        font-weight: 600;
        display: inline-block;
        background: rgba(255,255,255,0.1);
        padding: 6px 16px;
        border-radius: 10px;
        margin-right: 12px;
        box-shadow: 0 2px 8px rgba(0,10,45,0.2);
    }
    
    /* Patient Details Grid */
    .profile-details {
        padding: 30px 40px 40px;
        direction: ltr;
        background: white;
        border-radius: 0 0 24px 24px;
    }
    
    .profile-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 16px;
    }
    
    /* Info Cards - High Contrast */
    .profile-info-item {
        display: flex;
        align-items: center;
        gap: 14px;
        color: #000000;
        font-size: 1rem;
        padding: 16px 20px;
        background: #ffffff;
        border-radius: 14px;
        direction: ltr;
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
        min-height: 60px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    
    .profile-info-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.12);
        border-color: #2a5a8f;
        background: #ffffff;
    }
    
    .profile-info-item i {
        color: #2a5a8f;
        font-size: 1.75rem;
        flex-shrink: 0;
    }
    
    .profile-info-item strong {
        color: #000000;
        margin-left: 6px;
        font-weight: 700;
    }
    
    .profile-info-item span {
        font-weight: 600;
        color: #000000;
    }
    
    /* ============================================
       INFO LIST - Medical Records (Matching Search Box Style)
       ============================================ */
    .info-list {
        background: linear-gradient(135deg, #2a5a8f 0%, #1a3a5c 100%);
        padding: 40px;
        border-radius: 24px;
        box-shadow: 0 10px 40px rgba(0,10,45,0.3);
        margin-bottom: 40px;
        direction: ltr;
        border: none;
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .info-list::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #4a7ab5 0%, #2a5a8f 100%);
        opacity: 0.9;
    }
    
    .info-list:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 60px rgba(0,0,0,0.12);
    }
    
    .info-list h3 {
        font-size: 1.5rem;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 2px solid rgba(74,122,181,0.4);
        text-align: left;
        letter-spacing: -0.5px;
    }
    
    .info-row {
        display: grid;
        grid-template-columns: 200px 1fr;
        padding: 16px 0;
        border-bottom: 2px solid rgba(255,255,255,0.1);
        gap: 24px;
        align-items: center;
        transition: all 0.3s ease;
    }
    
    .info-row:hover {
        padding-left: 8px;
        background: rgba(255,255,255,0.05);
        border-radius: 10px;
    }
    
    .info-row:last-child {
        border-bottom: none;
    }
    
    /* Labels - Medium Size */
    .info-label {
        color: #b8c5d6;
        font-weight: 700;
        text-align: left;
        font-size: 1rem;
    }
    
    /* Values - Readable */
    .info-value {
        color: #ffffff;
        font-weight: 600;
        text-align: left;
        font-size: 1.0625rem;
    }
    
    /* ============================================
       STATISTICS DASHBOARD (Matching Search Box Style)
       ============================================ */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
        direction: ltr;
    }
    
    .stat-box {
        background: #ffffff;
        padding: 32px 28px;
        border-radius: 24px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        text-align: center;
        transition: all 0.35s ease;
        border: 2px solid #e2e8f0;
        position: relative;
        overflow: hidden;
    }
    
    .stat-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #4a7ab5 0%, #2a5a8f 100%);
        opacity: 0.9;
    }
    
    .stat-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        border-color: #2a5a8f;
    }
    
    .stat-icon {
        font-size: 3rem;
        color: #2a5a8f;
        margin-bottom: 16px;
        display: inline-block;
        transition: all 0.3s ease;
    }
    
    .stat-box:hover .stat-icon {
        transform: scale(1.15) rotate(5deg);
    }
    
    .stat-value {
        font-size: 2.5rem;
        font-weight: 800;
        color: #000000;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }
    
    .stat-label {
        color: #4a5568;
        font-size: 1.0625rem;
        font-weight: 600;
        letter-spacing: 0;
    }
    
    /* ============================================
       MEDICAL CASES, BILLS, APPOINTMENTS (Matching Search Box Style)
       Clean List Design
       ============================================ */
    .simple-list {
        background: #ffffff;
        padding: 40px;
        border-radius: 24px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        margin-bottom: 40px;
        direction: ltr;
        border: 2px solid #e2e8f0;
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .simple-list::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #4a7ab5 0%, #2a5a8f 100%);
        opacity: 0.9;
    }
    
    .simple-list:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        border-color: #2a5a8f;
    }
    
    .simple-list h3 {
        font-size: 1.5rem;
        font-weight: 800;
        color: #000000;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 2px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 12px;
        text-align: left;
        letter-spacing: -0.5px;
    }
    
    .simple-list h3 i {
        color: #2a5a8f;
        font-size: 1.75rem;
    }
    
    .list-item {
        padding: 24px;
        border: 2px solid #e2e8f0;
        border-radius: 14px;
        margin-bottom: 16px;
        transition: all 0.3s ease;
        background: #ffffff;
        direction: ltr;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    
    .list-item:hover {
        border-color: #2a5a8f;
        box-shadow: 0 6px 20px rgba(0,0,0,0.12);
        transform: translateY(-3px);
    }
    
    .list-item-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        flex-wrap: wrap;
        gap: 12px;
    }
    
    .list-item-title {
        font-weight: 700;
        color: #000000;
        font-size: 1.125rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .list-item-title i {
        color: #2a5a8f;
        font-size: 1.25rem;
    }
    
    .list-item-date {
        color: #4a5568;
        font-size: 0.9375rem;
        background: #f7fafc;
        padding: 6px 14px;
        border-radius: 10px;
        font-weight: 600;
        border: 1px solid #e2e8f0;
    }
    
    .list-item-body {
        color: #4a5568;
        line-height: 1.7;
        text-align: left;
        font-size: 1rem;
    }
    
    .list-item-body p {
        margin: 10px 0;
        padding: 8px 0;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .list-item-body p:last-child {
        border-bottom: none;
    }
    
    .list-item-body strong {
        color: #2a5a8f;
        margin-left: 6px;
        font-weight: 700;
    }
    
    /* ============================================
       CASE PHOTOS GALLERY (Matching Theme)
       ============================================ */
    .case-photos {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid #e2e8f0;
    }
    
    .case-photos-label {
        font-weight: 700;
        color: #000000;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1rem;
    }
    
    .case-photos-label i {
        color: #2a5a8f;
        font-size: 1.25rem;
    }
    
    .case-photos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 12px;
        margin-top: 14px;
    }
    
    .case-photo-item {
        position: relative;
        width: 100%;
        padding-bottom: 100%;
        border-radius: 14px;
        overflow: hidden;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(74,122,181,0.3);
        transition: all 0.3s ease;
        border: 2px solid rgba(255,255,255,0.1);
        background: rgba(255,255,255,0.05);
    }
    
    .case-photo-item:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 24px rgba(74,122,181,0.4);
        border-color: #4a7ab5;
    }
    
    .case-photo-item img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .case-photo-item .photo-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .case-photo-item:hover .photo-overlay {
        opacity: 1;
    }
    
    .case-photo-item .photo-overlay i {
        color: white;
        font-size: 2.5rem;
    }
    
    .no-photos {
        color: #a0aec0;
        font-style: italic;
        padding: 14px;
        text-align: center;
        font-size: 1rem;
    }
    
    /* ============================================
       STATUS BADGES - High Contrast (Matching Theme)
       ============================================ */
    .status-badge {
        display: inline-block;
        padding: 8px 20px;
        border-radius: 12px;
        font-size: 0.875rem;
        font-weight: 700;
        letter-spacing: 0.02em;
        border: 2px solid;
        min-height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .badge-paid {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
        border-color: #28a745;
    }
    
    .badge-unpaid {
        background: linear-gradient(135deg, #fff3cd 0%, #ffeeba 100%);
        color: #856404;
        border-color: #ffc107;
    }
    
    .badge-completed {
        background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
        color: #0c5460;
        border-color: #17a2b8;
    }
    
    /* ============================================
       TOOTH DIAGRAM SECTION (Matching Search Box Style)
       ============================================ */
    .tooth-diagram-section {
        background: #ffffff;
        padding: 40px;
        border-radius: 24px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        margin-bottom: 40px;
        direction: ltr;
        border: 2px solid #e2e8f0;
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .tooth-diagram-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #4a7ab5 0%, #2a5a8f 100%);
        opacity: 0.9;
    }
    
    .tooth-diagram-section:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        border-color: #2a5a8f;
    }

    .tooth-diagram-section h3 {
        color: #000000;
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 2px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 12px;
        text-align: left;
        letter-spacing: -0.5px;
    }

    .tooth-diagram-section h3 i {
        color: #2a5a8f;
        font-size: 1.75rem;
    }

    .tooth-diagram-container {
        width: 100%;
        overflow: hidden;
        border-radius: 14px;
        border: 2px solid rgba(255,255,255,0.1);
        background: white;
    }
    
    #teethIframe {
        width: 100%;
        height: 700px;
        border: none;
        border-radius: 14px;
        /* Smooth iframe loading */
        transition: opacity 0.4s ease;
    }
    
    /* ============================================
       STICKY TAB NAVIGATION
       Medical-safe smooth scrolling
       ============================================ */
    .patient-tabs {
        position: sticky;
        top: 0;
        z-index: 100;
        background: white;
        border-bottom: 3px solid #e2e8f0;
        margin-bottom: 40px;
        box-shadow: 0 2px 16px rgba(0,0,0,0.06);
        direction: rtl;
        /* Smooth appearance animation */
        animation: slideDown 0.4s ease-out;
    }
    
    @keyframes slideDown {
        from {
            transform: translateY(-100%);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
    .patient-tabs-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        max-width: 1400px;
        margin: 0 auto;
        direction: ltr;
        flex-wrap: wrap;
    }
    
    .tab-link {
        padding: 12px 28px;
        border-radius: 10px;
        text-decoration: none;
        color: #4a5568;
        font-weight: 600;
        font-size: 1.0625rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: transparent;
        border: 2px solid transparent;
        display: flex;
        align-items: center;
        gap: 8px;
        min-height: 48px;
        cursor: pointer;
    }
    
    .tab-link i {
        font-size: 1.25rem;
        transition: transform 0.3s ease;
    }
    
    /* Hover effect - subtle elevation */
    .tab-link:hover {
        background: rgba(var(--theme-color-rgb), 0.08);
        color: var(--theme-color);
        transform: translateY(-2px);
    }
    
    /* Active tab state - medical-safe highlight */
    .tab-link.active {
        background: var(--theme-color);
        color: white;
        border-color: var(--theme-color);
        box-shadow: 0 4px 12px rgba(var(--theme-color-rgb), 0.3);
    }
    
    .tab-link.active i {
        transform: scale(1.1);
    }
    
    /* ============================================
       BOOKING BUTTON - Primary Action (Matching Home Page Style)
       ============================================ */
    .booking-button {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 28px;
        background: linear-gradient(135deg, #10b981 0%, #0b6efd 100%);
        color: white;
        border: none;
        border-radius: 14px;
        font-size: 1.0625rem;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 14px rgba(16,185,129,0.3);
        min-height: 48px;
        margin-top: 8px;
        position: relative;
        overflow: hidden;
    }
    
    .booking-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }
    
    .booking-button:hover::before {
        left: 100%;
    }
    
    .booking-button i {
        font-size: 1.25rem;
        transition: transform 0.3s ease;
    }
    
    /* Hover effect - soft elevation */
    .booking-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(16,185,129,0.4);
    }
    
    .booking-button:hover i {
        transform: translateX(3px);
    }
    
    /* Active/Click feedback */
    .booking-button:active {
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(16,185,129,0.3);
    }
    
    /* ============================================
       BOOKING MODAL STYLES
       ============================================ */
    .booking-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10000;
        opacity: 0;
        transition: opacity 0.3s ease;
        padding: 1rem;
    }
    
    .booking-modal-overlay.show {
        opacity: 1;
    }
    
    .booking-modal {
        background: #ffffff;
        border-radius: 20px;
        max-width: 500px;
        width: 100%;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        transform: translateY(20px);
        transition: transform 0.3s ease;
        max-height: 90vh;
        overflow-y: auto;
    }
    
    .booking-modal-overlay.show .booking-modal {
        transform: translateY(0);
    }
    
    .booking-modal-header {
        padding: 1.5rem;
        border-bottom: 2px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-radius: 20px 20px 0 0;
    }
    
    .booking-modal-header h3 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 700;
        color: #ffffff;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .booking-modal-header h3 i {
        font-size: 1.75rem;
    }
    
    .modal-close-btn {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: #ffffff;
        font-size: 2rem;
        line-height: 1;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .modal-close-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(90deg);
    }
    
    .booking-modal-body {
        padding: 2rem 1.5rem;
    }
    
    .patient-info-summary {
        background: #f8fafc;
        padding: 1rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        border-right: 4px solid #10b981;
    }
    
    .patient-info-summary p {
        margin: 0.5rem 0;
        font-size: 0.95rem;
        color: #1e293b;
    }
    
    .patient-info-summary strong {
        color: #10b981;
        font-weight: 700;
    }
    
    .booking-modal-body .form-group {
        margin-bottom: 1.25rem;
    }
    
    .booking-modal-body .form-group label {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-weight: 600;
        color: #334155;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }
    
    .booking-modal-body .form-group label i {
        color: #10b981;
        font-size: 1.1rem;
    }
    
    .booking-modal-body .form-control {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8fafc;
    }
    
    .booking-modal-body .form-control:focus {
        outline: none;
        border-color: #10b981;
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
    }
    
    .booking-modal-body textarea.form-control {
        resize: vertical;
        min-height: 80px;
    }
    
    .modal-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }
    
    .modal-actions button {
        flex: 1;
        padding: 0.875rem 1.5rem;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .btn-cancel {
        background: #f1f5f9;
        color: #64748b;
    }
    
    .btn-cancel:hover {
        background: #e2e8f0;
        color: #334155;
    }
    
    .btn-confirm {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(16, 185, 129, 0.3);
    }
    
    .btn-confirm:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
    }
    
    .btn-confirm i {
        font-size: 1.25rem;
    }
    
    .btn-confirm:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }
    
    /* ============================================
       TOAST NOTIFICATIONS
       ============================================ */
    .booking-toast {
        position: fixed;
        top: 20px;
        right: 20px;
        background: #ffffff;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        gap: 0.75rem;
        z-index: 10001;
        opacity: 0;
        transform: translateX(400px);
        transition: all 0.3s ease;
        min-width: 300px;
        max-width: 400px;
    }
    
    .booking-toast.show {
        opacity: 1;
        transform: translateX(0);
    }
    
    .booking-toast i {
        font-size: 1.5rem;
    }
    
    .booking-toast-success {
        border-right: 4px solid #10b981;
    }
    
    .booking-toast-success i {
        color: #10b981;
    }
    
    .booking-toast-error {
        border-right: 4px solid #ef4444;
    }
    
    .booking-toast-error i {
        color: #ef4444;
    }
    
    .booking-toast span {
        font-weight: 600;
        color: #1e293b;
        font-size: 0.95rem;
    }
    
    /* Spinner animation */
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    /* RTL support for toast */
    [dir="rtl"] .booking-toast {
        right: auto;
        left: 20px;
        transform: translateX(-400px);
    }
    
    [dir="rtl"] .booking-toast.show {
        transform: translateX(0);
    }
    
    [dir="rtl"] .booking-toast-success,
    [dir="rtl"] .booking-toast-error {
        border-right: none;
        border-left: 4px solid;
    }
    
    /* ============================================
       PAGE LOAD ANIMATIONS
       Subtle fade-in and slide-up
       ============================================ */
    
    /* Fade in animation for sections */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Apply staggered animations to sections */
    .profile-header {
        animation: fadeInUp 0.6s ease-out 0.1s both;
    }
    
    .info-list {
        animation: fadeInUp 0.6s ease-out 0.2s both;
    }
    
    .stats-grid {
        animation: fadeInUp 0.6s ease-out 0.3s both;
    }
    
    .simple-list {
        animation: fadeInUp 0.6s ease-out 0.4s both;
    }
    
    .tooth-diagram-section {
        animation: fadeInUp 0.6s ease-out 0.5s both;
    }
    
    /* Respect user's motion preferences */
    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
        
        .booking-button {
            animation: none;
        }
        
        .patient-tabs {
            animation: none;
        }
    }
    
    /* ============================================
       SMOOTH SCROLLING
       ============================================ */
    html {
        scroll-behavior: smooth;
    }
    
    /* Scroll padding for sticky header offset */
    html {
        scroll-padding-top: 80px;
    }
    
    /* Section anchors for smooth navigation */
    .section-anchor {
        position: relative;
        top: -80px;
        display: block;
        visibility: hidden;
    }
    
    /* ============================================
       RESPONSIVE DESIGN - Tablet & Mobile
       ============================================ */
    @media (max-width: 768px) {
        .tooth-diagram-section {
            padding: 30px 24px;
        }
        
        #teethIframe {
            height: 500px !important;
        }
        
        /* Tabs responsive */
        .patient-tabs-container {
            padding: 8px 12px;
            gap: 6px;
        }
        
        .tab-link {
            padding: 10px 20px;
            font-size: 0.9375rem;
        }
        
        .tab-link span {
            display: none; /* Hide text on mobile, show icons only */
        }
        
        .tab-link i {
            font-size: 1.375rem;
        }
        
        /* Booking button responsive */
        .booking-button {
            padding: 12px 24px;
            font-size: 1rem;
        }
        
        .profile-photo-wrapper {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        
        .profile-main-info {
            text-align: center;
        }
        
        .profile-photo-section {
            padding: 0 24px;
        }
        
        .profile-details {
            padding: 30px 24px;
        }
        
        .profile-name {
            font-size: 2rem;
            text-align: center;
        }
        
        .profile-info {
            gap: 16px;
        }
        
        .info-list {
            padding: 30px 24px;
        }
        
        .info-row {
            grid-template-columns: 1fr;
            gap: 8px;
        }
        
        .simple-list {
            padding: 30px 24px;
        }
        
        .search-box {
            padding: 20px 24px;
        }
        
        .search-title {
            font-size: 1.25rem;
        }
        
        .search-subtitle {
            font-size: 0.9375rem;
            margin-bottom: 1rem;
        }
        
        .search-input-group {
            flex-direction: column;
            gap: 10px;
        }
        
        .search-input {
            padding: 0.75rem 1rem;
            font-size: 0.9375rem;
            min-height: 46px;
        }
        
        .search-button {
            width: 100%;
            padding: 0.75rem 1.25rem;
            min-height: 46px;
        }
        
        .qr-scan-link {
            width: 46px;
            height: 46px;
        }
        
        .list-item {
            padding: 22px 20px;
        }
        
        .list-item-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .stat-box {
            padding: 32px 24px;
        }
        
        .stat-value {
            font-size: 2.25rem;
        }
    }
    
    @media (max-width: 480px) {
        #teethIframe {
            height: 400px !important;
        }
        
        .profile-name {
            font-size: 1.75rem;
        }
        
        .profile-photo {
            width: 160px;
            height: 160px;
        }
        
        .profile-photo-icon {
            font-size: 5rem;
        }
        
        .search-title {
            font-size: 1.125rem;
        }
        
        .icon-wrapper {
            width: 50px;
            height: 50px;
            border-radius: 14px;
        }
        
        .icon-wrapper i {
            font-size: 1.5rem;
        }
        
        .case-photos-grid {
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        }
    }
</style>
@endpush

@section('content')
<!-- Breadcrumb Section Start -->
<div class="breadcrumb-wrap bg-f br-1">
    <div class="container">
        <div class="breadcrumb-title">
            <h2>البحث عن مريض</h2>
            <ul class="breadcrumb-menu list-style">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>البحث عن مريض</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Patient Lookup Section Start -->
<section class="ptb-100">
    <div class="container">
        <!-- Search Box -->
        <div class="search-box" data-aos="fade-up" style="display: none;">
            <div class="icon-wrapper">
                <i class="ri-user-search-line"></i>
            </div>
            <h2 class="search-title">البحث عن معلومات المريض</h2>
            <p class="search-subtitle">أدخل رمز المريض الخاص بك لعرض معلوماتك الطبية بشكل آمن</p>

            <!-- Error Alert -->
            <div class="error-box" id="errorMessage">
                <i class="ri-error-warning-line"></i>
                <span class="error-text" id="errorText"></span>
            </div>

            <!-- Search Input -->
            <div class="search-input-group">
                <input 
                    type="text" 
                    id="searchInput" 
                    class="search-input" 
                    placeholder="Enter patient code (e.g., PAT-12345)"
                    dir="ltr"
                    value="{{ request('code') }}"
                >
            </div>
            <button class="search-button btn style-one" id="searchBtn">
                <span>Search Medical Records</span>
                <i class="ri-arrow-right-line"></i>
            </button>

            <!-- QR Scanner Link -->
            <a href="javascript:void(0)" class="qr-scan-link" id="qrScannerBtn">
                <i class="ri-qr-scan-2-line"></i>
                <span>Or Scan QR Code</span>
            </a>

            <!-- QR Scanner Container -->
            <div id="qrScannerContainer">
                <div id="qr-reader"></div>
            </div>
        </div>

        <!-- Loading Box -->
        <div class="loading-box" id="loadingSpinner" data-aos="fade-up">
            <div class="spinner"></div>
            <p class="loading-text">Searching for patient data...</p>
        </div>

        <!-- Patient Profile Section -->
        <div id="patientProfile" class="patient-profile">
            
            <!-- Sticky Tab Navigation -->
            <nav class="patient-tabs" id="patientTabs" style="display: none;">
                <div class="patient-tabs-container">
                    <a href="#patient-info" class="tab-link active" data-section="patient-info">
                        <i class="ri-user-line"></i>
                        <span>Patient Info</span>
                    </a>
                    <a href="#patient-stats" class="tab-link" data-section="patient-stats">
                        <i class="ri-bar-chart-box-line"></i>
                        <span>Statistics</span>
                    </a>
                    <a href="#patient-cases" class="tab-link" data-section="patient-cases">
                        <i class="ri-heart-pulse-line"></i>
                        <span>الحالات الطبية</span>
                    </a>
                    <a href="#patient-teeth" class="tab-link" data-section="patient-teeth">
                        <i class="ri-tooth-line"></i>
                        <span>مخطط الأسنان</span>
                    </a>
                    <a href="#patient-bills" class="tab-link" data-section="patient-bills">
                        <i class="ri-bill-line"></i>
                        <span>الفواتير</span>
                    </a>
                    <a href="#patient-appointments" class="tab-link" data-section="patient-appointments">
                        <i class="ri-calendar-check-line"></i>
                        <span>المواعيد</span>
                    </a>
                </div>
            </nav>
            
            <!-- Section Anchor: Patient Info -->
            <span class="section-anchor" id="patient-info"></span>
            
            <!-- Profile Header Card -->
            <div class="profile-header" data-aos="fade-up">
                <!-- Cover Photo -->
                <div class="profile-cover"></div>
                
                <!-- Profile Photo & Name Section -->
                <div class="profile-photo-section">
                    <div class="profile-photo-wrapper">
                        <div class="profile-photo">
                            <div class="profile-photo-icon">
                                <i class="ri-user-line"></i>
                            </div>
                        </div>
                        <div class="profile-main-info">
                            <h2 class="profile-name" id="patientName"></h2>
                            <p class="profile-id" id="patientId"></p>
                            <!-- Booking Button -->
                            <a href="#" class="booking-button" id="bookingBtn" onclick="handleBooking(event)">
                                <i class="ri-calendar-check-line"></i>
                                <span>حجز موعد جديد</span>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Profile Details -->
                <div class="profile-details">
                    <div class="profile-info" id="profileInfo">
                        <!-- Will be populated dynamically -->
                    </div>
                </div>
            </div>

            <!-- Section Anchor: Statistics -->
            <span class="section-anchor" id="patient-stats"></span>
            
            <!-- Statistics -->
            <div class="stats-grid" id="statsGrid" data-aos="fade-up" data-aos-delay="200">
                <!-- Will be populated dynamically -->
            </div>

            <!-- Section Anchor: Medical Cases -->
            <span class="section-anchor" id="patient-cases"></span>
            
            <!-- Medical Cases List -->
            <div class="simple-list" id="casesList" style="display: none;" data-aos="fade-up" data-aos-delay="300">
                <h3>
                    <i class="ri-heart-pulse-line"></i>
                    الحالات الطبية
                </h3>
                <div id="casesContainer">
                    <!-- Will be populated dynamically -->
                </div>
            </div>

            <!-- Section Anchor: Tooth Diagram -->
            <span class="section-anchor" id="patient-teeth"></span>
            
            <!-- Tooth Diagram Section -->
            <div class="tooth-diagram-section" id="toothDiagramSection" style="display: none;" data-aos="fade-up" data-aos-delay="350">
                <h3>
                    <i class="ri-tooth-line"></i>
                    مخطط الأسنان
                </h3>
                <div class="tooth-diagram-container">
                    <iframe 
                        id="teethIframe" 
                        src="" 
                        frameborder="0"
                        style="width: 100%; height: 700px; border: none; border-radius: 8px;"
                        title="Tooth Diagram">
                    </iframe>
                </div>
            </div>

            <!-- Section Anchor: Bills -->
            <span class="section-anchor" id="patient-bills"></span>
            
            <!-- Bills List -->
            <div class="simple-list" id="billsList" style="display: none;" data-aos="fade-up" data-aos-delay="400">
                <h3>
                    <i class="ri-bill-line"></i>
                    الفواتير
                </h3>
                <div id="billsContainer">
                    <!-- Will be populated dynamically -->
                </div>
            </div>

            <!-- Section Anchor: Appointments -->
            <span class="section-anchor" id="patient-appointments"></span>
            
            <!-- Appointments List -->
            <div class="simple-list" id="appointmentsList" style="display: none;" data-aos="fade-up" data-aos-delay="500">
                <h3>
                    <i class="ri-calendar-check-line"></i>
                    المواعيد
                </h3>
                <div id="appointmentsContainer">
                    <!-- Will be populated dynamically -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Patient Lookup Section End -->
@endsection

@push('scripts')
<!-- QR Code Scanner Library -->
<script src="https://unpkg.com/html5-qrcode"></script>

<script>
    // API Configuration
    const API_URL = '{{ route("api.patient.lookup") }}';
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').content;

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
    const patientProfile = document.getElementById('patientProfile');

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
        const phone = urlParams.get('phone_number') || urlParams.get('phone'); // Check both parameters
        
        if (code && phone) {
            searchInput.value = code;
            fetchPatientData(code, phone);
        } else if (code) {
            searchInput.value = code;
            handleSearch();
        }
    });

    // Handle Search
    async function handleSearch() {
        const code = searchInput.value.trim();
        
        if (!code) {
            showError('Please enter patient code');
            return;
        }
        
        await fetchPatientData(code, null);
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
        qrScannerBtn.innerHTML = '<i class="ri-stop-circle-line"></i> <span>Stop Scanning</span>';
        
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
            showError('Failed to start scanner. Please check camera permission.');
            stopQrScanner();
        });
    }

    // Stop QR Scanner
    function stopQrScanner() {
        if (html5QrCode && isScannerActive) {
            html5QrCode.stop().then(() => {
                qrScannerContainer.style.display = 'none';
                qrScannerBtn.innerHTML = '<i class="ri-qr-scan-2-line"></i> <span>Or Scan QR Code</span>';
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
        
        stopQrScanner();
        
        let code = decodedText;
        
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
        fetchPatientData(code, null);
    }

    // On Scan Error
    function onScanError(errorMessage) {
        // Handle scan error silently
    }

    // Fetch Patient Data from API
    async function fetchPatientData(code, phone = null) {
        hideError();
        showLoading();
        hidePatientProfile();
        
        const requestBody = { code: code };
        
        // Add phone_number to request if provided (for QR code scans)
        if (phone) {
            requestBody.phone_number = phone;
        }
        
        try {
            const response = await fetch(API_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                body: JSON.stringify(requestBody)
            });
            
            const data = await response.json();
            
            if (data.success && data.patient) {
                displayPatientData(data, code);
            } else {
                showError(data.message || 'No patient data found');
            }
        } catch (error) {
            console.error('Error fetching patient data:', error);
            showError('An error occurred while fetching data. Please try again.');
        } finally {
            hideLoading();
        }
    }

    // Display Patient Data
    function displayPatientData(data, patientCode) {
        const patient = data.patient;
        
        // Store patient data globally for booking
        currentPatientData = patient;
        
        // Patient Name and ID
        document.getElementById('patientName').textContent = patient.name;
        document.getElementById('patientId').textContent = `Patient ID: #${patient.id}`;
        
        // Profile Info (Gender, Age, Phone, Email)
        const profileInfo = document.getElementById('profileInfo');
        const sexIcon = patient.sex === 1 ? 'ri-men-line' : 'ri-women-line';
        const sexText = patient.sex === 1 ? 'Male' : 'Female';
        
        profileInfo.innerHTML = `
            <div class="profile-info-item">
                <i class="${sexIcon}"></i>
                <span><strong>Gender:</strong> ${sexText}</span>
            </div>
            <div class="profile-info-item">
                <i class="ri-calendar-line"></i>
                <span><strong>Age:</strong> ${patient.age} years</span>
            </div>
            <div class="profile-info-item">
                <i class="ri-cake-line"></i>
                <span><strong>Date of Birth:</strong> ${formatDate(patient.birth_date)}</span>
            </div>
            <div class="profile-info-item">
                <i class="ri-phone-line"></i>
                <span><strong>Phone:</strong> ${patient.phone || 'Not available'}</span>
            </div>
            ${patient.email ? `
            <div class="profile-info-item">
                <i class="ri-mail-line"></i>
                <span><strong>Email:</strong> ${patient.email}</span>
            </div>
            ` : ''}
            ${patient.address ? `
            <div class="profile-info-item">
                <i class="ri-map-pin-line"></i>
                <span><strong>Address:</strong> ${patient.address}</span>
            </div>
            ` : ''}
            ${patient.systemic_conditions ? `
            <div class="profile-info-item">
                <i class="ri-heart-pulse-line"></i>
                <span><strong>Systemic Conditions:</strong> ${patient.systemic_conditions}</span>
            </div>
            ` : ''}
          
        `;
        
        // Statistics
        displayStatistics(data);
        
        // Tooth Diagram
        displayToothDiagram(patientCode);
        
        // Cases
        if (data.cases && data.cases.length > 0) {
            displayCasesList(data.cases, data.images);
        }
        
        // Bills
        if (data.bills && data.bills.length > 0) {
            displayBillsList(data.bills);
        }
        
        // Appointments
        if (data.reservations && data.reservations.length > 0) {
            displayAppointmentsList(data.reservations);
        }
        
        showPatientProfile();
    }

    // Display Statistics
    function displayStatistics(data) {
        const statsGrid = document.getElementById('statsGrid');
        const bills = data.bills_summary || {};
        
        statsGrid.innerHTML = `
            <div class="stat-box">
                <div class="stat-icon"><i class="ri-heart-pulse-line"></i></div>
                <div class="stat-value">${data.cases_count || 0}</div>
                <div class="stat-label">Medical Cases</div>
            </div>
            <div class="stat-box">
                <div class="stat-icon"><i class="ri-calendar-check-line"></i></div>
                <div class="stat-value">${data.reservations_count || 0}</div>
                <div class="stat-label">Appointments</div>
            </div>
            <div class="stat-box">
                <div class="stat-icon"><i class="ri-money-dollar-circle-line"></i></div>
                <div class="stat-value">${bills.bills_count || 0}</div>
                <div class="stat-label">Total Bills</div>
            </div>
            <div class="stat-box">
                <div class="stat-icon"><i class="ri-checkbox-circle-line"></i></div>
                <div class="stat-value">${bills.paid_count || 0}</div>
                <div class="stat-label">Paid Bills</div>
            </div>
        `;
    }

    // Display Tooth Diagram
    function displayToothDiagram(patientCode) {
        const toothDiagramSection = document.getElementById('toothDiagramSection');
        const teethIframe = document.getElementById('teethIframe');
       
        // Set iframe source to external teeth viewer
        teethIframe.src = `http://localhost:8080/public/teeth/${patientCode}`;
        
        // Show the section
        toothDiagramSection.style.display = 'block';
    }

    // Display Cases List
    function displayCasesList(cases, images) {
        const casesList = document.getElementById('casesList');
        const casesContainer = document.getElementById('casesContainer');
        
        // Build photos HTML (images are at root level, not per case)
        let photosHtml = '';
        if (images && images.length > 0) {
            const photosGrid = images.map(img => `
                <div class="case-photo-item" onclick="window.open('https://smartclinicv5.tctate.com/case_photo/${img.path}', '_blank')">
                    <img src="https://smartclinicv5.tctate.com/case_photo/${img.path}" 
                         alt="صورة الحالة" 
                         onerror="this.parentElement.style.display='none'">
                    <div class="photo-overlay">
                        <i class="ri-image-line"></i>
                    </div>
                </div>
            `).join('');
            
            photosHtml = `
                <div class="case-photos">
                    <div class="case-photos-label">
                        <i class="ri-gallery-line"></i>
                        Medical Photos (${images.length})
                    </div>
                    <div class="case-photos-grid">
                        ${photosGrid}
                    </div>
                </div>
            `;
        }
        
        casesContainer.innerHTML = cases.map((caseItem, index) => `
            <div class="list-item">
                <div class="list-item-header">
                    <div class="list-item-title">
                        <i class="ri-heart-pulse-line"></i>
                        ${translateCategory(caseItem.category)}
                    </div>
                    <div class="list-item-date">${formatDate(caseItem.created_at)}</div>
                </div>
                <div class="list-item-body">
                    ${caseItem.doctor ? `<p><strong>Doctor:</strong> ${caseItem.doctor}</p>` : ''}
                    ${caseItem.chief_complain ? `<p><strong>Complaint:</strong> ${caseItem.chief_complain}</p>` : ''}
                    ${caseItem.diagnosis ? `<p><strong>Diagnosis:</strong> ${caseItem.diagnosis}</p>` : ''}
                    ${caseItem.treatment ? `<p><strong>Treatment:</strong> ${caseItem.treatment}</p>` : ''}
                    ${caseItem.tooth_number ? `<p><strong>Tooth Number:</strong> ${caseItem.tooth_number}</p>` : ''}
                    ${index === 0 ? photosHtml : ''}
                </div>
            </div>
        `).join('');
        
        casesList.style.display = 'block';
    }

    // Display Bills List
    function displayBillsList(bills) {
        const billsList = document.getElementById('billsList');
        const billsContainer = document.getElementById('billsContainer');
        
        billsContainer.innerHTML = bills.map(bill => `
            <div class="list-item">
                <div class="list-item-header">
                    <div class="list-item-title">
                        <i class="ri-bill-line"></i>
                        ${formatCurrency(bill.price)}
                    </div>
                    <span class="status-badge ${bill.is_paid ? 'badge-paid' : 'badge-unpaid'}">
                        ${bill.is_paid ? 'Paid' : 'Unpaid'}
                    </span>
                </div>
                <div class="list-item-body">
                    <p><strong>Date:</strong> ${formatDate(bill.created_at)}</p>
                    ${bill.doctor ? `<p><strong>Doctor:</strong> ${bill.doctor}</p>` : ''}
                    ${bill.payment_date ? `<p><strong>Payment Date:</strong> ${formatDate(bill.payment_date)}</p>` : ''}
                </div>
            </div>
        `).join('');
        
        billsList.style.display = 'block';
    }

    // Display Appointments List
    function displayAppointmentsList(appointments) {
        const appointmentsList = document.getElementById('appointmentsList');
        const appointmentsContainer = document.getElementById('appointmentsContainer');
        
        appointmentsContainer.innerHTML = appointments.map(appointment => `
            <div class="list-item">
                <div class="list-item-header">
                    <div class="list-item-title">
                        <i class="ri-calendar-check-line"></i>
                        ${formatDate(appointment.reservation_start_date)}
                    </div>
                    <span class="status-badge badge-completed">
                        ${appointment.is_waiting ? 'Waiting' : 'Booked'}
                    </span>
                </div>
                <div class="list-item-body">
                    ${appointment.doctor ? `<p><strong>Doctor:</strong> ${appointment.doctor}</p>` : ''}
                    <p><strong>Time:</strong> from ${appointment.reservation_from_time} to ${appointment.reservation_to_time}</p>
                    ${appointment.notes ? `<p><strong>Notes:</strong> ${appointment.notes}</p>` : ''}
                </div>
            </div>
        `).join('');
        
        appointmentsList.style.display = 'block';
    }

    // Utility Functions
    function formatDate(dateString) {
        if (!dateString) return '{{ __("Not available") }}';
        const date = new Date(dateString);
        return date.toLocaleDateString('{{ app()->getLocale() }}', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }

    function formatDateTime(dateString) {
        if (!dateString) return '{{ __("Not available") }}';
        const date = new Date(dateString);
        return date.toLocaleDateString('{{ app()->getLocale() }}', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    function formatCurrency(amount) {
        if (!amount && amount !== 0) return '{{ __("Not available") }}';
        return new Intl.NumberFormat('{{ app()->getLocale() }}', {
            style: 'decimal',
            minimumFractionDigits: 0
        }).format(amount) + ' {{ __("IQD") }}';
    }

    function translateCategory(category) {
        const categories = {
            'endo': 'Root Canal Treatment',
            'ortho': 'Orthodontics',
            'prosth': 'Prosthodontics',
            'perio': 'Periodontics',
            'surgery': 'Oral Surgery',
            'pedo': 'Pediatric Dentistry',
            'general': 'General'
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

    function showPatientProfile() {
        patientProfile.style.display = 'block';
        
        // Show tabs navigation when profile is visible
        const tabs = document.getElementById('patientTabs');
        if (tabs) {
            tabs.style.display = 'block';
        }
        
        // Initialize tab navigation
        initializeTabNavigation();
    }

    function hidePatientProfile() {
        patientProfile.style.display = 'none';
        
        // Hide tabs
        const tabs = document.getElementById('patientTabs');
        if (tabs) {
            tabs.style.display = 'none';
        }
        
        // Hide all lists
        document.getElementById('casesList').style.display = 'none';
        document.getElementById('billsList').style.display = 'none';
        document.getElementById('appointmentsList').style.display = 'none';
    }
    
    /* ============================================
       TAB NAVIGATION - Smooth scrolling & active states
       ============================================ */
    function initializeTabNavigation() {
        const tabLinks = document.querySelectorAll('.tab-link');
        
        // Handle tab clicks - smooth scroll to sections
        tabLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all tabs
                tabLinks.forEach(tab => tab.classList.remove('active'));
                
                // Add active class to clicked tab
                this.classList.add('active');
                
                // Smooth scroll to target section
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Intersection Observer to update active tab on scroll
        const observerOptions = {
            root: null,
            rootMargin: '-100px 0px -60% 0px',
            threshold: 0
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const sectionId = entry.target.id;
                    tabLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href') === `#${sectionId}`) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        }, observerOptions);
        
        // Observe all section anchors
        document.querySelectorAll('.section-anchor').forEach(anchor => {
            observer.observe(anchor);
        });
    }
    
    /* ============================================
       BOOKING BUTTON - Handle appointment booking
       ============================================ */
    
    let currentPatientData = null; // Store current patient data globally
    
    function handleBooking(event) {
        event.preventDefault();
        
        // Get patient data from the displayed information
        const patientCodeElement = document.getElementById('patientId');
        const patientNameElement = document.getElementById('patientName');
        
        if (!patientCodeElement || !patientNameElement || !currentPatientData) {
            alert('Unable to retrieve patient information. Please try again.');
            return;
        }
        
        const patientCode = patientCodeElement.textContent;
        const patientName = patientNameElement.textContent;
        const patientPhone = currentPatientData.phone || '';
        
        // Create booking modal
        showBookingModal(patientCode, patientName, patientPhone);
    }
    
    function showBookingModal(patientCode, patientName, patientPhone) {
        // Create modal HTML
        const modalHTML = `
            <div class="booking-modal-overlay" id="bookingModalOverlay" onclick="closeBookingModal(event)">
                <div class="booking-modal" onclick="event.stopPropagation()">
                    <div class="booking-modal-header">
                        <h3><i class="ri-calendar-check-line"></i> حجز موعد جديد</h3>
                        <button class="modal-close-btn" onclick="closeBookingModal()">&times;</button>
                    </div>
                    <div class="booking-modal-body">
                        <div class="patient-info-summary">
                            <p><strong>اسم المريض:</strong> ${patientName}</p>
                            <p><strong>كود المريض:</strong> ${patientCode}</p>
                        </div>
                        <form id="bookingModalForm" action="{{ route('bookings.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="patient_code" value="${patientCode}">
                            <input type="hidden" name="patient_name" value="${patientName}">
                            
                            <div class="form-group">
                                <label for="modalPatientPhone">
                                    <i class="ri-phone-line"></i>
                                    رقم الهاتف *
                                </label>
                                <input 
                                    type="tel" 
                                    name="patient_phone"
                                    id="modalPatientPhone" 
                                    class="form-control" 
                                    placeholder="أدخل رقم الهاتف"
                                    value="${patientPhone}"
                                    required
                                    dir="rtl"
                                >
                            </div>
                            
                            <div class="form-group">
                                <label for="modalBookingDate">
                                    <i class="ri-calendar-line"></i>
                                    تاريخ الموعد *
                                </label>
                                <input 
                                    type="date" 
                                    name="booking_date"
                                    id="modalBookingDate" 
                                    class="form-control" 
                                    min="${new Date().toISOString().split('T')[0]}"
                                    required
                                    dir="rtl"
                                >
                            </div>
                            
                            <div class="form-group">
                                <label for="modalNotes">
                                    <i class="ri-file-text-line"></i>
                                    ملاحظات (اختياري)
                                </label>
                                <textarea 
                                    name="notes"
                                    id="modalNotes" 
                                    class="form-control" 
                                    placeholder="أدخل أي ملاحظات إضافية"
                                    rows="3"
                                    dir="rtl"
                                ></textarea>
                            </div>
                            
                            <div class="modal-actions">
                                <button type="button" class="btn-cancel" onclick="closeBookingModal()">إلغاء</button>
                                <button type="submit" class="btn-confirm">
                                    <i class="ri-check-line"></i>
                                    تأكيد الحجز
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        `;
        
        // Append modal to body
        document.body.insertAdjacentHTML('beforeend', modalHTML);
        
        // Animate modal in
        setTimeout(() => {
            document.getElementById('bookingModalOverlay').classList.add('show');
        }, 10);
        
        // Add form submit handler
        const form = document.getElementById('bookingModalForm');
        form.addEventListener('submit', handleBookingSubmit);
    }
    
    async function handleBookingSubmit(event) {
        event.preventDefault();
        
        const form = event.target;
        const submitBtn = form.querySelector('.btn-confirm');
        const originalBtnHTML = submitBtn.innerHTML;
        
        // Disable submit button and show loading
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="ri-loader-4-line" style="animation: spin 1s linear infinite;"></i> جاري الحجز...';
        
        // Get form data
        const formData = new FormData(form);
        
        try {
            const response = await fetch('{{ route("bookings.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                // Show success message
                showSuccessMessage('تم الحجز بنجاح! سنتواصل معك قريباً.');
                
                // Close modal after short delay
                setTimeout(() => {
                    closeBookingModal();
                }, 1500);
            } else {
                // Show error message
                showErrorMessage(data.message || 'حدث خطأ أثناء الحجز. حاول مرة أخرى.');
                
                // Re-enable button
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnHTML;
            }
        } catch (error) {
            console.error('Booking error:', error);
            showErrorMessage('حدث خطأ في الاتصال. حاول مرة أخرى.');
            
            // Re-enable button
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnHTML;
        }
    }
    
    function showSuccessMessage(message) {
        // Create success toast
        const toast = document.createElement('div');
        toast.className = 'booking-toast booking-toast-success';
        toast.innerHTML = `
            <i class="ri-check-circle-line"></i>
            <span>${message}</span>
        `;
        document.body.appendChild(toast);
        
        setTimeout(() => toast.classList.add('show'), 10);
        
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
    
    function showErrorMessage(message) {
        // Create error toast
        const toast = document.createElement('div');
        toast.className = 'booking-toast booking-toast-error';
        toast.innerHTML = `
            <i class="ri-error-warning-line"></i>
            <span>${message}</span>
        `;
        document.body.appendChild(toast);
        
        setTimeout(() => toast.classList.add('show'), 10);
        
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
    
    function closeBookingModal(event) {
        if (event && event.target !== event.currentTarget) return;
        
        const overlay = document.getElementById('bookingModalOverlay');
        if (overlay) {
            overlay.classList.remove('show');
            setTimeout(() => {
                overlay.remove();
            }, 300);
        }
    }
</script>
@endpush
