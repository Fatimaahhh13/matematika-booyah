<x-filament-widgets::widget>
    <div style="background-color: #ffc72c; border: 1.5px solid #f59e0b; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);">
        
        {{-- Header & Filter --}}
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; gap: 1rem; flex-wrap: wrap;">
            <div>
                <h3 style="font-size: 1.125rem; font-weight: 800; color: #000000; margin: 0; letter-spacing: -0.01em;">Distribusi Siswa</h3>
                <p style="font-size: 0.75rem; color: #374151; margin-top: 0.2rem; font-weight: 600;">Rekapitulasi jumlah siswa berdasarkan level dan wilayah cabang</p>
            </div>
            
            <div style="display: flex; gap: 0.75rem; align-items: center;">
                <select wire:model.live="selectedLevel" style="font-size: 0.75rem; font-weight: 600; border: 1.5px solid #f59e0b; border-radius: 0.5rem; padding: 0.4rem 0.8rem; background-color: #ffffff; color: #374151; outline: none; cursor: pointer;">
                    <option value="all">Semua Level</option>
                    <option value="A">Level A</option>
                    <option value="B">Level B</option>
                    <option value="C">Level C</option>
                </select>

                <select wire:model.live="selectedBranch" style="font-size: 0.75rem; font-weight: 600; border: 1.5px solid #f59e0b; border-radius: 0.5rem; padding: 0.4rem 0.8rem; background-color: #ffffff; color: #374151; outline: none; cursor: pointer;">
                    <option value="all">Semua Cabang</option>
                    @foreach ($allBranches as $branchOption)
                        <option value="{{ $branchOption->id }}">{{ $branchOption->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Cards Level A, B, C dengan Ikon Elegan --}}
        <div style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1.25rem; margin-bottom: 1.75rem;">
            
            {{-- Level A --}}
            @if ($selectedLevel === 'all' || $selectedLevel === 'A')
            <div style="padding: 1.25rem; background-color: #ffffff; border: 1.5px solid #f59e0b; border-radius: 0.75rem; display: flex; flex-direction: column; justify-content: space-between; height: 7.5rem; position: relative; overflow: hidden;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.7rem; font-weight: 700; color: #d97706; text-transform: uppercase; letter-spacing: 0.05em;">Level A</span>
                    <div style="width: 2rem; height: 2rem; background-color: #fffbeb; border: 1px solid #fde68a; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; color: #d97706;">
                        <svg style="width: 1rem; height: 1rem;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385c.116.488-.415.87-.837.614L12 18.28l-4.71 2.664c-.422.256-.953-.126-.837-.614l1.285-5.385a.563.563 0 00-.182-.557l-4.204-3.602c-.38-.325-.178-.948.32-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>
                    </div>
                </div>
                <div style="font-size: 2rem; font-weight: 800; color: #111827; line-height: 1;">{{ $levelA }}</div>
                <span style="font-size: 0.75rem; color: #6b7280; font-weight: 600;">Total Siswa</span>
            </div>
            @endif

            {{-- Level B --}}
            @if ($selectedLevel === 'all' || $selectedLevel === 'B')
            <div style="padding: 1.25rem; background-color: #ffffff; border: 1.5px solid #f59e0b; border-radius: 0.75rem; display: flex; flex-direction: column; justify-content: space-between; height: 7.5rem; position: relative; overflow: hidden;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.7rem; font-weight: 700; color: #d97706; text-transform: uppercase; letter-spacing: 0.05em;">Level B</span>
                    <div style="width: 2rem; height: 2rem; background-color: #fffbeb; border: 1px solid #fde68a; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; color: #d97706;">
                        <svg style="width: 1rem; height: 1rem;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 005.814-5.519l2.74-1.22m0 0l-5.94-2.281m5.94 2.28l-2.28 5.941" />
                        </svg>
                    </div>
                </div>
                <div style="font-size: 2rem; font-weight: 800; color: #111827; line-height: 1;">{{ $levelB }}</div>
                <span style="font-size: 0.75rem; color: #6b7280; font-weight: 600;">Total Siswa</span>
            </div>
            @endif

            {{-- Level C --}}
            @if ($selectedLevel === 'all' || $selectedLevel === 'C')
            <div style="padding: 1.25rem; background-color: #ffffff; border: 1.5px solid #f59e0b; border-radius: 0.75rem; display: flex; flex-direction: column; justify-content: space-between; height: 7.5rem; position: relative; overflow: hidden;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.7rem; font-weight: 700; color: #d97706; text-transform: uppercase; letter-spacing: 0.05em;">Level C</span>
                    <div style="width: 2rem; height: 2rem; background-color: #fffbeb; border: 1px solid #fde68a; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; color: #d97706;">
                        <svg style="width: 1rem; height: 1rem;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 003-3V8.25a3 3 0 00-3-3h-9a3 3 0 00-3 3v7.5a3 3 0 003 3m9 0v-1.5a1.5 1.5 0 00-1.5-1.5h-6a1.5 1.5 0 00-1.5 1.5v1.5m9 0h-9" />
                        </svg>
                    </div>
                </div>
                <div style="font-size: 2rem; font-weight: 800; color: #111827; line-height: 1;">{{ $levelC }}</div>
                <span style="font-size: 0.75rem; color: #6b7280; font-weight: 600;">Total Siswa</span>
            </div>
            @endif

        </div>

        {{-- Section Per Cabang dengan Skala Grafik Batang Proporsional --}}
        <div style="border-top: 1.5px solid #f59e0b; padding-top: 1.5rem;">
            <h4 style="font-size: 0.75rem; font-weight: 700; color: #1f2937; text-transform: uppercase; margin-bottom: 1.25rem; letter-spacing: 0.05em;">Per Cabang</h4>
            
            <div style="display: flex; flex-direction: column; gap: 0.875rem;">
                @php
                    $maxScale = 10;
                @endphp

                @forelse ($branches as $branch)
                    @php
                        $count = $branch['count'] ?? 0;
                        $percentage = min(($count / $maxScale) * 100, 100);
                    @endphp

                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 1.25rem; background-color: #ffffff; padding: 1rem 1.25rem; border-radius: 0.75rem; border: 1.5px solid #f59e0b; box-shadow: 0 1px 2px 0 rgba(0,0,0,0.02); transition: all 0.2s ease;">
                        
                        {{-- Nama Cabang & Ikon Gedung --}}
                        <div style="display: flex; align-items: center; gap: 0.75rem; width: 14rem; flex-shrink: 0;">
                            <div style="width: 2rem; height: 2rem; background-color: #fffbeb; border: 1px solid #fde68a; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; color: #d97706; flex-shrink: 0; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
                                <svg style="width: 1rem; height: 1rem;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 1 2.25 1.016c.55.623 1.354 1.016 2.25 1.016.965 0 1.85-.335 2.545-.915V21M3.75 9.349a3.001 3.001 0 0 1 3.75-.615c.965 0 1.85.335 2.545.915m11.91 0c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </div>
                            <span style="font-size: 0.875rem; font-weight: 700; color: #1f2937; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $branch['name'] }}</span>
                        </div>
                        
                        {{-- Bar Progres Dinamis Sesuai Jumlah Siswa --}}
                        <div style="flex: 1; background-color: #f3f4f6; border-radius: 9999px; height: 0.75rem; overflow: hidden; box-shadow: inset 0 1px 2px rgba(0,0,0,0.05); border: 1px solid #e5e7eb;">
                            <div style="background: linear-gradient(90deg, #f59e0b 0%, #ffc72c 100%); height: 100%; border-radius: 9999px; transition: width 0.6s ease; width: {{ $percentage }}%;"></div>
                        </div>
                        
                        {{-- Jumlah Siswa --}}
                        <span style="font-size: 0.8rem; font-weight: 800; color: #111827; background-color: #fffbeb; padding: 0.35rem 0.875rem; border-radius: 0.5rem; border: 1.5px solid #f59e0b; min-width: 3.25rem; text-align: center; box-shadow: 0 1px 2px 0 rgba(0,0,0,0.03);">{{ $count }}</span>
                    </div>
                @empty
                    {{-- Tampilan Pesan Ramah Saat Belum Ada Data Cabang --}}
                    <div style="background-color: #ffffff; border: 1.5px dashed #f59e0b; border-radius: 0.75rem; padding: 2rem; text-align: center;">
                        <p style="font-size: 0.875rem; font-weight: 700; color: #1f2937; margin: 0 0 0.25rem 0;">Belum ada data cabang</p>
                        <p style="font-size: 0.75rem; color: #4b5563; margin: 0; font-weight: 600;">Silakan tambahkan data cabang terlebih dahulu melalui menu manajemen cabang.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</x-filament-widgets::widget>