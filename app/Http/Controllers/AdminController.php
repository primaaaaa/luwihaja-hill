<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Galeri;
use App\Models\Reservasi;
use App\Models\Pembayaran;
use App\Models\Ulasan;
use App\Models\Refund;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class AdminController extends Controller
{
    public function Dashboard()
    {
        return view('pages.admin.dashboard', [
            'jml_kamar' => Kamar::count(),
            'jml_reservasi' => Reservasi::count(),
            'jml_ulasan' => Ulasan::count()
        ]);
    }

    public function Kamar()
    {
        $rooms = Kamar::orderBy('created_at', 'desc')->get();

        $this->updateAllRoomStatus();

        $lastKamar = Kamar::orderBy('id_tipe_villa', 'desc')->first();
        $nextNumber = $lastKamar ? intval(substr($lastKamar->kode_tipe, 1)) + 1 : 1;
        $nextKodeTipe = 'K' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return view('pages.admin.manajemenkamar', [
            'rooms' => $rooms,
            'nextKodeTipe' => $nextKodeTipe,
            'tableHeader' => ['Kode Kamar', 'Unit', 'Kapasitas', 'Kategori', 'Status']
        ]);
    }

    public function storeKamar(Request $request)
    {
        if (empty($request->kode_tipe)) {
            $lastKamar = Kamar::orderBy('id_tipe_villa', 'desc')->first();
            $nextNumber = $lastKamar ? intval(substr($lastKamar->kode_tipe, 1)) + 1 : 1;
            $request->merge(['kode_tipe' => 'K' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT)]);
        }

        $validated = $request->validate([
            'kode_tipe' => 'required|unique:tipe_villa,kode_tipe|max:10',
            'nama_unit' => 'required|max:100',
            'kapasitas' => 'required|integer|min:1',
            'kategori' => 'required|in:Deluxe Bed,Queen Bed,Twin Bed,Super Deluxe,Family Room',
            'deskripsi' => 'nullable',
            'harga_weekday' => 'required|numeric|min:0',
            'harga_weekend' => 'required|numeric|min:0',
            'foto_kamar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:Tersedia,Nonaktif'
        ]);

        if ($request->hasFile('foto_kamar')) {
            $file = $request->file('foto_kamar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $validated['foto_kamar'] = $file->storeAs('kamar', $filename, 'public');
        }

        Kamar::create($validated);

        return redirect()->route('admin.kamar')
            ->with('success', 'Kamar berhasil ditambahkan!');
    }

    public function updateKamar(Request $request, $id)
    {
        $kamar = Kamar::findOrFail($id);

        $validated = $request->validate([
            'kode_tipe' => 'required|max:10|unique:tipe_villa,kode_tipe,' . $id . ',id_tipe_villa',
            'nama_unit' => 'required|max:100',
            'kapasitas' => 'required|integer|min:1',
            'kategori' => 'required|in:Deluxe Bed,Queen Bed,Twin Bed,Super Deluxe,Family Room',
            'deskripsi' => 'nullable',
            'harga_weekday' => 'required|numeric|min:0',
            'harga_weekend' => 'required|numeric|min:0',
            'foto_kamar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:Tersedia,Terisi,Dipesan,Nonaktif'
        ]);

        if ($request->hasFile('foto_kamar')) {
            if ($kamar->foto_kamar) {
                Storage::disk('public')->delete($kamar->foto_kamar);
            }
            $file = $request->file('foto_kamar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $validated['foto_kamar'] = $file->storeAs('kamar', $filename, 'public');
        }

        $kamar->update($validated);

        $this->updateRoomStatus($id);

        return redirect()->route('admin.kamar')
            ->with('success', 'Kamar berhasil diupdate!');
    }

    public function updateStatusKamar(Request $request, $id)
    {
        $kamar = Kamar::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:Tersedia,Nonaktif'
        ]);

        $today = date('Y-m-d');

        $hasCurrentGuest = Reservasi::where('id_tipe_villa', $kamar->id_tipe_villa)
            ->whereIn('status', ['Dikonfirmasi'])
            ->where('tgl_checkin', '<=', $today)
            ->where('tgl_checkout', '>', $today)
            ->exists();

        $hasFutureReservation = Reservasi::where('id_tipe_villa', $kamar->id_tipe_villa)
            ->whereIn('status', ['Menunggu', 'Dikonfirmasi'])
            ->where('tgl_checkin', '>', $today)
            ->exists();

        if ($validated['status'] == 'Tersedia' && $hasCurrentGuest) {
            return redirect()->route('admin.kamar')
                ->with('error', 'Tidak dapat mengubah status! Kamar sedang terisi oleh tamu.');
        }

        if ($validated['status'] == 'Tersedia' && $hasFutureReservation) {
            return redirect()->route('admin.kamar')
                ->with('warning', 'Perhatian! Kamar memiliki reservasi mendatang yang masih aktif.');
        }

        $kamar->update($validated);

        return redirect()->route('admin.kamar')
            ->with('success', 'Status kamar berhasil diupdate!');
    }

    public function deleteKamar($id)
    {
        $kamar = Kamar::findOrFail($id);

        if ($kamar->foto_kamar) {
            Storage::disk('public')->delete($kamar->foto_kamar);
        }

        $kamar->delete();

        return redirect()->route('admin.kamar')
            ->with('success', 'Kamar berhasil dihapus!');
    }

    public function detailKamar(Kamar $kamar)
    {
        return view('pages.admin.kamar-detail', ['kamar' => $kamar]);
    }

    public function Reservasi()
    {
        $this->updateAllRoomStatus();

        $reservations = Reservasi::with(['user', 'kamar'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.admin.manajemenreservasi', [
            'tableHeader' => ['Kode Reservasi', 'Nama Tamu', 'Tanggal Check-In', 'Tanggal Check-Out', 'Status'],
            'reservations' => $reservations
        ]);
    }

    public function updateStatusReservasi(Request $request, $id)
    {
        $reservasi = Reservasi::findOrFail($id);

        $request->validate([
            'status' => 'required|in:Menunggu,Dikonfirmasi,Selesai,Dibatalkan'
        ]);

        $reservasi->status = $request->status;
        $reservasi->save();

        $this->updateRoomStatus($reservasi->id_tipe_villa);

        return redirect()->back()->with('success', 'Status reservasi berhasil diupdate!');
    }

    public function deleteReservasi($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $roomId = $reservasi->id_tipe_villa;

        $reservasi->delete();

        $this->updateRoomStatus($roomId);

        return redirect()->back()->with('success', 'Reservasi berhasil dihapus!');
    }

    public function DetailReservasi($id)
    {
        $reservasi = Reservasi::with(['user', 'kamar'])
            ->findOrFail($id);
        return view('pages.admin.reservasi-detail', compact('reservasi'));
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

    private function updateAllRoomStatus()
    {
        $rooms = Kamar::where('status', '!=', 'Nonaktif')->get();

        foreach ($rooms as $room) {
            $this->updateRoomStatus($room->id_tipe_villa);
        }
    }


    public function Ulasan()
    {
        $ulasan = \App\Models\Ulasan::with(['user', 'reservasi'])->orderBy('tgl_ulasan', 'DESC')->get();

        return view('pages.admin.manajemenulasan', [
            'tableHeader' => ['Nama Tamu', 'Kode Reservasi', 'Rating', 'Komentar', 'Tanggal Ulasan'],
            'ulasan' => $ulasan
        ]);
    }

    public function DetailUlasan($id)
    {
        $ulasan = Ulasan::with(['reservasi', 'user'])->findOrFail($id);

        return view('pages.admin.ulasan-detail', [
            'ulasan' => $ulasan
        ]);
    }

    public function deleteUlasan($id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->delete();

        return redirect()->route('admin.manajemenulasan')
            ->with('success', 'Ulasan berhasil dihapus!');
    }


    public function CMS()
    {
        $galleries = Galeri::orderBy('tgl_upload', 'desc')->get();

        return view('pages.admin.cms', [
            'tableHeader' => ['Kode Galeri', 'File', 'Tanggal Upload'],
            'galleries' => $galleries
        ]);
    }

    public function storeGaleri(Request $request)
    {
        $request->validate([
            'files.*' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {

                $kodeGaleri = $this->generateKodeGaleri();
                $originalName = $file->getClientOriginalName();

                $uniqueName = time() . '_' . Str::random(10) . '_' . $originalName;

                Storage::disk('public')->putFileAs(
                    'galeri',
                    $file,
                    $uniqueName
                );

                Galeri::create([
                    'kode_galeri' => $kodeGaleri,
                    'file' => $uniqueName,
                    'tgl_upload' => now()->toDateString()
                ]);
            }

            return redirect()->route('cms')->with('success', 'File berhasil diupload!');
        }

        return redirect()->route('cms')->with('error', 'Tidak ada file yang diupload!');
    }


    private function generateKodeGaleri()
    {
        $lastGaleri = Galeri::orderBy('id_galeri', 'desc')->first();

        if (!$lastGaleri) {
            return 'G001';
        }

        $lastNumber = (int) substr($lastGaleri->kode_galeri, 1);

        $newNumber = $lastNumber + 1;

        return 'G' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    public function deleteGaleri($id)
    {
        $galeri = Galeri::findOrFail($id);

        if (Storage::exists('public/galeri/' . $galeri->file)) {
            Storage::delete('public/galeri/' . $galeri->file);
        }

        $galeri->delete();

        return redirect()->route('cms')->with('success', 'File berhasil dihapus!');
    }


    public function Refund()
    {
        $refunds = Refund::with(['reservasi.user'])
            ->orderBy('tgl_pengajuan', 'desc')
            ->get();

        return view('pages.admin.manajemenrefund', [
            'tableHeader' => ['Kode Refund', 'Kode Reservasi', 'Nama Tamu', 'Tanggal Pengajuan', 'Status'],
            'refunds' => $refunds
        ]);
    }

    public function updateStatusRefund(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Disetujui,Ditolak'
        ]);

        $refund = Refund::findOrFail($id);
        $refund->status = $request->status;
        $refund->save();

        return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui']);
    }

    public function DetailRefund($id)
    {
        $refund = Refund::with(['reservasi.user'])
            ->findOrFail($id);

        return view('pages.admin.refund-detail', [
            'refund' => $refund
        ]);
    }
    public function pembayaran()
    {
        $pembayarans = Pembayaran::with('reservasi.user', 'reservasi.kamar')
            ->orderBy('created_at', 'desc')
            ->get();


        return view('pages.admin.manajemenpembayaran', [
            'tableHeader' => ['Kode Reservasi', 'Nama Tamu', 'Tanggal Pembayaran', 'Jumlah', 'Status'],
            'pembayarans' => $pembayarans
        ]);
    }


    public function updateStatusPembayaran(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Lunas,Batal'
        ]);

        $reservasi = Reservasi::findOrFail($id);
        $pembayaran = Pembayaran::findOrFail($id);

        if ($pembayaran->status !== 'Menunggu') {
            return redirect()->back()->with('error', 'Status pembayaran sudah final dan tidak bisa diubah.');
        }

        $pembayaran->status = $request->status;

        if ($request->status === 'Lunas' && !$pembayaran->tgl_pembayaran) {
            $pembayaran->tgl_pembayaran = now();
        }

        $pembayaran->save();

        $this->updateRoomStatus($reservasi->id_tipe_villa);


        return redirect()->back()->with('success', 'Status pembayaran berhasil diupdate!');
    }
    public function DetailPembayaran($id)
    {
        $pembayaran = Pembayaran::with(['reservasi.user', 'reservasi.kamar'])
            ->findOrFail($id);

        return view('pages.admin.pembayaran-detail', compact('pembayaran'));
    }
}
