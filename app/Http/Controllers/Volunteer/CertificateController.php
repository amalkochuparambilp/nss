<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CertificateController extends Controller
{
    public function index(Request $request): View
    {
        $volunteer = $request->user()->volunteerProfile;

        $certificates = Certificate::with('event')
            ->where('recipient_id', $volunteer?->id)
            ->where('status', 'issued')
            ->latest()
            ->paginate(15);

        return view('volunteer.certificates.index', compact('certificates'));
    }

    public function show(Certificate $certificate): View
    {
        $volunteer = request()->user()->volunteerProfile;

        if ($certificate->recipient_id !== $volunteer?->id) {
            abort(403);
        }

        return view('volunteer.certificates.show', compact('certificate'));
    }
}
