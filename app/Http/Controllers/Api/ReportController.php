<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * POST /api/reports
     * User membuat laporan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'deskripsi'  => 'required|string',
            'foto_before'=> 'required|image|mimes:jpeg,png,jpg|max:2048',
            'latitude'   => 'required|string',
            'longitude'  => 'required|string',
        ]);

        $fotoPath = $request->file('foto_before')->store('reports', 'public');

        $report = Report::create([
            'user_id'     => $request->user()->id,
            'deskripsi'   => $request->deskripsi,
            'foto_before' => $fotoPath,
            'latitude'    => $request->latitude,
            'longitude'   => $request->longitude,
            'status'      => 'Menunggu',
        ]);

        return response()->json([
            'message' => 'Laporan berhasil dibuat',
            'report'  => $report->load('user'),
        ], 201);
    }

    /**
     * GET /api/reports
     * User melihat semua laporan miliknya.
     */
    public function index(Request $request)
    {
        $reports = Report::where('user_id', $request->user()->id)
            ->with('user')
            ->latest()
            ->get();

        return response()->json([
            'message' => 'Daftar laporan',
            'reports' => $reports,
        ]);
    }

    /**
     * GET /api/reports/{id}
     * User melihat detail laporan miliknya.
     */
    public function show(Request $request, $id)
    {
        $report = Report::where('user_id', $request->user()->id)
            ->with('user')
            ->findOrFail($id);

        return response()->json([
            'message' => 'Detail laporan',
            'report'  => $report,
        ]);
    }
}
