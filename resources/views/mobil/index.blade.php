<h1> Data Mobil</h1>

<a href="/mobil/create">+ Tambah mobil</a>

@foreach($mobils as $m)
    <p>
        {{ $m->nama_mobil }} - Rp {{ $m->harga_per_hari }}

        <a href="/mobil/{{ $m-> id }}/edit">Edit</a>
         <form action="/mobil/{{ $m->id }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Hapus</button>
         </form>
    </p>
    @endforeach