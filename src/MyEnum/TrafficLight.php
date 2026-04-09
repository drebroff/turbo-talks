<?php

namespace App\MyEnum;
enum TrafficLight
{
    case Red;
    case Yellow;
    case Green;

    public function getAction(): string
    {
        return match ($this) {
            self::Red => 'Stop',
            self::Yellow => 'Slow down',
            self::Green => 'Go',
        };
    }
}

//$light = TrafficLight::Red;
//echo $light->getAction(); // Outputs: Stop