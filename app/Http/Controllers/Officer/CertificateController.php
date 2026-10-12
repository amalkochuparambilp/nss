<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Event;
use App\Models\VolunteerProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CertificateController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $units = $user->officerAssignments()->where('is_active', true)->pluck('unit_id');

        $certificates = Certificate::with(['recipient.user', 'event', 'issuer'])
            ->whereHas('recipient', function ($query) use ($units) {
                $query->whereIn('unit_id', $units);
            })
            ->latest()
            ->paginate(15);

        return view('officer.certificates.index', compact('certificates'));
    }

    public function create(): View
    {
        $user = Auth::user();
        $units = $user->officerAssignments()->where('is_active', true)->pluck('unit_id');
        $volunteers = VolunteerProfile::whereIn('unit_id', $units)->where('status', 'approved')->get();
        $events = Event::whereIn('unit_id', $units)->where('status', 'completed')->get();

        return view('officer.certificates.create', compact('volunteers', 'events'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'recipient_id' => ['required', 'exists:volunteer_profiles,id'],
            'certificate_type' => ['required', 'string', 'max:100'],
            'event_id' => ['nullable', 'exists:events,id'],
        ]);

        $reference = 'NSS-' . strtoupper(Str::random(10));

        while (Certificate::where('reference_number', $reference)->exists()) {
            $reference = 'NSS-' . strtoupper(Str::random(10));
        }

        $certificate = Certificate::create([
            'recipient_id' => $validated['recipient_id'],
            'issuer_id' => Auth::id(),
            'certificate_type' => $validated['certificate_type'],
            'event_id' => $validated['event_id'] ?? null,
            'issue_date' => now()->toDateString(),
            'reference_number' => $reference,
        ]);

        return redirect()->route('officer.certificates.show', $certificate)->with('success', 'Certificate issued successfully.');
    }

    public function show(Certificate $certificate): View
    {
        $certificate->load(['recipient.user', 'event', 'issuer']);

        return view('officer.certificates.show', compact('certificate'));
    }

    public function revoke(Request $request, Certificate $certificate): RedirectResponse
    {
        if ($certificate->status === Certificate::STATUS_REVOKED) {
            return back()->with('error', 'Certificate is already revoked.');
        }

        $validated = $request->validate([
            'revocation_reason' => ['required', 'string', 'max:500'],
        ]);

        $certificate->update([
            'status' => Certificate::STATUS_REVOKED,
            'revoked_at' => now(),
            'revocation_reason' => $validated['revocation_reason'],
        ]);

        return back()->with('success', 'Certificate revoked successfully.');
    }
}
