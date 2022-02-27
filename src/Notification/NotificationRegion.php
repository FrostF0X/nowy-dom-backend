<?php

namespace App\Notification;

use Elao\Enum\AutoDiscoveredValuesTrait;
use Elao\Enum\ReadableEnum;

/**
 * @method static self TEST()
 */
class NotificationRegion extends ReadableEnum
{
    use AutoDiscoveredValuesTrait;

    public const VINNYTSA = 'VINNYTSA';
    public const VOLYNSKA = 'VOLYNSKA';
    public const DNIPROPETROVSKAYA = 'DNIPROPETROVSKAYA';
    public const DONETSKAYA = 'DONETSKAYA';
    public const JITOMIRSKAYA = 'JITOMIRSKAYA';
    public const ZAKARPATSKA = 'ZAKARPATSKA';
    public const ZAPORIZKA = 'ZAPORIZKA';
    public const IVANOFRANKIWSKA = 'IVANOFRANKIWSKA';
    public const KIYEWSKAYA = 'KIYEWSKAYA';
    public const KIROWOGRADSKA = 'KIROWOGRADSKA';
    public const LUGANSKA = 'LUGANSKA';
    public const LVIVKA = 'LVIVKA';
    public const MYKOLAYIV = 'MYKOLAYIV';
    public const ODESKA = 'ODESKA';
    public const POLTASKA = 'POLTASKA';
    public const RIVENSKA = 'RIVENSKA';
    public const SUMSKA = 'SUMSKA';
    public const TERNOPILSKA = 'TERNOPILSKA';
    public const HARKIVSKA = 'HARKIVSKA';
    public const HERSONSKA = 'HERSONSKA';
    public const HMELNYCKA = 'HMELNYCKA';
    public const CHERKASKA = 'CHERKASKA';
    public const CHERNIVETSKA = 'CHERNIVETSKA';
    public const CHERNIGIWSKA = 'CHERNIGIWSKA';
    public const KIYEW = 'KIYEW';
    public const KALUSH = 'KALUSH';
    public const TEST = 'TEST';

    public const MAP = [
        'VINNYTSA' => "Вінницька",
        'VOLYNSKA' => "Волинська",
        'DNIPROPETROVSKAYA' => "Дніпропетровська",
        'DONETSKAYA' => "Донецька",
        'JITOMIRSKAYA' => "Житомирська",
        'ZAKARPATSKA' => "Закарпатська",
        'ZAPORIZKA' => "Запорізька",
        'IVANOFRANKIWSKA' => "Івано-Франківська",
        'KIYEWSKAYA' => "Київська",
        'KIROWOGRADSKA' => "Кіровоградська",
        'LUGANSKA' => "Луганська",
        'LVIVKA' => "Львівська",
        'MYKOLAYIV' => "Миколаївська",
        'ODESKA' => "Одеська",
        'POLTASKA' => "Полтавська",
        'RIVENSKA' => "Рівненська",
        'SUMSKA' => "Сумська",
        'TERNOPILSKA' => "Тернопільська",
        'HARKIVSKA' => "Харківська",
        'HERSONSKA' => "Херсонська",
        'HMELNYCKA' => "Хмельницька",
        'CHERKASKA' => "Черкаська",
        'CHERNIVETSKA' => "Чернівецька",
        'CHERNIGIWSKA' => "Чернігівська",
        'KIYEW' => "Київ",
        'KALUSH' => "Калуш",
        'TEST' => 'Для Тестів'
    ];

    public static function readables(): array
    {
        return self::MAP;
    }

    public function __toString(): string
    {
        return self::MAP[$this->value];
    }
}
