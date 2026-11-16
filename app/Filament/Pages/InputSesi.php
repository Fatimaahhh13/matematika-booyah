<?php

namespace App\Filament\Pages;

use App\Models\TeachingSession;
use BackedEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class InputSesi extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-m-pencil-square';
    protected static ?string $navigationLabel = 'Input Sesi';
    protected static ?string $title = 'Input Sesi';
    protected string $view = 'filament.pages.input-sesi';

    public ?array $data = [];
    public ?int $student_id = null; 

    // Mengisi otomatis data modul dan status sebelumnya berdasarkan riwayat terakhir siswa
    public function updatedStudentId(mixed $value): void
    {
        if (!empty($value)) {
            $lastSession = TeachingSession::where('student_id', $value)
                ->with('module')
                ->latest('session_date')
                ->latest('id')
                ->first();

            if ($lastSession) {
                $this->form->fill([
                    'previous_module' => $lastSession->module?->title ?? '-',
                    'previous_status' => ucfirst($lastSession->status ?? '-'),
                ], false);
            } else {
                $this->form->fill([
                    'previous_module' => 'Belum ada riwayat',
                    'previous_status' => '-',
                ], false);
            }
        } else {
            $this->form->fill([
                'previous_module' => null,
                'previous_status' => null,
            ], false);
        }
    }

    public function getMaxContentWidth(): string
    {
        return 'full';
    }

    public static function canAccess(): bool
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        return $user?->hasRole('tutor') ?? false;
    }

    public static function shouldRegisterNavigation(): bool
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        return $user?->hasRole('tutor') ?? false;
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $form): Schema
    {
        $containerStyle = ['style' => 'border: 1.5px solid #fde68a !important; border-radius: 0.75rem !important; background-color: #ffffff !important; overflow: hidden;'];
        $innerInputStyle = ['style' => 'border: none !important; background-color: transparent !important; box-shadow: none !important;'];

        $moduleOptions = function () {
            $levels = ['Level A', 'Level B', 'Level C'];
            $groupedOptions = [];

            foreach ($levels as $level) {
                $modules = \App\Models\Module::where('grade', $level)->pluck('title', 'id');
                if ($modules->isNotEmpty()) {
                    $groupedOptions[$level] = $modules->toArray();
                }
            }

            return empty($groupedOptions) ? ['Level A' => [], 'Level B' => [], 'Level C' => []] : $groupedOptions;
        };

        return $form
            ->schema([
                DatePicker::make('date')
                    ->label('Tanggal')
                    ->required()
                    ->native(false)
                    ->prefixIcon('heroicon-m-calendar')
                    ->extraAttributes($containerStyle)
                    ->extraInputAttributes($innerInputStyle)
                    ->columnSpanFull(),

                // Diubah ke TextInput agar panah dropdown hilang
                TextInput::make('previous_module')
                    ->label('Modul Sebelumnya')
                    ->disabled()
                    ->dehydrated(false) // Tidak perlu dikirim ke database saat submit karena ini info baca-saja
                    ->prefixIcon('heroicon-m-clock')
                    ->extraAttributes($containerStyle)
                    ->extraInputAttributes($innerInputStyle),

                // Diubah ke TextInput agar panah dropdown hilang
                TextInput::make('previous_status')
                    ->label('Status Sebelumnya')
                    ->disabled()
                    ->dehydrated(false)
                    ->prefixIcon('heroicon-m-shield-check')
                    ->extraAttributes($containerStyle)
                    ->extraInputAttributes($innerInputStyle),

                Select::make('current_module')
                    ->label('Modul Saat Ini')
                    ->placeholder('Pilih modul.....')
                    ->options($moduleOptions)
                    ->required()
                    ->prefixIcon('heroicon-m-book-open')
                    ->extraAttributes($containerStyle)
                    ->extraInputAttributes($innerInputStyle),

                Select::make('status')
                    ->label('Status Sesi Saat Ini')
                    ->options([
                        'selesai' => 'Selesai',
                        'belum selesai' => 'Belum Selesai',
                    ])
                    ->required()
                    ->prefixIcon('heroicon-m-check-badge')
                    ->extraAttributes($containerStyle)
                    ->extraInputAttributes($innerInputStyle),

                Textarea::make('notes')
                    ->label('Catatan')
                    ->rows(4)
                    ->columnSpanFull()
                    ->extraAttributes(['style' => 'border: 1.5px solid #fde68a !important; border-radius: 0.75rem !important; background-color: #ffffff !important; padding: 0.5rem;'])
                    ->extraInputAttributes(['style' => 'border: none !important; background-color: transparent !important; box-shadow: none !important;']),
            ])
            ->columns(2)
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        if (empty($this->student_id)) {
            Notification::make()
                ->title('Gagal')
                ->body('Silakan pilih siswa terlebih dahulu.')
                ->danger()
                ->send();
            return;
        }

        $tutor = \App\Models\Tutor::where('user_id', Auth::id())->first();

        TeachingSession::create([
            'tutor_id' => $tutor ? $tutor->id : Auth::id(),
            'session_date' => $data['date'],
            'student_id' => $this->student_id,
            'module_id' => $data['current_module'],
            'status' => $data['status'],
            'notes' => $data['notes'] ?? null,
        ]);

        Notification::make()
            ->title('Sesi berhasil disimpan')
            ->success()
            ->send();

        $this->form->fill();
        $this->student_id = null;
    }
}