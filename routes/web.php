<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Public\PublicController::class, 'index'])->name('home');
Route::get('/about', [\App\Http\Controllers\Public\PublicController::class, 'about'])->name('about');
Route::get('/events', [\App\Http\Controllers\Public\PublicController::class, 'events'])->name('events');
Route::get('/events/{event}', [\App\Http\Controllers\Public\PublicController::class, 'eventDetails'])->name('event-details');
Route::get('/impact', [\App\Http\Controllers\Public\PublicController::class, 'impact'])->name('impact');
Route::get('/privacy', [\App\Http\Controllers\Public\PublicController::class, 'privacy'])->name('privacy');
Route::get('/terms', [\App\Http\Controllers\Public\PublicController::class, 'terms'])->name('terms');
Route::get('/contact', [\App\Http\Controllers\Public\PublicController::class, 'contact'])->name('contact');

Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register']);

Route::get('/forgot-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/email/verify', [\App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [\App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/resend', [\App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->hasRole('volunteer')) {
            return redirect()->route('volunteer.dashboard');
        } elseif ($user->hasRole('programme_officer')) {
            return redirect()->route('officer.dashboard');
        } elseif ($user->hasRole('college_admin')) {
            return redirect()->route('institution.dashboard');
        } elseif ($user->hasRole('super_admin')) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('home');
    })->name('dashboard');
});

Route::middleware(['auth', 'role:volunteer'])->prefix('volunteer')->name('volunteer.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Volunteer\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [\App\Http\Controllers\Volunteer\ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [\App\Http\Controllers\Volunteer\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\Volunteer\ProfileController::class, 'update'])->name('profile.update');

    Route::get('/events', [\App\Http\Controllers\Volunteer\EventController::class, 'index'])->name('events');
    Route::get('/events/{event}', [\App\Http\Controllers\Volunteer\EventController::class, 'show'])->name('events.show');
    Route::get('/my-registrations', [\App\Http\Controllers\Volunteer\EventController::class, 'myRegistrations'])->name('my-registrations');
    Route::post('/events/{event}/register', [\App\Http\Controllers\Volunteer\EventController::class, 'register'])->name('events.register');
    Route::post('/events/{event}/cancel', [\App\Http\Controllers\Volunteer\EventController::class, 'cancelRegistration'])->name('events.cancel');

    Route::get('/service-hours', [\App\Http\Controllers\Volunteer\ServiceHourController::class, 'index'])->name('service-hours');
    Route::get('/service-hours/create', [\App\Http\Controllers\Volunteer\ServiceHourController::class, 'create'])->name('service-hours.create');
    Route::post('/service-hours', [\App\Http\Controllers\Volunteer\ServiceHourController::class, 'store'])->name('service-hours.store');
    Route::get('/service-hours/{record}', [\App\Http\Controllers\Volunteer\ServiceHourController::class, 'show'])->name('service-hours.show');

    Route::get('/attendance', [\App\Http\Controllers\Volunteer\AttendanceController::class, 'index'])->name('attendance');
    Route::get('/certificates', [\App\Http\Controllers\Volunteer\CertificateController::class, 'index'])->name('certificates');
    Route::get('/certificates/{certificate}', [\App\Http\Controllers\Volunteer\CertificateController::class, 'show'])->name('certificates.show');

    Route::get('/notifications', [\App\Http\Controllers\Volunteer\NotificationController::class, 'index'])->name('notifications');
    Route::post('/notifications/{notification}/read', [\App\Http\Controllers\Volunteer\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [\App\Http\Controllers\Volunteer\NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
});

Route::middleware(['auth', 'role:programme_officer'])->prefix('officer')->name('officer.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Officer\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/volunteers', [\App\Http\Controllers\Officer\VolunteerController::class, 'index'])->name('volunteers');
    Route::get('/volunteers/{volunteer}', [\App\Http\Controllers\Officer\VolunteerController::class, 'show'])->name('volunteers.show');
    Route::post('/volunteers/{volunteer}/approve', [\App\Http\Controllers\Officer\VolunteerController::class, 'approve'])->name('volunteers.approve');
    Route::post('/volunteers/{volunteer}/reject', [\App\Http\Controllers\Officer\VolunteerController::class, 'reject'])->name('volunteers.reject');

    Route::get('/events', [\App\Http\Controllers\Officer\EventController::class, 'index'])->name('events');
    Route::get('/events/new', [\App\Http\Controllers\Officer\EventController::class, 'create'])->name('events.create');
    Route::post('/events', [\App\Http\Controllers\Officer\EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}', [\App\Http\Controllers\Officer\EventController::class, 'show'])->name('events.show');
    Route::get('/events/{event}/edit', [\App\Http\Controllers\Officer\EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [\App\Http\Controllers\Officer\EventController::class, 'update'])->name('events.update');
    Route::post('/events/{event}/cancel', [\App\Http\Controllers\Officer\EventController::class, 'cancel'])->name('events.cancel');

    Route::get('/attendance', [\App\Http\Controllers\Officer\AttendanceController::class, 'index'])->name('attendance');
    Route::get('/attendance/{event}', [\App\Http\Controllers\Officer\AttendanceController::class, 'show'])->name('attendance.show');
    Route::post('/attendance/{event}', [\App\Http\Controllers\Officer\AttendanceController::class, 'store'])->name('attendance.store');
    Route::post('/attendance/{event}/finalize', [\App\Http\Controllers\Officer\AttendanceController::class, 'finalize'])->name('attendance.finalize');

    Route::get('/service-hours', [\App\Http\Controllers\Officer\ServiceHourController::class, 'index'])->name('service-hours');
    Route::get('/service-hours/{record}', [\App\Http\Controllers\Officer\ServiceHourController::class, 'show'])->name('service-hours.show');
    Route::post('/service-hours/{record}/approve', [\App\Http\Controllers\Officer\ServiceHourController::class, 'approve'])->name('service-hours.approve');
    Route::post('/service-hours/{record}/reject', [\App\Http\Controllers\Officer\ServiceHourController::class, 'reject'])->name('service-hours.reject');

    Route::get('/announcements', [\App\Http\Controllers\Officer\AnnouncementController::class, 'index'])->name('announcements');
    Route::get('/announcements/create', [\App\Http\Controllers\Officer\AnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('/announcements', [\App\Http\Controllers\Officer\AnnouncementController::class, 'store'])->name('announcements.store');
    Route::delete('/announcements/{announcement}', [\App\Http\Controllers\Officer\AnnouncementController::class, 'destroy'])->name('announcements.destroy');

    Route::get('/certificates', [\App\Http\Controllers\Officer\CertificateController::class, 'index'])->name('certificates');
    Route::get('/certificates/create', [\App\Http\Controllers\Officer\CertificateController::class, 'create'])->name('certificates.create');
    Route::post('/certificates', [\App\Http\Controllers\Officer\CertificateController::class, 'store'])->name('certificates.store');
    Route::get('/certificates/{certificate}', [\App\Http\Controllers\Officer\CertificateController::class, 'show'])->name('certificates.show');
    Route::post('/certificates/{certificate}/revoke', [\App\Http\Controllers\Officer\CertificateController::class, 'revoke'])->name('certificates.revoke');
});

Route::middleware(['auth', 'role:college_admin'])->prefix('institution')->name('institution.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Institution\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/units', [\App\Http\Controllers\Institution\UnitController::class, 'index'])->name('units');
    Route::get('/units/create', [\App\Http\Controllers\Institution\UnitController::class, 'create'])->name('units.create');
    Route::post('/units', [\App\Http\Controllers\Institution\UnitController::class, 'store'])->name('units.store');
    Route::get('/units/{unit}/edit', [\App\Http\Controllers\Institution\UnitController::class, 'edit'])->name('units.edit');
    Route::put('/units/{unit}', [\App\Http\Controllers\Institution\UnitController::class, 'update'])->name('units.update');

    Route::get('/reports', [\App\Http\Controllers\Institution\ReportController::class, 'index'])->name('reports');
    Route::get('/reports/{report}', [\App\Http\Controllers\Institution\ReportController::class, 'show'])->name('reports.show');
    Route::post('/reports/{report}/review', [\App\Http\Controllers\Institution\ReportController::class, 'review'])->name('reports.review');
    Route::get('/reports/export', [\App\Http\Controllers\Institution\ReportController::class, 'export'])->name('reports.export');

    Route::get('/audit-logs', [\App\Http\Controllers\Institution\AuditLogController::class, 'index'])->name('audit-logs');
});

Route::middleware(['auth', 'role:super_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/institutions', [\App\Http\Controllers\Admin\InstitutionController::class, 'index'])->name('institutions');
    Route::get('/institutions/create', [\App\Http\Controllers\Admin\InstitutionController::class, 'create'])->name('institutions.create');
    Route::post('/institutions', [\App\Http\Controllers\Admin\InstitutionController::class, 'store'])->name('institutions.store');
    Route::get('/institutions/{institution}', [\App\Http\Controllers\Admin\InstitutionController::class, 'show'])->name('institutions.show');
    Route::get('/institutions/{institution}/edit', [\App\Http\Controllers\Admin\InstitutionController::class, 'edit'])->name('institutions.edit');
    Route::put('/institutions/{institution}', [\App\Http\Controllers\Admin\InstitutionController::class, 'update'])->name('institutions.update');
    Route::delete('/institutions/{institution}', [\App\Http\Controllers\Admin\InstitutionController::class, 'destroy'])->name('institutions.destroy');

    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users');
    Route::get('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/audit-logs', [\App\Http\Controllers\Admin\AuditLogController::class, 'index'])->name('audit-logs');
});
