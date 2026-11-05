<?php



namespace App\Filament\Pages;



use App\Models\Student;

use App\Models\TeachingSession;

use BackedEnum;

use Filament\Forms\Components\DatePicker;

use Filament\Forms\Components\Select;

use Filament\Forms\Components\Textarea;

use Filament\Forms\Components\TimePicker;

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



    // Mengatur agar halaman memenuhi seluruh lebar layar secara responsif

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

        // Styling container luar dan input dengan border emas yang elegan

        $containerStyle = ['style' => 'border: 1.5px solid #fde68a !important; border-radius: 0.75rem !important; background-color: #ffffff !important; overflow: hidden;'];

        $innerInputStyle = ['style' => 'border: none !important; background-color: transparent !important; box-shadow: none !important;'];



        return $form

            ->schema([

                // 1. Tanggal

                DatePicker::make('date')

                    ->label('Tanggal')

                    ->required()

                    ->native(false)

                    ->prefixIcon('heroicon-m-calendar')

                    ->extraAttributes($containerStyle)

                    ->extraInputAttributes($innerInputStyle),



                // 2. Jam (Interaktif & tanpa ikon ganda di kanan)

                TimePicker::make('time')

                    ->label('Jam')

                    ->required()

                    ->native(false)

                    ->prefixIcon('heroicon-m-clock')

                    ->suffixIcon(null)

                    ->extraAttributes($containerStyle)

                    ->extraInputAttributes($innerInputStyle),



                // 3. Siswa (Full Width - Difilter berdasarkan cabang user yang login)
                Select::make('student_id')
                    ->label('Siswa')
                    ->placeholder('Pilih siswa.....')
                    ->options(function () {
                        /** @var \App\Models\User|null $user */
                        $user = Auth::user();

                        $query = Student::query();

                        // Jika bukan super_admin, batasi hanya siswa di cabang yang sama
                        if ($user && ! $user->hasRole('super_admin')) {
                            $query->where('branch_id', $user->branch_id);
                        }

                        return $query->pluck('name', 'id');
                    })
                    ->required()
                    ->columnSpanFull()
                    ->prefixIcon('heroicon-m-user-group')
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $student = Student::find($state);
                        if ($student) {
                            $set('current_module', $student->module ?? '-');
                        }
                    })
                    ->extraAttributes($containerStyle)
                    ->extraInputAttributes($innerInputStyle),



                // 4. Modul Saat Ini (Dikelompokkan dinamis berdasarkan kolom 'grade' dari database)

                Select::make('current_module')

                    ->label('Modul saat ini')

                    ->placeholder('Pilih modul.....')

                    ->options(function () {

                        $levels = ['Level A', 'Level B', 'Level C'];

                        $groupedOptions = [];



                        foreach ($levels as $level) {

                            $modules = \App\Models\Module::where('grade', $level)->pluck('title', 'id');

                           

                            if ($modules->isNotEmpty()) {

                                $groupedOptions[$level] = $modules->toArray();

                            }

                        }



                        if (empty($groupedOptions)) {

                            return [

                                'Level A' => [],

                                'Level B' => [],

                                'Level C' => [],

                            ];

                        }



                        return $groupedOptions;

                    })

                    ->required()

                    ->prefixIcon('heroicon-m-book-open')

                    ->extraAttributes($containerStyle)

                    ->extraInputAttributes($innerInputStyle),



                // 5. Status Sesi

                Select::make('status')

                    ->label('Status')

                    ->options([

                        'selesai' => 'Selesai',

                        'belum selesai' => 'Belum Selesai',

                    ])

                    ->required()

                    ->prefixIcon('heroicon-m-check-badge')

                    ->extraAttributes($containerStyle)

                    ->extraInputAttributes($innerInputStyle),



                // 6. Catatan (Full Width)

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



        // Mengambil data tutor yang terhubung dengan user yang sedang login

        $tutor = \App\Models\Tutor::where('user_id', Auth::id())->first();



        // Menyimpan data ke database

        TeachingSession::create([

            'tutor_id' => $tutor ? $tutor->id : Auth::id(),

            'session_date' => $data['date'],

            'session_time' => $data['time'],

            'student_id' => $data['student_id'],

            'module_id' => $data['current_module'],

            'status' => $data['status'],

            'notes' => $data['notes'] ?? null,

        ]);



        Notification::make()

            ->title('Sesi berhasil disimpan')

            ->success()

            ->send();



        // Memperbarui reset form menggunakan fill()

        $this->form->fill();

    }

} 