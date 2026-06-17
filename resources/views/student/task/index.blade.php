<!-- Wrapper utama untuk filter -->
<div x-data="{ filter: 'semua' }">

    <!-- TAB FILTER -->
    <div class="flex gap-2 mb-6">
        <button @click="filter = 'semua'" :class="filter === 'semua' ? 'bg-blue-600 text-white' : 'bg-white text-slate-600 border border-slate-200'" class="px-5 py-2 rounded-xl text-xs font-bold transition">Semua</button>
        <button @click="filter = 'sedang'" :class="filter === 'sedang' ? 'bg-blue-600 text-white' : 'bg-white text-slate-600 border border-slate-200'" class="px-5 py-2 rounded-xl text-xs font-bold transition">Sedang Dikerjakan</button>
        <button @click="filter = 'belum'" :class="filter === 'belum' ? 'bg-blue-600 text-white' : 'bg-white text-slate-600 border border-slate-200'" class="px-5 py-2 rounded-xl text-xs font-bold transition">Belum Dimulai</button>
        <button @click="filter = 'selesai'" :class="filter === 'selesai' ? 'bg-blue-600 text-white' : 'bg-white text-slate-600 border border-slate-200'" class="px-5 py-2 rounded-xl text-xs font-bold transition">Selesai</button>
    </div>

    <!-- DAFTAR TUGAS -->
    <!-- Gunakan x-show untuk memfilter berdasarkan status -->
    <div x-show="filter === 'semua' || filter === 'sedang'" class="mb-4">
        <div class="flex items-center justify-between p-5 bg-white border border-slate-200 rounded-2xl">
            <div>
                <h4 class="text-sm font-bold text-slate-800">Membuat Poster Event Sekolah</h4>
                <p class="text-xs text-slate-500 mt-1">Deadline: 28 Des 2025</p>
            </div>
            <button onclick="alert('Membuka form pengumpulan tugas...')" class="px-4 py-2 bg-blue-600 text-white rounded-xl text-xs font-bold hover:bg-blue-700">Kumpulkan</button>
        </div>
    </div>

    <div x-show="filter === 'semua' || filter === 'belum'" class="mb-4">
        <div class="flex items-center justify-between p-5 bg-white border border-slate-200 rounded-2xl">
            <div>
                <h4 class="text-sm font-bold text-slate-800">Palet Warna untuk Brand Fiktif</h4>
                <p class="text-xs text-slate-500 mt-1">Deadline: 2 Jan 2026</p>
            </div>
            <button onclick="alert('Mulai mengerjakan tugas...')" class="px-4 py-2 border border-blue-600 text-blue-600 rounded-xl text-xs font-bold hover:bg-blue-50">Mulai Kerjakan</button>
        </div>
    </div>

    <div x-show="filter === 'semua' || filter === 'selesai'" class="mb-4">
        <div class="flex items-center justify-between p-5 bg-white border border-slate-200 rounded-2xl">
            <div>
                <h4 class="text-sm font-bold text-slate-800">Redesain Brosur Sekolah</h4>
                <p class="text-xs text-slate-500 mt-1">Nilai: 85 / 100</p>
            </div>
            <button onclick="alert('Melihat detail penilaian...')" class="px-4 py-2 bg-slate-100 text-slate-600 rounded-xl text-xs font-bold hover:bg-slate-200">Lihat Detail</button>
        </div>
    </div>
</div>