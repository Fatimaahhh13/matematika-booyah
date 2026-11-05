<x-filament-panels::page>
    <style>
        .fi-page {
            max-width: 100% !important;
        }
        .fi-main {
            max-width: 100% !important;
        }
    </style>

    <div style="display: flex; flex-direction: column; gap: 2rem; width: 100%;">
        
        {{-- WELCOME BANNER KHUSUS ADMIN CABANG (Latar Belakang Kuning) --}}
        <div style="background-color: #ffc72c; border: 1.5px solid #f59e0b; border-radius: 1rem; padding: 2.25rem 2.5rem; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02); position: relative; overflow: hidden; width: 100%; box-sizing: border-box;">
            
            <div style="display: flex; flex-direction: column; gap: 0.5rem; z-index: 2;">
                <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 1.25rem; font-weight: 700; color: #1f2937;">
                    <span>Welcome back, 👋</span>
                </div>
                <h1 style="font-size: 2.25rem; font-weight: 900; color: #000000; margin: 0; line-height: 1.2;">
                    {{ auth()->user()->name ?? 'Admin Cabang' }}!
                </h1>
                <p style="font-size: 1.05rem; font-weight: 600; color: #374151; margin: 0;">
                    Kelola data siswa, pengajar, serta pantau progres belajar bimbingan Matematika Booyah di cabang Anda dengan mudah.
                </p>
            </div>

            <div class="hidden md:flex items-center gap-4" style="z-index: 2;">
                <div style="background: #ffffff; padding: 1.25rem; border-radius: 0.75rem; border: 1.5px solid #f59e0b; display: flex; align-items: center; justify-content: center; box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);">
                    <svg style="width: 56px; height: 56px; color: #d97706;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 1 2.25 1.016c.55.623 1.354 1.016 2.25 1.016.965 0 1.85-.335 2.545-.915V21M3.75 9.349a3.001 3.001 0 0 1 3.75-.615c.965 0 1.85.335 2.545.915m11.91 0c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </div>
            </div>

            <div style="position: absolute; right: -50px; bottom: -50px; width: 220px; height: 220px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; pointer-events: none;"></div>
        </div>
        
        {{-- Bagian Atas: 3 Kartu Statistik Informatif & Modern --}}
        <div style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1.5rem;">
            
            {{-- Kartu SISWA --}}
            <div style="background: #ffffff; padding: 1.5rem; border-radius: 1rem; border: 1.5px solid #f59e0b; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04); display: flex; align-items: center; justify-content: space-between; position: relative; overflow: hidden;">
                <div style="position: absolute; top: 0; left: 0; bottom: 0; width: 4px; background: #eab308; border-radius: 4px 0 0 4px;"></div>
                <div style="display: flex; flex-direction: column; gap: 0.3rem; padding-left: 0.5rem;">
                    <span style="font-size: 0.7rem; font-weight: 700; color: #6b7280; letter-spacing: 0.05em; text-transform: uppercase;">Total Siswa</span>
                    <div style="font-size: 2.25rem; font-weight: 900; color: #111827; line-height: 1;">
                        {{ $totalSiswa ?? 0 }}
                    </div>
                    <span style="font-size: 0.7rem; font-weight: 600; color: #10b981;">● Aktif di Cabang Ini</span>
                </div>
                <div style="width: 50px; height: 50px; border-radius: 14px; background: #fefce8; display: flex; align-items: center; justify-content: center; color: #ca8a04; border: 1px solid #fef08a;">
                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>

            {{-- Kartu TUTOR --}}
            <div style="background: #ffffff; padding: 1.5rem; border-radius: 1rem; border: 1.5px solid #f59e0b; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04); display: flex; align-items: center; justify-content: space-between; position: relative; overflow: hidden;">
                <div style="position: absolute; top: 0; left: 0; bottom: 0; width: 4px; background: #eab308; border-radius: 4px 0 0 4px;"></div>
                <div style="display: flex; flex-direction: column; gap: 0.3rem; padding-left: 0.5rem;">
                    <span style="font-size: 0.7rem; font-weight: 700; color: #6b7280; letter-spacing: 0.05em; text-transform: uppercase;">Total Tutor</span>
                    <div style="font-size: 2.25rem; font-weight: 900; color: #111827; line-height: 1;">
                        {{ $totalTutor ?? 0 }}
                    </div>
                    <span style="font-size: 0.7rem; font-weight: 600; color: #10b981;">● Pengajar Bertugas</span>
                </div>
                <div style="width: 50px; height: 50px; border-radius: 14px; background: #fefce8; display: flex; align-items: center; justify-content: center; color: #ca8a04; border: 1px solid #fef08a;">
                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                </div>
            </div>

            {{-- Kartu TOTAL SESI BIMBINGAN (Pengganti Rasio Siswa / Tutor) --}}
            <div style="background: #ffffff; padding: 1.5rem; border-radius: 1rem; border: 1.5px solid #f59e0b; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04); display: flex; align-items: center; justify-content: space-between; position: relative; overflow: hidden;">
                <div style="position: absolute; top: 0; left: 0; bottom: 0; width: 4px; background: #eab308; border-radius: 4px 0 0 4px;"></div>
                <div style="display: flex; flex-direction: column; gap: 0.3rem; padding-left: 0.5rem;">
                    <span style="font-size: 0.7rem; font-weight: 700; color: #6b7280; letter-spacing: 0.05em; text-transform: uppercase;">Total Sesi Bimbingan</span>
                    <div style="font-size: 2.25rem; font-weight: 900; color: #111827; line-height: 1;">
                        {{ $totalSesi ?? 0 }}
                    </div>
                    <span style="font-size: 0.7rem; font-weight: 600; color: #10b981;">● Sesi Tercatat di Cabang Ini</span>
                </div>
                <div style="width: 50px; height: 50px; border-radius: 14px; background: #fefce8; display: flex; align-items: center; justify-content: center; color: #ca8a04; border: 1px solid #fef08a;">
                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
            </div>

        </div>

        {{-- Bagian Bawah: Grafik Distribusi Siswa dengan Sumbu Y 20 sampai 100 kelipatan 5 --}}
        <div style="background: #ffffff; padding: 2rem; border-radius: 1rem; border: 1.5px solid #f59e0b; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04); display: flex; flex-direction: column; gap: 1.5rem;">
            
            <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                <h3 style="font-size: 1.15rem; font-weight: 800; color: #111827; margin: 0; letter-spacing: -0.01em;">Distribusi Siswa</h3>
                <span style="font-size: 0.8rem; font-weight: 500; color: #6b7280;">Rekapitulasi jumlah siswa aktif berdasarkan tingkat level pembelajaran</span>
            </div>

            @php
                $maxVal = 100;
                $chartHeight = 200; 
                
                $hA = (($levelA ?? 0) / $maxVal) * $chartHeight;
                $hB = (($levelB ?? 0) / $maxVal) * $chartHeight;
                $hC = (($levelC ?? 0) / $maxVal) * $chartHeight;
            @endphp

            <div style="position: relative; width: 100%; height: 290px; padding: 1rem 1.5rem 2.5rem 3.5rem; box-sizing: border-box;">
                
                {{-- Garis Grid Horizontal Kelipatan 20 (dari 20 sampai 100) --}}
                @foreach([100, 80, 60, 40, 20, 0] as $val)
                    @php
                        $percentage = $val / 100;
                        $bottomPx = 45 + ($percentage * $chartHeight);
                    @endphp
                    <div style="position: absolute; left: 3.5rem; right: 1.5rem; bottom: {{ $bottomPx }}px; border-bottom: 1px solid {{ $val === 0 ? '#9ca3af' : '#f3f4f6' }}; height: 0; display: flex; align-items: center; z-index: 1;">
                        <span style="position: absolute; left: -38px; font-size: 0.75rem; color: #9ca3af; font-weight: 600; text-align: right; width: 30px;">{{ $val }}</span>
                    </div>
                @endforeach

                {{-- Wadah Batang Grafik --}}
                <div style="position: absolute; left: 3.5rem; right: 1.5rem; bottom: 45px; height: {{ $chartHeight }}px; display: flex; justify-content: space-around; align-items: flex-end; z-index: 2;">
                    
                    {{-- Level A --}}
                    <div style="display: flex; flex-direction: column; align-items: center; width: 100px; height: 100%; justify-content: flex-end; position: relative;">
                        <div style="position: absolute; bottom: {{ max($hA + 12, 12) }}px; font-size: 0.75rem; font-weight: 800; color: #92400e; background: #fef3c7; padding: 0.2rem 0.5rem; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.06); border: 1px solid #fde68a; white-space: nowrap;">
                            {{ $levelA ?? 0 }} Siswa
                        </div>
                        <div style="width: 54px; height: {{ max($hA, 8) }}px; background: linear-gradient(180deg, #fef08a 0%, #eab308 50%, #ca8a04 100%); border-radius: 8px 8px 0 0; box-shadow: 0 10px 15px -3px rgba(234, 179, 8, 0.25); transition: height 0.4s ease;"></div>
                    </div>

                    {{-- Level B --}}
                    <div style="display: flex; flex-direction: column; align-items: center; width: 100px; height: 100%; justify-content: flex-end; position: relative;">
                        <div style="position: absolute; bottom: {{ max($hB + 12, 12) }}px; font-size: 0.75rem; font-weight: 800; color: #92400e; background: #fef3c7; padding: 0.2rem 0.5rem; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.06); border: 1px solid #fde68a; white-space: nowrap;">
                            {{ $levelB ?? 0 }} Siswa
                        </div>
                        <div style="width: 54px; height: {{ max($hB, 8) }}px; background: linear-gradient(180deg, #fef08a 0%, #eab308 50%, #ca8a04 100%); border-radius: 8px 8px 0 0; box-shadow: 0 10px 15px -3px rgba(234, 179, 8, 0.25); transition: height 0.4s ease;"></div>
                    </div>

                    {{-- Level C --}}
                    <div style="display: flex; flex-direction: column; align-items: center; width: 100px; height: 100%; justify-content: flex-end; position: relative;">
                        <div style="position: absolute; bottom: {{ max($hC + 12, 12) }}px; font-size: 0.75rem; font-weight: 800; color: #92400e; background: #fef3c7; padding: 0.2rem 0.5rem; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.06); border: 1px solid #fde68a; white-space: nowrap;">
                            {{ $levelC ?? 0 }} Siswa
                        </div>
                        <div style="width: 54px; height: {{ max($hC, 8) }}px; background: linear-gradient(180deg, #fef08a 0%, #eab308 50%, #ca8a04 100%); border-radius: 8px 8px 0 0; box-shadow: 0 10px 15px -3px rgba(234, 179, 8, 0.25); transition: height 0.4s ease;"></div>
                    </div>

                </div>

                {{-- Label Sumbu X --}}
                <div style="position: absolute; left: 3.5rem; right: 1.5rem; bottom: 8px; display: flex; justify-content: space-around; z-index: 2;">
                    <div style="width: 100px; text-align: center; font-size: 0.813rem; font-weight: 800; color: #374151; background: #f9fafb; padding: 0.3rem 0; border-radius: 6px; border: 1px solid #e5e7eb;">Level A</div>
                    <div style="width: 100px; text-align: center; font-size: 0.813rem; font-weight: 800; color: #374151; background: #f9fafb; padding: 0.3rem 0; border-radius: 6px; border: 1px solid #e5e7eb;">Level B</div>
                    <div style="width: 100px; text-align: center; font-size: 0.813rem; font-weight: 800; color: #374151; background: #f9fafb; padding: 0.3rem 0; border-radius: 6px; border: 1px solid #e5e7eb;">Level C</div>
                </div>

            </div>

        </div>

    </div>
</x-filament-panels::page>