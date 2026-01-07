@extends('layouts.app')

@section('title', 'Bookings Dashboard - ' . config('app.name'))

@section('content')
<!-- Breadcrumb Section Start -->
<div class="breadcrumb-wrap bg-f br-1">
    <div class="container">
        <div class="breadcrumb-title">
            <h2>{{ __('Bookings Dashboard') }}</h2>
            <ul class="breadcrumb-menu list-style">
                <li><a href="{{ route('home') }}">{{ __('general.home') }}</a></li>
                <li>{{ __('Bookings') }}</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Bookings Dashboard Section Start -->
<section class="bookings-dashboard ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bookings-header mb-4">
                    <h2 class="section-title">
                        <i class="ri-calendar-check-line"></i>
                        {{ __('All Bookings') }}
                    </h2>
                    <p class="section-subtitle">{{ __('Manage and track all patient bookings') }}</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="ri-check-circle-line"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($bookings->count() > 0)
                    <!-- Bookings Stats -->
                    <div class="bookings-stats mb-4">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="stat-card pending">
                                    <i class="ri-time-line"></i>
                                    <div class="stat-info">
                                        <h3>{{ $bookings->where('status', 'pending')->count() }}</h3>
                                        <p>{{ __('Pending') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-card confirmed">
                                    <i class="ri-check-line"></i>
                                    <div class="stat-info">
                                        <h3>{{ $bookings->where('status', 'confirmed')->count() }}</h3>
                                        <p>{{ __('Confirmed') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-card completed">
                                    <i class="ri-check-double-line"></i>
                                    <div class="stat-info">
                                        <h3>{{ $bookings->where('status', 'completed')->count() }}</h3>
                                        <p>{{ __('Completed') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-card cancelled">
                                    <i class="ri-close-line"></i>
                                    <div class="stat-info">
                                        <h3>{{ $bookings->where('status', 'cancelled')->count() }}</h3>
                                        <p>{{ __('Cancelled') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bookings Table -->
                    <div class="bookings-table-wrapper">
                        <div class="table-responsive">
                            <table class="table bookings-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Patient Name') }}</th>
                                        <th>{{ __('Patient Code') }}</th>
                                        <th>{{ __('Phone') }}</th>
                                        <th>{{ __('Booking Date') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Notes') }}</th>
                                        <th>{{ __('Created At') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                        <tr>
                                            <td>{{ $booking->id }}</td>
                                            <td>
                                                <div class="patient-info">
                                                    <i class="ri-user-line"></i>
                                                    <span>{{ $booking->patient_name ?? 'N/A' }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                @if($booking->patient_code)
                                                    <span class="badge badge-code">{{ $booking->patient_code }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="phone-info">
                                                    <i class="ri-phone-line"></i>
                                                    <span>{{ $booking->patient_phone }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="date-info">
                                                    <i class="ri-calendar-line"></i>
                                                    <span>{{ $booking->booking_date->format('Y-m-d') }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-status badge-{{ $booking->status }}">
                                                    @if($booking->status == 'pending')
                                                        <i class="ri-time-line"></i> {{ __('Pending') }}
                                                    @elseif($booking->status == 'confirmed')
                                                        <i class="ri-check-line"></i> {{ __('Confirmed') }}
                                                    @elseif($booking->status == 'completed')
                                                        <i class="ri-check-double-line"></i> {{ __('Completed') }}
                                                    @else
                                                        <i class="ri-close-line"></i> {{ __('Cancelled') }}
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                @if($booking->notes)
                                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#notesModal{{ $booking->id }}">
                                                        <i class="ri-file-text-line"></i> {{ __('View') }}
                                                    </button>
                                                    
                                                    <!-- Notes Modal -->
                                                    <div class="modal fade" id="notesModal{{ $booking->id }}" tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">{{ __('Booking Notes') }}</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>{{ $booking->notes }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="text-muted">{{ $booking->created_at->format('Y-m-d H:i') }}</span>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    @if($booking->status != 'completed' && $booking->status != 'cancelled')
                                                        <form action="{{ route('bookings.updateStatus', $booking) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="{{ $booking->status == 'pending' ? 'confirmed' : 'completed' }}">
                                                            <button type="submit" class="btn btn-sm btn-success" title="{{ $booking->status == 'pending' ? __('Confirm') : __('Complete') }}">
                                                                <i class="{{ $booking->status == 'pending' ? 'ri-check-line' : 'ri-check-double-line' }}"></i>
                                                            </button>
                                                        </form>
                                                        
                                                        <form action="{{ route('bookings.updateStatus', $booking) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="cancelled">
                                                            <button type="submit" class="btn btn-sm btn-warning" title="{{ __('Cancel') }}">
                                                                <i class="ri-close-line"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    
                                                    <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this booking?') }}')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="{{ __('Delete') }}">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-wrapper mt-4">
                        {{ $bookings->links() }}
                    </div>
                @else
                    <div class="no-bookings-card">
                        <div class="icon-wrapper">
                            <i class="ri-calendar-close-line"></i>
                        </div>
                        <h3>{{ __('No Bookings Yet') }}</h3>
                        <p>{{ __('There are no bookings to display at the moment.') }}</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            <i class="ri-arrow-left-line"></i>
                            {{ __('Go to Home') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- Bookings Dashboard Section End -->

<style>
/* Bookings Dashboard Styles */
.bookings-dashboard {
    background: #f8f9fa;
    min-height: 70vh;
}

.bookings-header {
    text-align: center;
}

.section-title {
    font-size: 2rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
}

.section-title i {
    color: #10b981;
    font-size: 2.5rem;
}

.section-subtitle {
    color: #64748b;
    font-size: 1.1rem;
}

/* Stats Cards */
.bookings-stats {
    margin-bottom: 2rem;
}

.stat-card {
    background: #ffffff;
    padding: 1.5rem;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: all 0.3s ease;
    border-left: 4px solid;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
}

.stat-card i {
    font-size: 2.5rem;
    opacity: 0.9;
}

.stat-card.pending {
    border-color: #f59e0b;
}

.stat-card.pending i {
    color: #f59e0b;
}

.stat-card.confirmed {
    border-color: #3b82f6;
}

.stat-card.confirmed i {
    color: #3b82f6;
}

.stat-card.completed {
    border-color: #10b981;
}

.stat-card.completed i {
    color: #10b981;
}

.stat-card.cancelled {
    border-color: #ef4444;
}

.stat-card.cancelled i {
    color: #ef4444;
}

.stat-info h3 {
    margin: 0;
    font-size: 2rem;
    font-weight: 700;
    color: #1e293b;
}

.stat-info p {
    margin: 0;
    color: #64748b;
    font-size: 0.95rem;
}

/* Table Styles */
.bookings-table-wrapper {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.bookings-table {
    margin: 0;
}

.bookings-table thead {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
}

.bookings-table thead th {
    color: #ffffff;
    font-weight: 600;
    padding: 1rem;
    border: none;
    white-space: nowrap;
}

.bookings-table tbody tr {
    transition: background 0.2s ease;
}

.bookings-table tbody tr:hover {
    background: #f8fafc;
}

.bookings-table tbody td {
    padding: 1rem;
    vertical-align: middle;
    border-color: #f1f5f9;
}

.patient-info,
.phone-info,
.date-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.95rem;
}

.patient-info i,
.phone-info i,
.date-info i {
    color: #10b981;
    font-size: 1.1rem;
}

.badge-code {
    background: #f1f5f9;
    color: #1e293b;
    padding: 0.375rem 0.75rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.85rem;
}

.badge-status {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
}

.badge-pending {
    background: #fef3c7;
    color: #92400e;
}

.badge-confirmed {
    background: #dbeafe;
    color: #1e40af;
}

.badge-completed {
    background: #d1fae5;
    color: #065f46;
}

.badge-cancelled {
    background: #fee2e2;
    color: #991b1b;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.action-buttons .btn {
    padding: 0.375rem 0.625rem;
}

/* No Bookings Card */
.no-bookings-card {
    background: #ffffff;
    padding: 4rem 2rem;
    border-radius: 16px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.no-bookings-card .icon-wrapper {
    width: 100px;
    height: 100px;
    background: #f1f5f9;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
}

.no-bookings-card .icon-wrapper i {
    font-size: 3rem;
    color: #64748b;
}

.no-bookings-card h3 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.5rem;
}

.no-bookings-card p {
    color: #64748b;
    font-size: 1.1rem;
    margin-bottom: 2rem;
}

/* Responsive */
@media (max-width: 768px) {
    .bookings-table-wrapper {
        overflow-x: auto;
    }
    
    .section-title {
        font-size: 1.5rem;
    }
    
    .stat-card {
        margin-bottom: 1rem;
    }
}
</style>
@endsection
