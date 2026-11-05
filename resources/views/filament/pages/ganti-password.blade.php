<x-filament-panels::page style="width: 100%; max-width: none;">

    <div style="width: 100%; background: #ffffff; padding: 2rem; border-radius: 0.75rem; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); border: 1px solid #f3f4f6;"
         x-data="{ newPassword: '', isFocused: false }">

        <form wire:submit="submit" class="space-y-6" style="width: 100%;">

            {{ $this->form }}

            <!-- Indikator ketentuan password interaktif tanpa judul -->
            <div class="space-y-2 mt-4 transition-all duration-300" x-show="isFocused || newPassword.length > 0" x-transition>
                <ul class="text-xs space-y-2">
                    <!-- Syarat 1: Minimal 8 Karakter -->
                    <li class="flex items-center space-x-2.5 transition-all duration-300" 
                        :class="newPassword.length >= 8 ? 'text-emerald-600 font-medium translate-x-1' : 'text-gray-400'">
                        <span class="flex items-center justify-center w-4 h-4 rounded-full text-[10px] transition-colors duration-300"
                              :class="newPassword.length >= 8 ? 'bg-emerald-100 text-emerald-600 font-bold' : 'bg-gray-100 text-gray-400'"
                              x-text="newPassword.length >= 8 ? '✓' : '•'"></span>
                        <span x-text="'Minimal 8 karakter'"></span>
                    </li>

                    <!-- Syarat 2: Mengandung Angka -->
                    <li class="flex items-center space-x-2.5 transition-all duration-300" 
                        :class="/\d/.test(newPassword) ? 'text-emerald-600 font-medium translate-x-1' : 'text-gray-400'">
                        <span class="flex items-center justify-center w-4 h-4 rounded-full text-[10px] transition-colors duration-300"
                              :class="/\d/.test(newPassword) ? 'bg-emerald-100 text-emerald-600 font-bold' : 'bg-gray-100 text-gray-400'"
                              x-text="/\d/.test(newPassword) ? '✓' : '•'"></span>
                        <span x-text="'Mengandung angka'"></span>
                    </li>
                </ul>
            </div>
            
            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 1rem; border-top: 1px solid #f3f4f6; padding-top: 1.25rem; margin-top: 1.5rem; width: 100%;">
                <button 
                    type="submit" 
                    style="display: inline-flex; align-items: center; justify-content: center; padding: 0.75rem 2rem; background: linear-gradient(135deg, #ffc72c 0%, #f59e0b 100%); color: #000000; font-size: 0.875rem; font-weight: 800; border-radius: 0.75rem; border: none; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(245, 158, 11, 0.3); transition: all 0.2s ease;"
                >
                    Ubah Password
                </button>
            </div>
        </form>

    </div>

</x-filament-panels::page>