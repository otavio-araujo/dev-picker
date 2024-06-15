<?php

namespace App\Enums;

enum Languages: string
{
    case PHP = '+language:php';
    case LARAVEL = '+language:laravel';
    case LIVEWIRE = '+language:livewire';
    case ALPINEJS = '+language:alpinejs';
    case TAILWIND = '+language:tailwind+language:tailwindcss';
    case VUEJS = '+language:vuejs';
    case CSS = '+language:css';
    case JAVASCRIPT = '+language:javascript+language:js';
    case HTML = '+language:html';


    /**
     * Get all enum cases as an array of values.
     *
     * @return array
     */
    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get all enum cases as an array of keys.
     *
     * @return array
     */
    public static function getKeys(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * Get all enum cases as an array of key-value pairs.
     *
     * @return array
     */
    public static function getKeyValuePairs(): array
    {
        return array_combine(array_column(self::cases(), 'name'), array_column(self::cases(), 'value'));
    }
}
