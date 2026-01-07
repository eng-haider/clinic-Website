<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    
    protected static ?string $navigationLabel = 'Settings';
    
    protected static ?string $navigationGroup = 'System';
    
    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->label('Setting Key'),
                    
                Forms\Components\Select::make('type')
                    ->required()
                    ->options([
                        'text' => 'Text',
                        'email' => 'Email',
                        'url' => 'URL',
                        'textarea' => 'Textarea',
                        'image' => 'Image',
                    ])
                    ->reactive()
                    ->label('Type'),
                    
                Forms\Components\TextInput::make('group')
                    ->required()
                    ->label('Group'),
                    
                Forms\Components\TextInput::make('value')
                    ->label('Value')
                    ->visible(fn ($get) => in_array($get('type'), ['text', 'email', 'url']))
                    ->maxLength(255),
                    
                Forms\Components\Textarea::make('value')
                    ->label('Value')
                    ->visible(fn ($get) => $get('type') === 'textarea')
                    ->rows(4)
                    ->columnSpanFull(),
                    
                Forms\Components\FileUpload::make('value')
                    ->label('Image')
                    ->visible(fn ($get) => $get('type') === 'image')
                    ->image()
                    ->directory('settings')
                    ->disk('public')
                    ->imageEditor()
                    ->helperText('Upload image files here. The image will be automatically accessible via URL.')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->searchable()
                    ->sortable()
                    ->label('Setting Key'),
                    
                Tables\Columns\TextColumn::make('value')
                    ->limit(50)
                    ->searchable()
                    ->label('Value')
                    ->formatStateUsing(function ($state, $record) {
                        if (!$record) return $state;
                        if ($record->type === 'image') {
                            return $state ? '🖼️ Image uploaded' : 'No image';
                        }
                        return $state;
                    }),
                    
                Tables\Columns\ImageColumn::make('value')
                    ->label('Preview')
                    ->disk('public')
                    ->size(50)
                    ->visible(fn ($record) => $record && $record->type === 'image'),
                    
                Tables\Columns\TextColumn::make('type')
                    ->searchable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'text' => 'primary',
                        'email' => 'success',
                        'url' => 'warning',
                        'textarea' => 'info',
                        'image' => 'danger',
                        default => 'gray',
                    })
                    ->label('Type'),
                    
                Tables\Columns\TextColumn::make('group')
                    ->searchable()
                    ->badge()
                    ->color('gray')
                    ->label('Group'),
                    
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Last Updated')
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'text' => 'Text',
                        'email' => 'Email',
                        'url' => 'URL',
                        'textarea' => 'Textarea',
                        'image' => 'Image',
                    ]),
                Tables\Filters\SelectFilter::make('group')
                    ->options([
                        'general' => 'General',
                        'contact' => 'Contact',
                        'hours' => 'Hours',
                        'social' => 'Social',
                        'about' => 'About',
                        'seo' => 'SEO',
                        'features' => 'Features',
                        'patient_lookup' => 'Patient Lookup',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
