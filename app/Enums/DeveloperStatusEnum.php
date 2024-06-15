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
}
