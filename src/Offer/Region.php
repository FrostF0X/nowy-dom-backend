<?php

namespace App\Offer;

use Elao\Enum\AutoDiscoveredValuesTrait;
use Elao\Enum\Enum;

class Region extends Enum
{
    use AutoDiscoveredValuesTrait;

    public const LUBLIN = 'LUBLIN';
    public const GDANSK = 'GDANSK';
    public const OLSZTYN = 'OLSZTYN';
    public const BIALYSTOK = 'BIALYSTOK';
    public const SZCZECIN = 'SZCZECIN';
    public const BYDGOSZCZ = 'BYDGOSZCZ';
    public const WARSZAWA = 'WARSZAWA';
    public const POZNAN = 'POZNAN';
    public const ZIELONA_GORA = 'ZIELONA_GORA';
    public const WROCLAW = 'WROCLAW';
    public const OPOLE = 'OPOLE';
    public const KATOWICE = 'KATOWICE';
    public const KIELCE = 'KIELCE';
    public const KRAKOW = 'KRAKOW';
}
