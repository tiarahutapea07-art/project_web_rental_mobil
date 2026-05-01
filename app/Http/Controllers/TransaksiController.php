<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Rental;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('rental.customer', 'rental.mobil')
            ->latest()
            ->get();

        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $rentals = Rental::with('mobil', 'customer')->get();
        return view('transaksi.create', compact('rentals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rental_id' => 'required',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_sewa',
            'metode_bayar' => 'required|in:cash,transfer,qris',
        ]);

        $rental = Rental::with('mobil')->findOrFail($request->rental_id);

        $lama = Carbon::parse($request->tanggal_sewa)
            ->diffInDays(Carbon::parse($request->tanggal_kembali));

        $harga = $rental->mobil->harga_per_hari;
        $total = $lama * $harga;

        Transaksi::create([
            'rental_id' => $request->rental_id,
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'total_harga' => $total,
            'jumlah_bayar' => $request->jumlah_bayar ?? 0,
            'metode_bayar' => $request->metode_bayar,
            'status_pembayaran' => 'Belum Lunas',
            'status_transaksi' => 'pending',
            'tanggal_bayar' => now()
        ]);

        return redirect()->route('aktivitas.index')
            ->with('success', 'Transaksi berhasil dibuat!');
    }

    public function show($id)
    {
        $transaksi = Transaksi::with('rental.customer', 'rental.mobil')
            ->findOrFail($id);

        return view('transaksi.show', compact('transaksi'));
    }

    // 🔥 BAGIAN PALING PENTING
    public function bayar(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $request->validate([
            'metode_bayar' => 'required|in:cash,transfer,qris',
        ]);

        $data = [
            'metode_bayar' => $request->metode_bayar,
        ];

        // jika transfer / QRIS
        if (in_array($request->metode_bayar, ['transfer', 'qris'])) {

            $request->validate([
                'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            if ($request->hasFile('bukti_pembayaran')) {

                $file = $request->file('bukti_pembayaran');
                $namaFile = time() . '_' . $file->getClientOriginalName();

                $file->move(public_path('bukti'), $namaFile);

                $data['bukti_pembayaran'] = $namaFile;
                $data['status_pembayaran'] = 'Menunggu Konfirmasi';
            }

        } else {
            // cash
            $data['status_pembayaran'] = 'Lunas';
        }

        $transaksi->update($data);

        return back()->with('success', 'Pembayaran berhasil');
    }

    public function konfirmasi($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'status_pembayaran' => 'Lunas',
            'tanggal_bayar' => now()
        ]);

        return back()->with('success', 'Pembayaran dikonfirmasi');
    }

   
public function tandaiLunas($id)
{
    $transaksi = Transaksi::findOrFail($id);

    $transaksi->status = 'lunas';
    $transaksi->save();

    return redirect()->back()->with('success', 'Transaksi berhasil dilunasi!');
}



   public function print($id)
{
    $transaksi = Transaksi::with('rental.mobil', 'rental.customer')->findOrFail($id);
    $terbilang = $this->terbilang($transaksi->rental->total_harga) . ' Rupiah';
    return view('transaksi.print', compact('transaksi', 'terbilang'));
}

private function terbilang($angka)
{
    $angka = abs(intval($angka));
    $huruf = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan',
              'Sepuluh', 'Sebelas', 'Dua Belas', 'Tiga Belas', 'Empat Belas', 'Lima Belas',
              'Enam Belas', 'Tujuh Belas', 'Delapan Belas', 'Sembilan Belas'];

    if ($angka < 20) return $huruf[$angka];
    if ($angka < 100) return $huruf[intval($angka/10)*10 == 20 ? 2 : intval($angka/10)] .
        ($angka % 10 ? ' Puluh ' . $huruf[$angka % 10] : ' Puluh');
    if ($angka < 200) return 'Seratus' . ($angka % 100 ? ' ' . $this->terbilang($angka % 100) : '');
    if ($angka < 1000) return $huruf[intval($angka/100)] . ' Ratus' . ($angka % 100 ? ' ' . $this->terbilang($angka % 100) : '');
    if ($angka < 2000) return 'Seribu' . ($angka % 1000 ? ' ' . $this->terbilang($angka % 1000) : '');
    if ($angka < 1000000) return $this->terbilang(intval($angka/1000)) . ' Ribu' . ($angka % 1000 ? ' ' . $this->terbilang($angka % 1000) : '');
    if ($angka < 1000000000) return $this->terbilang(intval($angka/1000000)) . ' Juta' . ($angka % 1000000 ? ' ' . $this->terbilang($angka % 1000000) : '');
    return $this->terbilang(intval($angka/1000000000)) . ' Miliar' . ($angka % 1000000000 ? ' ' . $this->terbilang($angka % 1000000000) : '');
}



}
