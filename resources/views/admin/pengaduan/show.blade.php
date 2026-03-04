<script src="https://cdn.tailwindcss.com"></script>

<div class="max-w-5xl mx-auto p-6 bg-gray-100 min-h-screen">

    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
        🛠 Admin - Detail Pengaduan
    </h2>

    <a href="{{ url('/admin/pengaduan') }}"
       class="inline-block bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded mb-4">
        ← Kembali
    </a>

    <hr class="mb-4">

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- DETAIL PENGADUAN --}}
    <div class="bg-white p-6 rounded-xl shadow mb-6 space-y-3">

        <p>👤 <b>Nama Siswa:</b> {{ $pengaduan->user->name }}</p>

        <p>📌 <b>Judul:</b> {{ $pengaduan->judul }}</p>

        <p>
            ✔ <b>Status:</b>

            <span class="px-3 py-1 rounded text-white
                @if($pengaduan->status=='menunggu') bg-yellow-500
                @elseif($pengaduan->status=='diproses') bg-blue-500
                @elseif($pengaduan->status=='selesai') bg-green-600
                @else bg-red-500
                @endif
            ">
                {{ ucfirst($pengaduan->status) }}
            </span>
        </p>

        <p>📝 <b>Deskripsi:</b> {{ $pengaduan->deskripsi }}</p>

        @if($pengaduan->foto)
            <div>
                <p class="mb-2 font-semibold">🖼 Foto Bukti</p>
                <img src="{{ asset('uploads/'.$pengaduan->foto) }}"
                     class="rounded-lg shadow"
                     width="250">
            </div>
        @endif

    </div>

    <hr class="mb-6 border-2 border-gray-500">

    {{-- FORM UPDATE --}}
    <div class="bg-white p-6 rounded-xl shadow">

        <h3 class="text-lg font-bold mb-4 text-gray-800">
            ⚙ Tanggapan Admin
        </h3>

        <form method="POST"
              action="{{ route('admin.pengaduan.update', $pengaduan->id) }}">

            @csrf
            @method('PUT') {{-- WAJIB UNTUK UPDATE --}}

            {{-- STATUS --}}
            <label class="block font-semibold mb-1">Status</label>

            <select name="status"
                class="w-full border-2 border-gray-700 p-2 rounded-lg mb-4">

                <option value="menunggu"
                    {{ $pengaduan->status=='menunggu'?'selected':'' }}>
                    Menunggu
                </option>

                <option value="diproses"
                    {{ $pengaduan->status=='diproses'?'selected':'' }}>
                    Diproses
                </option>

                <option value="selesai"
                    {{ $pengaduan->status=='selesai'?'selected':'' }}>
                    Selesai
                </option>

                <option value="ditolak"
                    {{ $pengaduan->status=='ditolak'?'selected':'' }}>
                    Ditolak
                </option>
            </select>

            {{-- TANGGAPAN --}}
            <label class="block font-semibold mb-1">
                Tanggapan Admin
            </label>

            <textarea name="tanggapan_admin"
                rows="4"
                class="w-full border-2 border-gray-700 p-3 rounded-lg mb-4"
                placeholder="Tulis tanggapan admin...">{{ old('tanggapan_admin', $pengaduan->tanggapan_admin) }}</textarea>

            {{-- BUTTON --}}
            <button type="submit"
                class="bg-blue-800 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-900 transition font-semibold">
                Simpan
            </button>

        </form>

    </div>

</div>
