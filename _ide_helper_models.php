<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id_galeri
 * @property string $kode_galeri
 * @property string $file
 * @property \Illuminate\Support\Carbon $tgl_upload
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galeri newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galeri newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galeri query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galeri whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galeri whereIdGaleri($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galeri whereKodeGaleri($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galeri whereTglUpload($value)
 */
	class Galeri extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_tipe_villa
 * @property string $kode_tipe
 * @property string $nama_unit
 * @property int $kapasitas
 * @property string $kategori
 * @property string|null $deskripsi
 * @property string $harga_weekday
 * @property string $harga_weekend
 * @property string|null $foto_kamar
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $formatted_harga_weekday
 * @property-read mixed $formatted_harga_weekend
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reservasi> $reservasi
 * @property-read int|null $reservasi_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reservasi> $reservasiAktif
 * @property-read int|null $reservasi_aktif_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kamar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kamar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kamar query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kamar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kamar whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kamar whereFotoKamar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kamar whereHargaWeekday($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kamar whereHargaWeekend($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kamar whereIdTipeVilla($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kamar whereKapasitas($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kamar whereKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kamar whereKodeTipe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kamar whereNamaUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kamar whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kamar whereUpdatedAt($value)
 */
	class Kamar extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_pembayaran
 * @property int $id_reservasi
 * @property string $kode_pembayaran
 * @property \Illuminate\Support\Carbon|null $tgl_pembayaran
 * @property string|null $bukti_pembayaran
 * @property string|null $nomor_rekening
 * @property string|null $nama_pemilik
 * @property string|null $nama_bank
 * @property string $metode_pembayaran
 * @property string $status
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $status_badge
 * @property-read \App\Models\Reservasi $reservasi
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran whereBuktiPembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran whereIdPembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran whereIdReservasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran whereKodePembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran whereMetodePembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran whereNamaBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran whereNamaPemilik($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran whereNomorRekening($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran whereTglPembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran whereUpdatedAt($value)
 */
	class Pembayaran extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_refund
 * @property string $kode_refund
 * @property int $id_reservasi
 * @property \Illuminate\Support\Carbon $tgl_pengajuan
 * @property string|null $alasan_refund
 * @property numeric $nominal_refund
 * @property string|null $bukti_pendukung
 * @property string|null $nama_bank_tujuan
 * @property string|null $norek_tujuan
 * @property string|null $pemilik_tujuan
 * @property string $status
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $bukti_url
 * @property-read mixed $nominal_format
 * @property-read mixed $status_badge
 * @property-read \App\Models\Reservasi $reservasi
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Refund disetujui()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Refund ditolak()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Refund menunggu()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Refund newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Refund newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Refund query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Refund status($status)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Refund whereAlasanRefund($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Refund whereBuktiPendukung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Refund whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Refund whereIdRefund($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Refund whereIdReservasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Refund whereKodeRefund($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Refund whereNamaBankTujuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Refund whereNominalRefund($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Refund whereNorekTujuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Refund wherePemilikTujuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Refund whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Refund whereTglPengajuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Refund whereUpdatedAt($value)
 */
	class Refund extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_reservasi
 * @property string $kode_reservasi
 * @property int $id_user
 * @property int $id_tipe_villa
 * @property \Illuminate\Support\Carbon $tgl_checkin
 * @property \Illuminate\Support\Carbon $tgl_checkout
 * @property numeric $total_harga
 * @property string $status
 * @property \Illuminate\Support\Carbon $tgl_reservasi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $durasi
 * @property-read mixed $status_badge
 * @property-read \App\Models\Kamar $kamar
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pembayaran> $pembayaran
 * @property-read int|null $pembayaran_count
 * @property-read \App\Models\Refund|null $refund
 * @property-read \App\Models\Ulasan|null $ulasan
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi aktif()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi status($status)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi whereIdReservasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi whereIdTipeVilla($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi whereKodeReservasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi whereTglCheckin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi whereTglCheckout($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi whereTglReservasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi whereTotalHarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservasi whereUpdatedAt($value)
 */
	class Reservasi extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_ulasan
 * @property int $id_reservasi
 * @property int $id_user
 * @property numeric $rating
 * @property string|null $isi_ulasan
 * @property \Illuminate\Support\Carbon $tgl_ulasan
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Reservasi $reservasi
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ulasan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ulasan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ulasan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ulasan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ulasan whereIdReservasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ulasan whereIdUlasan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ulasan whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ulasan whereIsiUlasan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ulasan whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ulasan whereTglUlasan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ulasan whereUpdatedAt($value)
 */
	class Ulasan extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_user
 * @property string $nama
 * @property string $email
 * @property string $password
 * @property string $noTelepon
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reservasi> $reservasi
 * @property-read int|null $reservasi_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ulasan> $ulasan
 * @property-read int|null $ulasan_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNoTelepon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

