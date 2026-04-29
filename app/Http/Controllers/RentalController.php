<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Mobil;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Transaksi;
use Yajra\DataTables\DataTables;

class RentalController extends Controller
{
    public function create($mobil_id)
    {
        $mobil = Mobil::findOrFail($mobil_id);

        if ($mobil->status !== 'tersedia') {
            return redirect('/mobil')->with('error', 'Mobil tidak tersedia untuk disewa.');
        }
         $customers = Customer::orderBy('nama')->get();

        return view('rental.create', compact('mobil', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mobil_id'         => 'required|exists:mobils,id',
            'nama'             => 'required|string|max:255',
            'nik'              => 'required|string|max:20',
            'tanggal_sewa'     => 'required|date',
            'tanggal_kembali'  => 'required|date|after:tanggal_sewa',
            'metode_bayar'     => 'required|in:cash,transfer,qris',
            'bukti_pembayaran' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $mobil = Mobil::findOrFail($request->mobil_id);

        // ================= CUSTOMER =================
        if ($request->customer_id) {
            // Pilih customer yang sudah ada
            $customer = Customer::findOrFail($request->customer_id);
            } else {
                // Buat customer baru
                $customer = Customer::firstOrCreate(
                    ['nik' => $request->nik],
                    [
                        'nama'     => $request->nama,
                        'no_telp'  => $request->no_telp,
                        'alamat'   => $request->alamat,
                        'email'    => $request->nik . '@example.com',
                        'password' => Hash::make('password123'),
                        ]
                        );
                        }

        // ================= HITUNG SEWA =================
        $tanggalSewa    = Carbon::parse($request->tanggal_sewa);
        $tanggalKembali = Carbon::parse($request->tanggal_kembali);
        $lamaSewa       = $tanggalSewa->diffInDays($tanggalKembali);
        $totalHarga     = $lamaSewa * $mobil->harga_per_hari;

        // ================= RENTAL =================
        $rental = Rental::create([
            'mobil_id'        => $request->mobil_id,
            'customer_id'     => $customer->id,
            'tanggal_sewa'    => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'lama_sewa'       => $lamaSewa,
            'total_harga'     => $totalHarga,
            'status'          => 'aktif',
        ]);

        // ================= UPLOAD BUKTI =================
        $buktiFile = null;

        if ($request->hasFile('bukti_bayar')) {
    $file = $request->file('bukti_bayar');
    $namaFile = time().'_'.$file->getClientOriginalName();
    $file->storeAs('public/bukti', $namaFile);

    $rental->bukti_bayar = $namaFile;
}


        // ================= STATUS =================
        if ($request->metode_bayar == 'cash') {
            $statusPembayaran = 'Lunas';
        } else {
            $statusPembayaran = $buktiFile ? 'Menunggu Konfirmasi' : 'Belum Lunas';
        }

        // ================= TRANSAKSI =================
        Transaksi::create([
            'rental_id'         => $rental->id,
            'jumlah_bayar'      => $totalHarga,
            'metode_bayar'      => $request->metode_bayar,
            'bukti_pembayaran'  => $buktiFile,
            'status_pembayaran' => $statusPembayaran,
            'status_transaksi'  => 'pending',
            'tanggal_bayar'     => now(),
        ]);

        // ================= UPDATE MOBIL =================
        $mobil->update(['status' => 'tidak tersedia']);

        return redirect('/aktivitas')->with('success', 'Berhasil menyewa mobil!');
    }

    public function index()
    {
        if (request()->ajax()) {
            return $this->getDataTables();
        }

        return view('rental.index');
    }

    public function getDataTables()
    {
        $rentals = Rental::with('mobil', 'customer')->select('rentals.*');

        return DataTables::of($rentals)
            ->addIndexColumn()

            ->addColumn('nama_mobil', function ($rental) {
                return $rental->mobil->nama_mobil;
            })

            ->addColumn('customer', function ($rental) {
                return $rental->customer->nama;
            })

            ->addColumn('tanggal_sewa_formatted', function ($rental) {
                return Carbon::parse($rental->tanggal_sewa)->format('d M Y');
            })

            ->addColumn('tanggal_kembali_formatted', function ($rental) {
                return Carbon::parse($rental->tanggal_kembali)->format('d M Y');
            })

            ->addColumn('lama_sewa_formatted', function ($rental) {
                return $rental->lama_sewa . ' hari';
            })

            ->addColumn('total_harga_formatted', function ($rental) {
                return 'Rp ' . number_format($rental->total_harga, 0, ',', '.');
            })

            ->addColumn('status_badge', function ($rental) {
                return '<span class="status-badge status-' . $rental->status . '">' . ucfirst($rental->status) . '</span>';
            })

            ->addColumn('aksi', function ($rental) {
                if ($rental->status == 'aktif') {
                    return '
                        <form action="' . route('rental.return', $rental->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            <button type="submit" class="btn-return"
                                onclick="return confirm(\'Apakah mobil sudah dikembalikan?\');">
                                <i class="fas fa-undo mr-1"></i> Kembalikan
                            </button>
                        </form>
                    ';
                }

                return '<span class="text-muted">—</span>';
            })

            ->rawColumns(['status_badge', 'aksi'])
            ->make(true);
    }

    public function return($id)
    {
        $rental = Rental::findOrFail($id);

        $rental->update(['status' => 'selesai']);
        $rental->mobil->update(['status' => 'tersedia']);

        Transaksi::where('rental_id', $rental->id)
            ->update(['status_pembayaran' => 'Lunas']);

        return redirect('/rental')->with('success', 'Mobil berhasil dikembalikan.');
    }
}
