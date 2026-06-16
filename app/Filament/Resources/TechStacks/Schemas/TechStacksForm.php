<?php

namespace App\Filament\Resources\TechStacks\Schemas;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class TechStacksForm
{
    protected static function fetchFaIcons(): array
    {
        return Cache::remember('fa_icons', 60 * 60 * 24, function () {
            $token = fa_access_token();
            if (! $token) {
                return [];
            }

            $resp = Http::withToken($token)
                ->post('https://api.fontawesome.com/graphql', [
                    'query' => '{
                        release(version: "6.x") {
                            icons(license: "free") {
                                id
                                label
                                styles
                            }
                        }
                    }'
                ]);

            $json = $resp->json();
            if (! isset($json['data']['release']['icons'])) {
                \Log::error('FA icons error', $json ?? []);
                return [];
            }

            return $json['data']['release']['icons'];
        });
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255),
                        Select::make('icon')
                            ->label('Icon')
                            ->searchable()
                            ->searchDebounce(300)
                            ->loadingMessage('Mencari icon...')
                            ->noSearchResultsMessage('Tidak ditemukan icon yang cocok.')
                            ->allowHtml()
                            ->getSearchResultsUsing(function (string $search) {
                                $allowedStyles = ['solid', 'brands', 'regular'];

                                return collect(self::fetchFaIcons())
                                    ->filter(fn ($icon) =>
                                        isset($icon['styles']) &&
                                        collect($icon['styles'])->intersect($allowedStyles)->isNotEmpty() &&
                                        (
                                            str_contains($icon['id'], $search) ||
                                            str_contains($icon['label'], $search)
                                        )
                                    )
                                    ->mapWithKeys(function ($icon) {
                                        $styles = $icon['styles'] ?? [];

                                        $style = 'solid';

                                        if (in_array('brands', $styles)) {
                                            $style = 'brands';
                                        } elseif (in_array('solid', $styles)) {
                                            $style = 'solid';
                                        } elseif (in_array('regular', $styles)) {
                                            $style = 'regular';
                                        }

                                        return [
                                            "fa-{$style} fa-{$icon['id']}" => "
                                                <div style='display:flex;align-items:center;gap:8px'>
                                                    <i class='fa-{$style} fa-{$icon['id']}'></i>
                                                    {$icon['label']}
                                                </div>
                                            "
                                        ];
                                    })
                                    ->take(50) // 🔥 penting biar tidak berat
                                    ->toArray();
                            })
                            ->getOptionLabelUsing(function ($value) {
                                if (! $value) {
                                    return null;
                                }

                                $parts = explode(' ', $value, 2);

                                if (count($parts) !== 2) {
                                    return $value;
                                }

                                [$styleClass, $iconClass] = $parts;

                                $label = str_replace('fa-', '', $iconClass);

                                return "
                                    <div style='display:flex;align-items:center;gap:8px'>
                                        <i class='{$styleClass} {$iconClass}'></i>
                                        {$label}
                                    </div>
                                ";
                            })
                ]),
            ]);
    }
}
