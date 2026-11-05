<x-filament-widgets::widget>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem;">
        
        {{-- KARTU 1: TOTAL CABANG --}}
        <div style="background-color: #ffffff; border: 1.5px solid #f59e0b; border-radius: 0.875rem; padding: 1rem 1.25rem; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.01); position: relative; overflow: hidden;" class="hover:shadow-md">
            <div>
                <span style="font-size: 0.68rem; font-weight: 700; color: #d97706; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 0.25rem;">Total Cabang</span>
                <div style="font-size: 1.75rem; font-weight: 800; color: #111827; line-height: 1; margin-bottom: 0.375rem;">{{ $totalCabang }}</div>
                <div style="display: flex; align-items: center; gap: 0.375rem; font-size: 0.725rem; font-weight: 600; color: #b45309;">
                    <span style="width: 5px; height: 5px; background-color: #f59e0b; border-radius: 50%; display: inline-block;"></span>
                    Aktif Beroperasi
                </div>
            </div>
            <div style="width: 3rem; height: 3rem; background-color: #fffbeb; border: 1.5px solid #f59e0b; border-radius: 0.625rem; display: flex; align-items: center; justify-content: center; color: #d97706;">
                <svg style="width: 1.5rem; height: 1.5rem;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 1 2.25 1.016c.55.623 1.354 1.016 2.25 1.016.965 0 1.85-.335 2.545-.915V21M3.75 9.349a3.001 3.001 0 0 1 3.75-.615c.965 0 1.85.335 2.545.915m11.91 0c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
            </div>
        </div>

        {{-- KARTU 2: TOTAL TUTOR --}}
        <div style="background-color: #ffffff; border: 1.5px solid #f59e0b; border-radius: 0.875rem; padding: 1rem 1.25rem; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.01); position: relative; overflow: hidden;" class="hover:shadow-md">
            <div>
                <span style="font-size: 0.68rem; font-weight: 700; color: #d97706; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 0.25rem;">Total Tutor</span>
                <div style="font-size: 1.75rem; font-weight: 800; color: #111827; line-height: 1; margin-bottom: 0.375rem;">{{ $totalTutor }}</div>
                <div style="display: flex; align-items: center; gap: 0.375rem; font-size: 0.725rem; font-weight: 600; color: #b45309;">
                    <span style="width: 5px; height: 5px; background-color: #f59e0b; border-radius: 50%; display: inline-block;"></span>
                    Semua Cabang
                </div>
            </div>
            <div style="width: 3rem; height: 3rem; background-color: #fffbeb; border: 1.5px solid #f59e0b; border-radius: 0.625rem; display: flex; align-items: center; justify-content: center; color: #d97706;">
                <svg style="width: 1.5rem; height: 1.5rem;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.637 48.637 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 1-2.658-.813A59.905 59.905 0 0 1 12 3.493a59.902 59.902 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 3v-3.75m4.5 3.75V15m0 0a.75.75 0 1 1 1.5 0v3.75m-1.5-3.75h3.75" />
                </svg>
            </div>
        </div>

        {{-- KARTU 3: TOTAL SISWA --}}
        <div style="background-color: #ffffff; border: 1.5px solid #f59e0b; border-radius: 0.875rem; padding: 1rem 1.25rem; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.01); position: relative; overflow: hidden;" class="hover:shadow-md">
            <div>
                <span style="font-size: 0.68rem; font-weight: 700; color: #d97706; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 0.25rem;">Total Siswa</span>
                <div style="font-size: 1.75rem; font-weight: 800; color: #111827; line-height: 1; margin-bottom: 0.375rem;">{{ $totalSiswa }}</div>
                <div style="display: flex; align-items: center; gap: 0.375rem; font-size: 0.725rem; font-weight: 600; color: #b45309;">
                    <span style="width: 5px; height: 5px; background-color: #f59e0b; border-radius: 50%; display: inline-block;"></span>
                    Siswa Aktif
                </div>
            </div>
            <div style="width: 3rem; height: 3rem; background-color: #fffbeb; border: 1.5px solid #f59e0b; border-radius: 0.625rem; display: flex; align-items: center; justify-content: center; color: #d97706;">
                <svg style="width: 1.5rem; height: 1.5rem;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
            </div>
        </div>

    </div>
</x-filament-widgets::widget>