<?php

namespace App\Filament\Resources\Modules\Pages;

use App\Filament\Resources\Modules\ModuleResource;
use App\Models\Module;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;

class ListModules extends ListRecords
{
    protected static string $resource = ModuleResource::class;

    protected static ?string $title = 'Modul';
    
    protected string $view = 'filament.resources.modules.list-modules';

    public ?string $activeTab = 'Level A';
    public ?string $search = '';

    // State untuk mengontrol modal PDF internal
    public bool $isPdfModalOpen = false;
    public ?string $selectedPdfUrl = null;

    public function openPdfModal(int $id): void
    {
        $module = Module::find($id);

        if ($module && $module->file_path) {
            $this->selectedPdfUrl = asset('storage/' . $module->file_path);
            $this->isPdfModalOpen = true;
        }
    }

    public function closePdfModal(): void
    {
        $this->isPdfModalOpen = false;
        $this->selectedPdfUrl = null;
    }

    // Mengubah teks breadcrumb "List" menjadi "Daftar"
    public function getBreadcrumb(): string
    {
        return 'Daftar';
    }

    // Memperlebar tampilan halaman List agar penuh ke samping
    public function getMaxContentWidth(): Width|string|null
    {
        return Width::Full;
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getViewData(): array
    {
        $query = Module::query();

        // Menyaring berdasarkan tab level aktif
        if ($this->activeTab) {
            $query->where('grade', $this->activeTab);
        }

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        // Hitung total modul sesuai filter aktif
        $totalModules = (clone $query)->count();

        return [
            'modules' => $query->paginate(16),
            'totalModules' => $totalModules,
        ];
    }

    public function editModule(int $id): void
    {
        $this->redirect(ModuleResource::getUrl('edit', ['record' => $id]));
    }

    public function deleteModule(int $id): void
    {
        Module::destroy($id);
    }
}