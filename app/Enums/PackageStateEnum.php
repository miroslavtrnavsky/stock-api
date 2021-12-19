<?php

namespace App\Enums;

enum PackageStateEnum: string
{
    case NEW = 'new';
    case STORED = 'stored';
    case WAITING_FOR_DELIVERY = 'waiting-for-delivery';
    case WAITING_FOR_PICK_UP = 'waiting-for-pick-up';
}