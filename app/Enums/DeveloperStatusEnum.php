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

    public function statusColor(): string
    {
        return match ($this) {
            self::SELECTED => 'bg-yellow-100 text-yellow-800',
            self::CONTACTED => 'bg-cyan-100 text-cyan-800',
            self::INTERVIEWING => 'bg-fuchsia-100 text-fuchsia-800',
            self::OFFERED => 'bg-rose-100 text-rose-800',
            self::HIRED => 'bg-green-100 text-green-800',
            self::REJECTED => 'bg-orange-100 text-orange-800',
            self::FIRED => 'bg-red-100 text-red-800',
        };
    }
}
