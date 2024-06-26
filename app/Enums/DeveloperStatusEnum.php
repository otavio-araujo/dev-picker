<?php

namespace App\Enums;

enum DeveloperStatusEnum: int
{
    case SELECTED = 1;
    case CONTACTED = 2;
    case INTERVIEWING = 3;
    case OFFERED = 4;
    case HIRED = 5;
    case REJECTED = 6;
    case FIRED = 7;

    public function label(): string
    {
        return match ($this) {
            self::SELECTED => 'Selecionado',
            self::CONTACTED => 'Contactado',
            self::INTERVIEWING => 'Em Entrevista',
            self::OFFERED => 'Oferecido',
            self::HIRED => 'Contratado',
            self::REJECTED => 'Rejeitado',
            self::FIRED => 'Demitido',
        };
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::SELECTED => 'bg-slate-100 text-slate-600',
            self::CONTACTED => 'bg-cyan-100 text-cyan-600',
            self::INTERVIEWING => 'bg-fuchsia-100 text-fuchsia-600',
            self::OFFERED => 'bg-indigo-100 text-indigo-600',
            self::HIRED => 'bg-green-100 text-green-600',
            self::REJECTED => 'bg-yellow-100 text-yellow-600',
            self::FIRED => 'bg-red-100 text-red-600',
        };
    }

    public function textColor(): string
    {
        return match ($this) {
            self::SELECTED => 'text-slate-600',
            self::CONTACTED => 'text-cyan-600',
            self::INTERVIEWING => 'text-fuchsia-600',
            self::OFFERED => 'text-indigo-600',
            self::HIRED => 'text-green-600',
            self::REJECTED => 'text-yellow-600',
            self::FIRED => 'text-red-600',
        };
    }
}
