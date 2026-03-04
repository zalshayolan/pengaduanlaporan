<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pengaduan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-10">

<div class="max-w-3xl mx-auto bg-white shadow-xl rounded-xl p-8">

    <h2 class="text-2xl font-bold mb-6">
        ✏️ Edit Status Pengaduan
    </h2>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROR VALIDATION --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.pengaduan.update', $pengaduan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Judul -->
        <div class="mb-4">
            <label class="font-semibold">Judul</label>
            <input type="text"
                   value="{{ $pengaduan->judul }}"
                   class="w-full border rounded p-2 bg-gray-100"
                   readonly>
        </div>

        <!-- Isi -->
        <div class="mb-4">
            <label class="font-semibold">Isi Pengaduan</label>
            <textarea class="w-full border rounded p-2 bg-gray-100"
                      rows="4"
                      readonly>{{ $pengaduan->isi }}</textarea>
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label class="font-semibold">Status</label>
            <select name="status" class="w-full border rounded p-2" required>
                <option value="menunggu" {{ $pengaduan->status=='menunggu'?'selected':'' }}>
                    Menunggu
                </option>
                <option value="diproses" {{ $pengaduan->status=='diproses'?'selected':'' }}>
                    Diproses
                </option>
                <option value="selesai" {{ $pengaduan->status=='selesai'?'selected':'' }}>
                    Selesai
                </option>
            </select>
        </div>

        <!-- Tanggapan -->
        <div class="mb-6">
            <label class="font-semibold">Tanggapan Admin</label>
            <textarea name="tanggapan_admin"
                      class="w-full border rounded p-2"
                      rows="4"
                      placeholder="Tulis tanggapan...">{{ $pengaduan->tanggapan_admin }}</textarea>
        </div>

        <!-- Button -->
        <div class="flex justify-between">
            <a href="{{ route('admin.pengaduan.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded">
                ← Kembali
            </a>

            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                💾 Update
            </button>
        </div>

    </form>

</div>

</body>
</html>
