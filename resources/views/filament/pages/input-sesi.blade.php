<x-filament-panels::page>
    <div style="display: flex; flex-direction: column; gap: 1.75rem; max-width: 100%;">
        
        {{-- Header Info Halaman --}}
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
        <div style="background: #ffffff; padding: 2rem; border-radius: 1rem; border: 1.5px solid #fde68a; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04); display: flex; flex-direction: column; gap: 1.5rem;">
            
            <form wire:submit="submit" style="display: flex; flex-direction: column; gap: 1.5rem;">
                
                {{-- Kustom Dropdown Siswa (Diletakkan paling atas agar tutor memilih siswa dulu) --}}
                <div style="display: flex; flex-direction: column; gap: 0.35rem; width: 100%;">
                    <label style="font-size: 0.875rem; font-weight: 700; color: #374151;">Siswa <span style="color: #dc2626;">*</span></label>
                    
                    <div x-data="{ 
                        open: false, 
                        search: '',
                        selectedName: @js($student_id ? \App\Models\Student::find($student_id)?->name ?? 'Pilih siswa.....' : 'Pilih siswa.....')
                    }" style="position: relative; width: 100%; display: block;">
                        
                        {{-- Kotak Utama (Trigger) --}}
                        <div @click="open = !open" style="
                            border: 1.5px solid #fde68a; 
                            border-radius: 0.75rem; 
                            background-color: #ffffff; 
                            display: flex; 
                            align-items: center; 
                            justify-content: space-between; 
                            cursor: pointer;
                            box-shadow: 0 1px 2px rgba(0,0,0,0.01);
                            width: 100%;
                            overflow: hidden;
                            box-sizing: border-box;
                        ">
                            <div style="display: flex; align-items: center; flex: 1; overflow: hidden;">
                                <div style="
                                    display: flex; 
                                    align-items: center; 
                                    justify-content: center; 
                                    padding: 0.65rem 0.85rem; 
                                    background-color: #ffffff; 
                                    border-right: 1.5px solid #fde68a; 
                                    color: #6b7280;
                                    flex-shrink: 0;
                                ">
                                    <svg style="width: 20px; height: 20px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v-.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                    </svg>
                                </div>
                                <div style="padding-left: 0.85rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    <span x-text="selectedName" style="font-size: 0.875rem; font-weight: 500; color: #111827;"></span>
                                </div>
                            </div>

                            <div style="display: flex; align-items: center; justify-content: center; color: #4b5563; padding-right: 0.85rem; padding-left: 0.5rem; flex-shrink: 0;">
                                <svg style="width: 18px; height: 18px; transition: transform 0.2s;" :style="open ? 'transform: rotate(180deg)' : ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </div>

                        {{-- Kotak Daftar Dropdown dengan Pencarian --}}
                        <div x-show="open" @click.outside="open = false" style="
                            position: absolute; 
                            top: calc(100% + 4px); 
                            left: 0; 
                            right: 0; 
                            width: 100%;
                            background: #fff; 
                            border: 1px solid #9ca3af; 
                            border-radius: 0px; 
                            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); 
                            z-index: 99; 
                            max-height: 280px; 
                            overflow-y: auto;
                            box-sizing: border-box;
                        " x-cloak>
                            
                            <div style="padding: 0.5rem; border-bottom: 1px solid #e5e7eb; background: #f9fafb; position: sticky; top: 0; z-index: 10;">
                                <input type="text" x-model="search" placeholder="Cari nama siswa..." style="
                                    width: 100%; 
                                    padding: 0.4rem 0.75rem; 
                                    font-size: 0.85rem; 
                                    border: 1px solid #d1d5db; 
                                    border-radius: 4px; 
                                    outline: none;
                                    box-sizing: border-box;
                                " @click.stop />
                            </div>

                            @php
                                $user = Auth::user();
                                $studentQuery = \App\Models\Student::query();
                                if ($user && method_exists($user, 'hasRole') && !$user->hasRole('super_admin')) {
                                    if (isset($user->branch_id)) {
                                        $studentQuery->where('branch_id', $user->branch_id);
                                    }
                                }
                                $students = $studentQuery->get();
                            @endphp

                            <div wire:click="$set('student_id', null)" 
                                 @click="selectedName = 'Pilih siswa.....'; open = false; search = '';" 
                                 style="padding: 0.6rem 1rem; cursor: pointer; border-radius: 0px; font-size: 0.875rem; color: #374151;"
                                 onmouseover="this.style.backgroundColor='#2563eb'; this.style.color='#ffffff';"
                                 onmouseout="this.style.backgroundColor='transparent'; this.style.color='#374151';">
                                Pilih siswa.....
                            </div>

                            @forelse($students as $student)
                                <div x-show="search === '' || @js(strtolower($student->name)).includes(search.toLowerCase())"
                                     wire:click="$set('student_id', {{ $student->id }})" 
                                     @click="selectedName = '{{ $student->name }}'; open = false; search = '';" 
                                     style="padding: 0.5rem 1rem; cursor: pointer; border-radius: 0px;" 
                                     onmouseover="this.style.backgroundColor='#2563eb'; this.style.color='#ffffff'; this.querySelectorAll('.student-name').forEach(el => el.style.color='#ffffff');"
                                     onmouseout="this.style.backgroundColor='transparent'; this.style.color='#111827'; this.querySelectorAll('.student-name').forEach(el => el.style.color='#111827');">
                                    
                                    <table style="width: 100%; border-collapse: collapse; background: transparent !important;">
                                        <tr>
                                            <td style="width: 40px; padding: 0; vertical-align: middle;">
                                                @if(!empty($student->avatar))
                                                    <img src="{{ Str::startsWith($student->avatar, ['http://', 'https://']) ? $student->avatar : asset('storage/' . $student->avatar) }}" alt="Foto" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover; border: 1px solid #d1d5db; display: block;" />
                                                @else
                                                    <div style="width: 32px; height: 32px; border-radius: 50%; background-color: #e5e7eb; color: #374151; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.75rem;">
                                                        {{ substr($student->name, 0, 2) }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td style="padding: 0 0 0 10px; vertical-align: middle;">
                                                <span class="student-name" style="font-size: 0.875rem; font-weight: 500; color: #111827;">{{ $student->name }}</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            @empty
                                <div style="padding: 0.75rem 1rem; text-align: center; color: #6b7280; font-size: 0.85rem;">
                                    Tidak ada data siswa
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Render Form Filament (Tanggal, Modul Sebelumnya, Status Sebelumnya, Modul Saat Ini, Status Sesi, Catatan) --}}
                {{ $this->form }}

                {{-- Tombol Aksi Simpan --}}
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