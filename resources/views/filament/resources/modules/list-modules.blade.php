<x-filament-panels::page>
    {{-- CSS Kustom untuk mensejajarkan kontrol dengan header bawaan Filament & memperlebar halaman --}}
    <style>
    /* Menyeragamkan warna border dan background aktif untuk tab agar konsisten kuning emas */
    .fi-tabs, 
    .fi-tabs-item,
    button[role="tab"] {
        border-color: #f59e0b !important;
    }

    /* Tab yang sedang aktif */
    .fi-tabs-item[aria-selected="true"],
    button[role="tab"][aria-selected="true"] {
        background: #facc15 !important;
        border-color: #f59e0b !important;
        color: #111827 !important;
        font-weight: 800 !important;
    }

    /* Garis pembatas bawah tab */
    .fi-tabs-bar {
        border-color: #f59e0b !important;
    }
    </style>

    <div style="display: flex; flex-direction: column; gap: 1.25rem; width: 100%;" x-data="{ expanded: {} }">
        
        {{-- KONTROL ATAS: PENCARIAN & TOMBOL TAMBAH --}}
        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: flex-end; gap: 0.75rem; width: 100%; margin-top: -3.5rem; margin-bottom: 0.5rem; position: relative; z-index: 10;">
            
            {{-- Kotak Pencarian --}}
            <div style="position: relative; width: 260px;">
                <input 
                    type="text" 
                    wire:model.live.debounce.500ms="search" 
                    placeholder="Cari modul..." 
                    style="width: 100%; padding: 0.6rem 0.875rem 0.6rem 2.5rem; font-size: 0.875rem; font-weight: 600; border: 1.5px solid #fde68a; border-radius: 0.75rem; background-color: #ffffff; color: #374151; outline: none; box-shadow: 0 1px 2px rgba(0,0,0,0.01); transition: all 0.2s ease;"
                />
                <div style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); pointer-events: none; display: flex; align-items: center;">
                    <svg style="width: 16px; height: 16px; color: #9ca3af;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
            </div>

            {{-- Tombol Tambah Modul --}}
            <a 
                href="{{ App\Filament\Resources\Modules\ModuleResource::getUrl('create') }}"
                style="display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; padding: 0.6rem 1.25rem; background-color: #facc15; color: #111827; font-size: 0.875rem; font-weight: 800; border-radius: 0.75rem; text-decoration: none; white-space: nowrap; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); transition: all 0.2s ease;"
            >
                <svg style="width: 18px; height: 18px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Modul
            </a>
        </div>

        {{-- TEKS INFORMASI BERSIH TANPA KOTAK --}}
        <div style="display: flex; align-items: center; gap: 0.5rem; padding-left: 0.25rem;">
            <span style="font-size: 0.85rem; font-weight: 700; color: #4b5563;">
                Menampilkan <span style="color: #d97706; font-weight: 900;">{{ $totalModules }}</span> modul yang tersedia untuk <span style="color: #111827; font-weight: 900;">{{ $activeTab }}</span>
            </span>
        </div>

        {{-- CONTAINER UTAMA DENGAN TAB LEVEL DI BAGIAN ATASNYA --}}
        <div style="display: flex; flex-direction: column; width: 100%;">
            
            {{-- TAB LEVEL (Gaya Folder) --}}
            <div style="display: flex; align-items: flex-end; gap: 0.25rem; padding-left: 0; z-index: 5; margin-bottom: -1px;">
                @foreach(['Level A', 'Level B', 'Level C'] as $index => $level)
                    <button 
                        type="button"
                        wire:click="$set('activeTab', '{{ $level }}')" 
                        style="padding: 0.6rem 1.5rem; font-size: 0.80rem; font-weight: 800; cursor: pointer; transition: all 0.2s ease; {{ $activeTab === $level ? 'background: #ffffff; color: #111827; border-top: 1.5px solid #fde68a; border-left: 1.5px solid #fde68a; border-right: 1.5px solid #fde68a; border-bottom: 2px solid #ffffff; border-top-left-radius: 0.875rem; border-top-right-radius: 0.875rem; position: relative; z-index: 6;' : 'background-color: #f3f4f6; color: #6b7280; border: 1.5px solid #e5e7eb; border-bottom: 1.5px solid #fde68a; border-top-left-radius: 0.875rem; border-top-right-radius: 0.875rem;' }}"
                    >
                        {{ $level }}
                    </button>
                @endforeach
            </div>

            {{-- KOTAK KONTEN UTAMA MODUL --}}
            <div style="background: #ffffff; padding: 2rem; border-radius: 1rem; border-top-left-radius: 0; border: 1.5px solid #fde68a; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02); width: 100%; box-sizing: border-box; position: relative; z-index: 4;">
                <div style="display: flex; flex-direction: column; gap: 1rem; width: 100%;">
                    @forelse ($modules as $module)
                        <div style="border: 1.5px solid #fde68a; border-radius: 1rem; padding: 1.25rem 1.5rem; display: flex; align-items: center; justify-content: space-between; gap: 1.5rem; background: #ffffff; position: relative; box-shadow: 0 2px 6px rgba(245, 158, 11, 0.04); transition: all 0.2s ease;" class="hover:shadow-md hover:border-amber-400">
                            
                            {{-- Sisi Kiri: Gambar Sampul --}}
                            <div style="display: flex; align-items: center; gap: 1.25rem; flex: 1; min-width: 0;">
                                @if(!empty($module->cover))
                                    <a href="{{ asset('storage/' . $module->cover) }}" target="_blank" title="Lihat gambar sampul" style="text-decoration: none; flex-shrink: 0;">
                                        <div style="width: 4.25rem; height: 5.75rem; border-radius: 0.75rem; overflow: hidden; border: 2px solid #ffffff; box-shadow: 0 4px 10px rgba(250, 204, 21, 0.3); background-color: #ffffff; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); transform: scale(1);" class="hover:scale-105 hover:shadow-lg">
                                            <img src="{{ asset('storage/' . $module->cover) }}" alt="Sampul" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;" class="hover:scale-110" />
                                        </div>
                                    </a>
                                @else
                                    <div style="width: 4.25rem; height: 5.75rem; background-color: #facc15; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; color: #111827; flex-shrink: 0; border: 2px solid #eab308; box-shadow: 0 4px 10px rgba(250, 204, 21, 0.2);">
                                        <svg style="width: 1.5rem; height: 1.5rem;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                    </div>
                                @endif

                                {{-- Informasi Modul --}}
                                <div style="display: flex; flex-direction: column; gap: 0.25rem; min-width: 0; flex: 1;">
                                    <div style="display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;">
                                        <span style="font-size: 1rem; font-weight: 800; color: #111827;">{{ $module->title }}</span>
                                        
                                        <span style="font-size: 0.7rem; font-weight: 800; background-color: #facc15; color: #111827; padding: 0.2rem 0.6rem; border-radius: 0.5rem; border: 1px solid #eab308; white-space: nowrap; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">{{ $module->grade }}</span>
                                        
                                        {{-- Tombol Buka Materi PDF (Memanggil method openPdfModal di PHP) --}}
                                        @if(!empty($module->file_path))
                                            <button 
                                                type="button"
                                                wire:click="openPdfModal({{ $module->id }})"
                                                style="display: inline-flex; align-items: center; gap: 0.3rem; background-color: #facc15; color: #111827; padding: 0.25rem 0.75rem; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 800; text-decoration: none; border: 1px solid #eab308; box-shadow: 0 1px 2px rgba(0,0,0,0.02); cursor: pointer; transition: all 0.2s ease;" 
                                                class="hover:bg-amber-400"
                                            >
                                                <svg style="width: 14px; height: 14px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                </svg>
                                                Buka Materi PDF
                                            </button>
                                        @endif
                                    </div>

                                    @if(!empty($module->description))
                                        <div>
                                            <p style="font-size: 0.8rem; color: #4b5563; margin: 0; line-height: 1.4; word-break: break-word;" 
                                                :style="expanded[{{ $module->id }}] ? '' : 'display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden;'">
                                                {{ $module->description }}
                                            </p>
                                            
                                            @if(strlen($module->description) > 80)
                                                <button type="button" 
                                                        @click="expanded[{{ $module->id }}] = !expanded[{{ $module->id }}]" 
                                                        style="background: none; border: none; color: #d97706; font-size: 0.75rem; font-weight: 700; cursor: pointer; padding: 0.1rem 0; display: inline-flex; align-items: center;">
                                                    <span x-text="expanded[{{ $module->id }}] ? 'Tampilkan lebih sedikit' : 'Selengkapnya...'"></span>
                                                </button>
                                            @endif
                                        </div>
                                    @endif

                                    <span style="font-size: 0.7rem; color: #9ca3af; font-weight: 600; margin-top: 0.1rem;">Dibuat: {{ \Illuminate\Support\Carbon::parse($module->created_at)->locale('id')->translatedFormat('d F Y') }}</span>
                                </div>
                            </div>

                            {{-- Sisi Kanan: Tombol Aksi Edit & Hapus --}}
                            <div style="display: flex; align-items: center; gap: 1rem; flex-shrink: 0;">
                                {{-- Tombol Edit --}}
                                <button type="button" wire:click="editModule({{ $module->id }})" title="Edit Modul" style="background: transparent; border: none; cursor: pointer; padding: 0.2rem; display: flex; align-items: center; justify-content: center; transition: opacity 0.2s;" class="hover:opacity-75">
                                    <svg style="width: 24px; height: 24px; color: #b45309;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                        <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                    </svg>
                                </button>
                                
                                {{-- Tombol Hapus --}}
                                <button type="button" wire:click="deleteModule({{ $module->id }})" wire:confirm="Apakah Anda yakin ingin menghapus modul ini?" title="Hapus Modul" style="background: transparent; border: none; cursor: pointer; padding: 0.2rem; display: flex; align-items: center; justify-content: center; transition: opacity 0.2s;" class="hover:opacity-75">
                                    <svg style="width: 24px; height: 24px; color: #dc2626;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.56 1.21-2.83 2.763-2.952a41.286 41.286 0 0 1 4.974 0c1.553.122 2.763 1.392 2.763 2.952Zm-10.612 2.21 1.005 13.07a1.5 1.5 0 0 0 1.496 1.385h7.828a1.5 1.5 0 0 0 1.496-1.385l1.005-13.07a48.667 48.667 0 0 0-13.33 0ZM10 9.75a.75.75 0 0 1 .75.75v7.5a.75.75 0 0 1-1.5 0v-7.5a.75.75 0 0 1 .75-.75Zm4 0a.75.75 0 0 1 .75.75v7.5a.75.75 0 0 1-1.5 0v-7.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                        <path d="M10.5 2.5a39.9 39.9 0 0 1 3 0 .75.75 0 0 1 0 1.5 38.4 38.4 0 0 0-3 0 .75.75 0 0 1 0-1.5Z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div style="text-align: center; color: #6b7280; font-size: 0.875rem; padding: 3.5rem 0; font-weight: 600;">
                            📂 Tidak ada modul yang tersedia di <span style="color: #d97706;">{{ $activeTab }}</span>.
                        </div>
                    @endforelse
                </div>

                {{-- PAGINATION --}}
                <div style="margin-top: 2rem; padding-top: 1rem; border-top: 1px solid #fef3c7; width: 100%;">
                    {{ $modules->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL POPUP INTERNAL UNTUK MENAMPILKAN PDF --}}
    @if($isPdfModalOpen)
        <div style="position: fixed; inset: 0; z-index: 99999; background-color: rgba(0, 0, 0, 0.6); backdrop-filter: blur(4px); display: flex; align-items: center; justify-content: center; padding: 1.5rem;">
            <div style="background: #ffffff; width: 100%; max-width: 75rem; height: 85vh; border-radius: 1rem; display: flex; flex-direction: column; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);">
                
                {{-- Header Modal --}}
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 1rem 1.5rem; background: #f59e0b; border-bottom: 1px solid #e5e7eb;">
                    <h3 style="font-size: 1rem; font-weight: 800; color: #111827; margin: 0;">Pratinjau Modul PDF</h3>
                    <button type="button" wire:click="closePdfModal" style="background: transparent; border: none; font-size: 1.25rem; font-weight: bold; cursor: pointer;">✕</button>
                </div>

                {{-- Konten PDF Viewer --}}
                <div style="flex: 1; width: 100%; background: #f3f4f6;">
                    <iframe src="{{ $selectedPdfUrl }}" width="100%" height="100%" style="border: none;"></iframe>
                </div>

                {{-- Footer Modal --}}
                <div style="padding: 0.75rem 1.5rem; display: flex; justify-content: flex-end; background: #f9fafb; border-top: 1px solid #e5e7eb;">
                    <button type="button" wire:click="closePdfModal" style="padding: 0.5rem 1rem; background-color: #e5e7eb; color: #374151; font-weight: 700; border-radius: 0.5rem; border: none; cursor: pointer;">Tutup</button>
                </div>

            </div>
        </div>
    @endif
</x-filament-panels::page>