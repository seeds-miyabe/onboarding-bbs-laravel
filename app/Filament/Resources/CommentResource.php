<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Filament\Resources\CommentResource\RelationManagers;
use App\Models\Comment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationLabel = 'コメント';
    protected static ?string $modelLabel = 'コメント';
    protected static ?string $pluralModelLabel = 'コメント一覧';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('post_id')
                    ->relationship('post', 'title')
                    ->label('対象の投稿')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('コメント投稿者')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\Select::make('parent_id')
                    ->relationship('parent', 'body')
                    ->label('返信先コメント（親コメント）')
                    ->searchable()
                    ->nullable()
                    ->helperText('通常のコメントの場合は空欄のままで構いません。'),

                Forms\Components\Textarea::make('body')
                    ->label('コメント本文')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),

                Tables\Columns\TextColumn::make('post.title')
                    ->label('対象投稿')
                    ->limit(20)
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('投稿者')
                    ->searchable(),

                Tables\Columns\TextColumn::make('body')
                    ->label('コメント本文')
                    ->limit(30)
                    ->searchable(),

                Tables\Columns\TextColumn::make('parent.body')
                    ->label('返信先')
                    ->limit(15)
                    ->placeholder('-（親コメント）'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('作成日時')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}
