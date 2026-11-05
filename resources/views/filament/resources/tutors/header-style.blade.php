<x-filament-panels::page>
    <style>
        /* MENGATUR HALAMAN AGAR MELEBAR PENUH KE SAMPING */
        .fi-page { 
            max-width: 100% !important; 
        }
        .fi-main { 
            max-width: 100% !important; 
        }
        .fi-header {
            display: flex !important;
            flex-wrap: wrap !important;
            align-items: center !important;
            justify-content: space-between !important;
            gap: 1rem !important;
        }
        .fi-header-heading { 
            margin-bottom: 0 !important;
            font-size: 1.5rem !important;
            font-weight: 600 !important;
        }

        .fi-ta {
            background-color: transparent !important;
            box-shadow: none !important;
            border: none !important;
            padding: 0 !important;
        }
        
        /* FONT DI DALAM TABEL */
        .fi-ta th {
            font-size: 0.85rem !important;
            font-weight: 600 !important;
        }
        .fi-ta td {
            font-size: 0.85rem !important;
            font-weight: 400 !important;
        }
        .fi-ta-pagination {
            font-size: 0.80rem !important;
            font-weight: 400 !important;
        }

        /* KOTAK TABEL LUAR BERWARNA PUTIH TANPA BORDER */
        .fi-ta-content {
            background-color: #ffffff !important;
            border-radius: 1rem !important;
            overflow: hidden !important;
            border: none !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02) !important;
        }

        /* ==========================================================
           MEMBUAT HEADER TABEL KUNING SOLID 100% TANPA LAPISAN BURAM 
           ========================================================== */
        .fi-ta thead,
        .fi-ta thead tr,
        .fi-ta-header-cell,
        .fi-ta-header-cell > div,
        .fi-ta-header-cell button,
        .fi-ta-header-cell span {
            background-color: #ffc72c !important; /* Kuning solid utama */
            background-image: none !important;
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
            filter: none !important;
            opacity: 1 !important;
        }

        /* MENGHILANGKAN PSEUDO-ELEMENT / OVERLAY TRANSPARAN BAWAAN FILAMENT */
        .fi-ta-header-cell::before,
        .fi-ta-header-cell::after,
        .fi-ta thead tr::before,
        .fi-ta thead tr::after {
            display: none !important;
            content: none !important;
        }

        .fi-ta thead tr {
            border-bottom: 1.5px solid #eab308 !important;
        }
    </style>

    <div style="display: flex; flex-direction: column; gap: 1.5rem; width: 100%;">
        
        {{-- KOTAK PENCARIAN & TOMBOL TAMBAH (SEJAJAR DENGAN JUDUL DI KANAN ATAS) --}}
        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: flex-end; gap: 0.75rem; width: 100%; margin-top: -3.5rem; margin-bottom: 0.5rem; position: relative; z-index: 10;">
            
            {{-- KOTAK PENCARIAN --}}
            <div style="position: relative; width: 260px;" x-data>
                <input 
                    type="text" 
                    wire:model.live.debounce.500ms="search" 
                    placeholder="Cari tutor..." 
                    style="width: 100%; padding: 0.5rem 0.875rem 0.5rem 2.5rem; font-size: 0.875rem; font-weight: 600; border: 1.5px solid #fde68a; border-radius: 0.75rem; background-color: #ffffff; color: #374151; outline: none; box-shadow: 0 1px 2px rgba(0,0,0,0.01); transition: all 0.2s ease;"
                />
                <div style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); pointer-events: none; display: flex; align-items: center;">
                    <svg style="width: 16px; height: 16px; color: #9ca3af;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
            </div>

            {{-- TOMBOL + ADD TUTOR (DENGAN IKON & TULISAN) --}}
            <a 
                href="{{ \App\Filament\Resources\Tutors\TutorResource::getUrl('create') }}"
                style="display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; padding: 0.6rem 1.25rem; background-color: #facc15; color: #111827; font-size: 0.875rem; font-weight: 800; border-radius: 0.75rem; text-decoration: none; white-space: nowrap; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); transition: all 0.2s ease;"
            >
                <svg style="width: 18px; height: 18px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Tutor
            </a>
        </div>

        {{-- TEKS INFORMASI BERSIH DENGAN IKON (TANPA KOTAK) & BAHASA INGGRIS --}}
        <div style="display: flex; align-items: center; justify-content: flex-start; width: 100%; gap: 0.5rem; padding-left: 0.25rem;">
            <div style="display: inline-flex; align-items: center; gap: 0.5rem;">
                <div style="color: #d97706; display: flex; align-items: center;">
                    <svg style="width: 1.1rem; height: 1.1rem;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
                <span style="font-size: 0.85rem; font-weight: 400; color: #4b5563;">
                    Kelola data tutor dan informasi instruktur yang aktif
                </span>
            </div>
        </div>

        {{-- KONTAINER UTAMA TABEL BERWARNA PUTIH TANPA BORDER LUAR --}}
        <div style="background-color: #ffffff; padding: 1.5rem; border-radius: 1rem; border: none; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02); width: 100%; box-sizing: border-box;">
            {{ $this->table }}
        </div>

    </div>
</x-filament-panels::page>