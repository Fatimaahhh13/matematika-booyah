<x-filament-panels::page>
    <div style="display: flex; flex-direction: column; gap: 1.75rem; max-width: 100%;">
        
        {{-- Header Info Halaman dengan Gradasi Kuning Header --}}
        <div style="background: linear-gradient(135deg, #ffc72c 0%, #f59e0b 100%); padding: 1.5rem 1.75rem; border-radius: 1rem; border: none; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); display: flex; align-items: center; justify-content: space-between;">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(255, 255, 255, 0.3); display: flex; align-items: center; justify-content: center; color: #000000; border: 1px solid rgba(255, 255, 255, 0.4);">
                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.2rem;">
                    <h2 style="font-size: 1.1rem; font-weight: 800; color: #000000; margin: 0;">Formulir Input Sesi Bimbingan</h2>
                    <span style="font-size: 0.8rem; font-weight: 500; color: rgba(0, 0, 0, 0.75);">Silakan lengkapi detail jadwal, siswa, dan modul pembelajaran sesi hari ini.</span>
                </div>
            </div>
        </div>

        {{-- Kontainer Utama Form --}}
        <div style="background: #ffffff; padding: 2rem; border-radius: 1rem; border: 1px solid #e5e7eb; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04); display: flex; flex-direction: column; gap: 1.5rem;">
            
            <form wire:submit="submit" style="display: flex; flex-direction: column; gap: 1.5rem;">
                
                {{-- Render Form dari Filament --}}
                {{ $this->form }}

                {{-- Tombol Aksi Simpan Kustom yang Elegan --}}
                <div style="display: flex; align-items: center; justify-content: flex-end; gap: 1rem; border-top: 1px solid #f3f4f6; padding-top: 1.25rem; margin-top: 0.5rem;">
                    <button 
                        type="submit" 
                        style="display: inline-flex; align-items: center; justify-content: center; padding: 0.75rem 2rem; background: linear-gradient(135deg, #ffc72c 0%, #f59e0b 100%); color: #000000; font-size: 0.875rem; font-weight: 800; border-radius: 0.75rem; border: none; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(245, 158, 11, 0.3); transition: all 0.2s ease;"
                    >
                        Tambah Sesi
                    </button>
                </div>

            </form>

        </div>

    </div>
</x-filament-panels::page>