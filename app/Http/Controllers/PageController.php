<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Kamar;
use App\Models\Reservasi;
use App\Models\Ulasan;
use App\Models\Galeri;
use App\Models\User;
use App\Models\Refund;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function Beranda()
    {
        $ulasan = \App\Models\Ulasan::orderBy('tgl_ulasan', 'DESC')
            ->take(4)
            ->get();

        $rooms = \App\Models\Kamar::whereNotNull('foto_kamar')
            ->whereNotNull('foto_kamar')
            ->orderBy('id_tipe_villa', 'asc')
            ->get();

        $featuredRooms = $rooms->groupBy('kategori')
            ->map->first()
            ->take(3);


        return view('pages.beranda', compact('ulasan', 'featuredRooms'));
    }


    public function Tentang()
    {
        return view('pages.tentang');
    }

    public function Kebijakan()
    {
        return view('pages.kebijakan');
    }

    public function Akomodasi(Request $request)
    {
        $search = $request->input('search');
        $checkInDate = $request->input('check_in') ?? now()->format('Y-m-d');
        $checkOutDate = $request->input('check_out') ?? now()->addDay()->format('Y-m-d');

        $query = Kamar::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_unit', 'LIKE', "%{$search}%")
                    ->orWhere('kategori', 'LIKE', "%{$search}%")
                    ->orWhere('kode_tipe', 'LIKE', "%{$search}%")
                    ->orWhere('deskripsi', 'LIKE', "%{$search}%")
                    ->orWhere('harga_weekday', 'LIKE', "%{$search}%")
                    ->orWhere('harga_weekend', 'LIKE', "%{$search}%");
            });
        }

        $query->where('status', '!=', 'Nonaktif');

        $rooms = $query->orderBy('id_tipe_villa', 'asc')->paginate(4);

        $featuredRooms = Kamar::where('status', 'Tersedia')
            ->whereNotNull('foto_kamar')
            ->inRandomOrder()
            ->limit(5)
            ->get();

        if ($featuredRooms->isEmpty()) {
            $featuredRooms = Kamar::where('status', 'Tersedia')
                ->inRandomOrder()
                ->limit(5)
                ->get();
        }

        foreach ($rooms as $room) {
            $room->average_rating = Ulasan::whereHas('reservasi', function ($q) use ($room) {
                $q->where('id_tipe_villa', $room->id_tipe_villa);
            })->avg('rating') ?? 0;

            $hasConflict = Reservasi::where('id_tipe_villa', $room->id_tipe_villa)
                ->whereIn('status', ['Menunggu', 'Dikonfirmasi'])
                ->where('tgl_checkin', '<=', $checkOutDate)
                ->where('tgl_checkout', '>=', $checkInDate)
                ->exists();

            $room->is_available = !$hasConflict;
        }

        return view('pages.akomodasi', compact('rooms', 'featuredRooms', 'checkInDate', 'checkOutDate'));
    }

    public function detailAkomodasi(Request $request, $id)
    {
        $room = Kamar::findOrFail($id);

        $checkInDate = session('checked_dates.check_in') ?? $request->input('check_in') ?? now()->format('Y-m-d');
        $checkOutDate = session('checked_dates.check_out') ?? $request->input('check_out') ?? now()->addDay()->format('Y-m-d');

        $today = date('Y-m-d');

        $totalKamar = Kamar::where('id_tipe_villa', $room->id_tipe_villa)
            ->where('status', '!=', 'Nonaktif')
            ->count();

        $bookedKamarToday = Reservasi::where('id_tipe_villa', $room->id_tipe_villa)
            ->whereIn('status', ['Menunggu', 'Dikonfirmasi'])
            ->where('tgl_checkin', '<=', $today)
            ->where('tgl_checkout', '>=', $today)
            ->count();

        $availableToday = $totalKamar - $bookedKamarToday;
        $statusToday = $availableToday > 0 ? 'Tersedia' : 'Tidak Tersedia';
        $availableRoomsToday = $availableToday;

        $bookedKamarSelected = Reservasi::where('id_tipe_villa', $room->id_tipe_villa)
            ->whereIn('status', ['Menunggu', 'Dikonfirmasi'])
            ->where('tgl_checkin', '<=', $checkOutDate)
            ->where('tgl_checkout', '>=', $checkInDate)
            ->count();

        $availableSelected = $totalKamar - $bookedKamarSelected;

        if (session()->has('availability_status')) {
            $statusSelected = session('status_display');
            $availableRoomsSelected = session('available_rooms');
            $isAvailable = session('availability_status') === 'available';
        } else {
            $statusSelected = $availableSelected > 0 ? 'Tersedia' : 'Tidak Tersedia';
            $availableRoomsSelected = $availableSelected;
            $isAvailable = $availableSelected > 0 && $room->status != 'Nonaktif';
        }

        $ulasan = Ulasan::whereHas('reservasi', function ($query) use ($room) {
            $query->where('id_tipe_villa', $room->id_tipe_villa);
        })
            ->with(['user', 'reservasi'])
            ->latest('tgl_ulasan')
            ->take(4)
            ->get();

        $averageRating = $ulasan->avg('rating') ?? 0;
        $totalUlasan = $ulasan->count();

        $canReview = false;
        $completedReservations = collect();

        if (Auth::check()) {
            $completedReservations = Reservasi::where('id_user', Auth::id())
                ->where('id_tipe_villa', $room->id_tipe_villa)
                ->where('status', 'Selesai')
                ->whereDoesntHave('ulasan')
                ->orderBy('tgl_checkout', 'desc')
                ->get();

            $canReview = Reservasi::where('id_user', Auth::id())
                ->where('id_tipe_villa', $room->id_tipe_villa)
                ->where('status', 'Selesai')
                ->exists();
        }

        return view('pages.detailakomodasi', compact(
            'room',
            'ulasan',
            'averageRating',
            'totalUlasan',
            'canReview',
            'completedReservations',
            'statusToday',
            'availableRoomsToday',
            'statusSelected',
            'availableRoomsSelected',
            'checkInDate',
            'checkOutDate',
            'isAvailable'
        ));
    }

    public function checkAvailability(Request $request)
    {
        $request->validate([
            'id_tipe_villa' => 'required|exists:tipe_villa,id_tipe_villa',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        $totalKamar = Kamar::where('id_tipe_villa', $request->id_tipe_villa)
            ->where('status', '!=', 'Nonaktif')
            ->count();

      
        $bookedKamar = Reservasi::where('id_tipe_villa', $request->id_tipe_villa)
            ->whereIn('status', ['Menunggu', 'Dikonfirmasi'])
            ->where('tgl_checkin', '<=', $request->check_out)  
            ->where('tgl_checkout', '>=', $request->check_in) 
            ->count();

        $availableKamar = $totalKamar - $bookedKamar;

        if ($availableKamar <= 0) {
            return back()
                ->withInput()
                ->with('availability_status', 'unavailable')
                ->with('availability_message', 'Maaf, kamar tidak tersedia untuk tanggal yang dipilih.')
                ->with('available_rooms', 0)
                ->with('status_display', 'Tidak Tersedia')
                ->with('checked_dates', [
                    'check_in' => $request->check_in,
                    'check_out' => $request->check_out
                ]);
        }

        return back()
            ->withInput()
            ->with('availability_status', 'available')
            ->with('availability_message', "Tersedia $availableKamar kamar!")
            ->with('available_rooms', $availableKamar)
            ->with('status_display', 'Tersedia')
            ->with('checked_dates', [
                'check_in' => $request->check_in,
                'check_out' => $request->check_out
            ]);
    }

    public function storeUlasan(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->back()
                ->with('error_ulasan', 'Anda harus login terlebih dahulu untuk memberikan ulasan.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|min:10',
            'id_tipe_villa' => 'required|exists:tipe_villa,id_tipe_villa',
        ], [
            'rating.required' => 'Rating harus dipilih.',
            'komentar.required' => 'Komentar harus diisi.',
            'komentar.min' => 'Komentar minimal 10 karakter.',
        ]);

        $hasCompletedReservation = Reservasi::where('id_user', Auth::id())
            ->where('id_tipe_villa', $request->id_tipe_villa)
            ->where('status', 'Selesai')
            ->exists();

        if (!$hasCompletedReservation) {
            return redirect()->back()
                ->with('error_ulasan', 'Anda harus menyelesaikan reservasi terlebih dahulu untuk memberikan ulasan.');
        }

        $existingUlasan = Ulasan::whereHas('reservasi', function ($query) use ($request) {
            $query->where('id_tipe_villa', $request->id_tipe_villa);
        })
            ->where('id_user', Auth::id())
            ->exists();

        if ($existingUlasan) {
            return redirect()->back()
                ->with('error_ulasan', 'Anda sudah memberikan ulasan untuk villa ini.');
        }

        $reservasi = Reservasi::where('id_user', Auth::id())
            ->where('id_tipe_villa', $request->id_tipe_villa)
            ->where('status', 'Selesai')
            ->orderBy('tgl_checkout', 'desc')
            ->first();

        Ulasan::create([
            'id_reservasi' => $reservasi->id_reservasi,
            'id_user' => Auth::id(),
            'rating' => $request->rating,
            'isi_ulasan' => $request->komentar,
            'tgl_ulasan' => now()->toDateString(),
        ]);

        return redirect()->back()
            ->with('success_ulasan', 'Terima kasih! Ulasan Anda telah berhasil dikirim.');
    }

    public function Fasilitas()
    {
        return view('pages.fasilitas');
    }

    public function Galeri()
    {
        $photos = Galeri::paginate(6);

        return view('pages.galeri', compact('photos'));
    }

    public function Booking(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk melakukan booking.');
        }

        $user = Auth::user();

        $selectedRoom = null;
        if ($request->has('room')) {
            $selectedRoom = Kamar::find($request->room);
        }

        $rooms = Kamar::where('status', '!=', 'Nonaktif')
            ->orderBy('kategori', 'asc')
            ->get();

        $checkIn = $request->input('check_in', now()->format('Y-m-d'));
        $checkOut = $request->input('check_out', now()->addDay()->format('Y-m-d'));

        return view('pages.booking', compact('user', 'selectedRoom', 'rooms', 'checkIn', 'checkOut'));
    }

    public function storeBooking(Request $request)
    {
        $validated = $request->validate([
            'id_tipe_villa' => 'required|exists:tipe_villa,id_tipe_villa',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'total_harga' => 'required|numeric|min:0',
            'nama_pemilik' => 'required|string|max:100',
            'nama_bank' => 'required|string|max:50',
            'nomor_rekening' => 'required|string|max:30',
            'metode_pembayaran' => 'required|in:Transfer Bank,Kartu Kredit,E-Wallet',
            'bukti_pembayaran' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ], [
            'id_tipe_villa.required' => 'Pilih tipe villa terlebih dahulu.',
            'id_tipe_villa.exists' => 'Tipe villa tidak valid.',
            'check_in.required' => 'Tanggal check-in harus diisi.',
            'check_in.after_or_equal' => 'Tanggal check-in tidak boleh sebelum hari ini.',
            'check_out.required' => 'Tanggal check-out harus diisi.',
            'check_out.after' => 'Tanggal check-out harus setelah check-in.',
            'total_harga.required' => 'Total harga harus diisi.',
            'total_harga.min' => 'Total harga tidak valid.',
            'nama_pemilik.required' => 'Nama pemilik rekening harus diisi.',
            'nama_pemilik.max' => 'Nama pemilik maksimal 100 karakter.',
            'nama_bank.required' => 'Nama bank harus diisi.',
            'nama_bank.max' => 'Nama bank maksimal 50 karakter.',
            'nomor_rekening.required' => 'Nomor rekening harus diisi.',
            'nomor_rekening.max' => 'Nomor rekening maksimal 30 karakter.',
            'metode_pembayaran.required' => 'Metode pembayaran harus dipilih.',
            'metode_pembayaran.in' => 'Metode pembayaran tidak valid.',
            'bukti_pembayaran.required' => 'Bukti pembayaran harus diupload.',
            'bukti_pembayaran.mimes' => 'Bukti pembayaran harus berupa file jpeg, png, jpg, atau pdf.',
            'bukti_pembayaran.max' => 'Ukuran file maksimal 2MB.',
        ]);

        $hasConflict = Reservasi::where('id_tipe_villa', $request->id_tipe_villa)
            ->whereIn('status', ['Menunggu', 'Dikonfirmasi'])
            ->where(function ($query) use ($request) {
                $query->whereBetween('tgl_checkin', [$request->check_in, $request->check_out])
                    ->orWhereBetween('tgl_checkout', [$request->check_in, $request->check_out])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('tgl_checkin', '<=', $request->check_in)
                            ->where('tgl_checkout', '>=', $request->check_out);
                    });
            })
            ->exists();

        if ($hasConflict) {
            return redirect()->back()
                ->with('error', 'Maaf, kamar tidak tersedia untuk tanggal yang dipilih.')
                ->withInput();
        }

        $buktiBayar = null;

        try {
            DB::beginTransaction();
            $lastReservasi = Reservasi::orderBy('id_reservasi', 'desc')->first();
            $nextNumber = $lastReservasi ? ($lastReservasi->id_reservasi + 1) : 1;
            $kodeReservasi = 'RES-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

            $reservasi = Reservasi::create([
                'kode_reservasi' => $kodeReservasi,
                'id_user' => Auth::id(),
                'id_tipe_villa' => $request->id_tipe_villa,
                'tgl_checkin' => $request->check_in,
                'tgl_checkout' => $request->check_out,
                'total_harga' => $request->total_harga,
                'status' => 'Menunggu',
            ]);

            if ($request->hasFile('bukti_pembayaran')) {
                $file = $request->file('bukti_pembayaran');
                $fileName = time() . '_' . $file->getClientOriginalName();

                $uploadPath = public_path('uploads/bukti_pembayaran');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                $file->move($uploadPath, $fileName);
                $buktiBayar = 'uploads/bukti_pembayaran/' . $fileName;
            }

            $lastPembayaran = Pembayaran::orderBy('id_pembayaran', 'desc')->first();
            $nextPayNumber = $lastPembayaran ? ($lastPembayaran->id_pembayaran + 1) : 1;
            $kodePembayaran = 'PAY-' . str_pad($nextPayNumber, 6, '0', STR_PAD_LEFT);

            Pembayaran::create([
                'id_reservasi' => $reservasi->id_reservasi,
                'kode_pembayaran' => $kodePembayaran,
                'tgl_pembayaran' => now()->format('Y-m-d'),
                'bukti_pembayaran' => $buktiBayar,
                'nomor_rekening' => $request->nomor_rekening,
                'nama_pemilik' => $request->nama_pemilik,
                'nama_bank' => $request->nama_bank,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status' => 'Menunggu',
            ]);

            $this->updateRoomStatus($request->id_tipe_villa);

            DB::commit();

            return redirect()->route('pages.pembayaransukses', $reservasi->id_reservasi)
                ->with('success', 'Reservasi dan pembayaran berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollback();

            if (isset($buktiBayar) && file_exists(public_path($buktiBayar))) {
                unlink(public_path($buktiBayar));
            }

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    private function updateRoomStatus($roomId)
    {
        $kamar = Kamar::findOrFail($roomId);

        if ($kamar->status == 'Nonaktif') {
            return;
        }

        $today = date('Y-m-d');

        $isOccupied = Reservasi::where('id_tipe_villa', $kamar->id_tipe_villa)
            ->where('status', 'Dikonfirmasi')
            ->where('tgl_checkin', '<=', $today)
            ->where('tgl_checkout', '>', $today)
            ->exists();

        if ($isOccupied) {
            $kamar->update(['status' => 'Terisi']);
            return;
        }

        $hasReservation = Reservasi::where('id_tipe_villa', $kamar->id_tipe_villa)
            ->whereIn('status', ['Menunggu', 'Dikonfirmasi'])
            ->where('tgl_checkin', '>', $today)
            ->exists();

        if ($hasReservation) {
            $kamar->update(['status' => 'Dipesan']);
            return;
        }

        $kamar->update(['status' => 'Tersedia']);
    }
    public function pembayaranSukses($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $reservasi = Reservasi::with(['kamar', 'pembayaran'])
            ->where('id_reservasi', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        return view('pages.pembayaransukses', compact('reservasi'));
    }

    public function riwayatpembayaran()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $pembayarans = Pembayaran::with(['reservasi.kamar', 'reservasi.user'])
            ->whereHas('reservasi', function ($query) {
                $query->where('id_user', Auth::id());
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.riwayatpembayaran', compact('pembayarans'));
    }

    public function riwayatreservasi()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $reservasis = Reservasi::with(['kamar', 'pembayaran'])
            ->where('id_user', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.riwayatreservasi', compact('reservasis'));
    }

    public function storeRefund(Request $request)
    {
        $request->validate([
            'id_pembayaran'     => 'required|exists:pembayaran,id_pembayaran',
            'id_reservasi'      => 'required|exists:reservasi,id_reservasi',
            'alasan_refund'     => 'required|string|max:500',
            'bukti_pendukung'   => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'nama_bank_tujuan'  => 'required|string|max:100',
            'norek_tujuan'      => 'required|string|max:50',
            'pemilik_tujuan'    => 'required|string|max:100',
        ]);

        $pembayaran = Pembayaran::with('reservasi')->findOrFail($request->id_pembayaran);

        if (!$pembayaran->reservasi) {
            return back()->with('error', 'Reservasi tidak ditemukan, refund tidak dapat diproses.');
        }

        $originalName = $request->file('bukti_pendukung')->getClientOriginalName();
        $filePath = $request->file('bukti_pendukung')->storeAs('refund', $originalName, 'public');

        $lastRefund = Refund::orderBy('id_refund', 'desc')->first();
        $nextNumber = $lastRefund ? intval(substr($lastRefund->kode_refund, 1)) + 1 : 1;
        $kodeRefund = 'R' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        Refund::create([
            'kode_refund'        => $kodeRefund,
            'id_reservasi'       => $request->id_reservasi,
            'tgl_pengajuan'      => now(),
            'alasan_refund'      => $request->alasan_refund,
            'nominal_refund'     => $pembayaran->reservasi->total_harga ?? 0,
            'bukti_pendukung'    => $filePath,
            'nama_bank_tujuan'   => $request->nama_bank_tujuan,
            'norek_tujuan'       => $request->norek_tujuan,
            'pemilik_tujuan'     => $request->pemilik_tujuan,
            'status'             => 'Menunggu',
        ]);

        return redirect()->route('riwayatrefund')->with('success', 'Pengajuan refund berhasil dikirim!');
    }


    public function riwayatrefund()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $refunds = Refund::with(['reservasi', 'pembayaran'])
            ->whereHas('reservasi', function ($query) {
                $query->where('id_user', Auth::id());
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.riwayatrefund', compact('refunds'));
    }
}
