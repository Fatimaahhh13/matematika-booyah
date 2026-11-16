<x-filament-panels::page>
    <style>
        .fi-page {
            max-width: 100% !important;
        }
        .fi-main {
            max-width: 100% !important;
        }
    </style>

    <div style="display: flex; flex-direction: column; gap: 1.25rem; width: 100%;">
        
        {{-- BANNER SAMBUTAN SUPER ADMIN DENGAN BACKGROUND GAMBAR --}}
        <div style="
            background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0)), url('{{ asset('images/banner-bg.jpg') }}') center/cover no-repeat;
            border: 1.5px solid #f59e0b; 
            border-radius: 0.875rem; 
            padding: 3.5rem 1.75rem; 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
            position: relative; 
            overflow: hidden; 
            width: 100%; 
            box-sizing: border-box;
            color: #ffffff;
        ">
      
            <div style="display: flex; flex-direction: column; gap: 0.25rem; z-index: 2;">
                <div style="display: flex; align-items: center; gap: 0.375rem; font-size: 1rem; font-weight: 700; color: #000000">
                    <span>Welcome back</span>
                </div>
                <h1 style="font-size: 1.65rem; font-weight: 900; color: #000000; margin: 0; line-height: 1.2; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                    {{ auth()->user()->name ?? 'Super Admin' }}!
                </h1>
                <p style="font-size: 0.875rem; font-weight: 600; color: #000000; margin: 0;">
                    Kelola dan pantau seluruh operasional serta aktivitas bimbingan Matematika Booyah dengan mudah.
                </p>
            </div>

            <div class="hidden md:flex items-center gap-4" style="z-index: 2;">
                <div style="background: #ffffff; padding: 1.25rem; border-radius: 0.75rem; border: 1.5px solid #f59e0b; display: flex; align-items: center; justify-content: center; box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);">
                    <svg style="width: 56px; height: 56px; color: #d97706;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>
            </div>

            <div style="position: absolute; right: -40px; bottom: -40px; width: 160px; height: 160px; background: rgba(255, 255, 255, 0.1); border-radius: 50%; pointer-events: none;"></div>
        </div>

        {{-- WIDGET STATISTIK OVERVIEW --}}
        <div style="width: 100%;">
            @livewire(\App\Filament\Widgets\AdminOverview::class)
        </div>
        
        {{-- DISTRIBUSI SISWA --}}
        <div style="width: 100%;">
            @livewire(\App\Filament\Widgets\StudentDistribution::class)
        </div>

    </div>
</x-filament-panels::page>