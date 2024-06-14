<?php

namespace App\Enums;

enum DeveloperRatingEnum: int
{
    case UNRANKED = 0;
    case ONE_STAR = 1;
    case TWO_STARS = 2;
    case THREE_STARS = 3;
    case FOUR_STARS = 4;
    case FIVE_STARS = 5;

    public function label(): string
    {
        return match ($this) {
            self::UNRANKED => 'Não classificado',
            self::ONE_STAR => '1 Estrela',
            self::TWO_STARS => '2 Estrelas',
            self::THREE_STARS => '3 Estrelas',
            self::FOUR_STARS => '4 Estrelas',
            self::FIVE_STARS => '5 Estrelas',
        };
    }
}
