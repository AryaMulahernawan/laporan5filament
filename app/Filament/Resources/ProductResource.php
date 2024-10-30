<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_produk')
                    ->required()
                    ->label('Nama Produk'),
                
                Forms\Components\Select::make('kategori_id')
                    ->relationship('category', 'nama_kategori')
                    ->required()
                    ->label('Kategori'),
                
                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi Produk')
                    ->rows(3)
                    ->nullable(),
                
                Forms\Components\TextInput::make('harga')
                    ->numeric()
                    ->required()
                    ->label('Harga'),
                
                Forms\Components\TextInput::make('stok')
                    ->numeric()
                    ->required()
                    ->label('Stok'),
                
                Forms\Components\Select::make('tipe_produk')
                    ->options([
                        'digital' => 'Digital',
                        'fisik' => 'Fisik',
                    ])
                    ->required()
                    ->label('Tipe Produk'),
                
                Forms\Components\Toggle::make('status')
                    ->label('Status Aktif')
                    ->default(true), // Default aktif
                 
                // Menggunakan FileUpload untuk foto
                Forms\Components\FileUpload::make('foto_produk')
                    ->label('Foto Produk')
                    ->image() // Menunjukkan bahwa ini adalah gambar
                    ->directory('uploads/produk')
                    ->maxSize(1024) // Batas ukuran 1 MB
                    ->required(), // Menjadikan kolom ini wajib

                // Menggunakan FileUpload untuk dokumen
                Forms\Components\FileUpload::make('file_produk')
                    ->label('Dokumen Produk')
                    ->directory('uploads/dokumen_produk')
                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.ms-powerpoint'])
                    ->maxSize(2048) // Batas ukuran 2 MB
                    ->required(), // Menjadikan kolom ini wajib
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_produk')->label('Nama Produk')->searchable(),
                Tables\Columns\TextColumn::make('category.nama_kategori')->label('Kategori'),
                Tables\Columns\TextColumn::make('harga')->label('Harga')->money('IDR'),
                Tables\Columns\TextColumn::make('stok')->label('Stok'),
                Tables\Columns\TextColumn::make('tipe_produk')->label('Tipe Produk'),
                BooleanColumn::make('status')->label('Status Aktif'),
                ImageColumn::make('foto_produk')->label('Foto Produk')->size(50), // Menampilkan gambar dengan ukuran
            ])
            ->filters([/* Tambahkan filter di sini jika perlu */]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}