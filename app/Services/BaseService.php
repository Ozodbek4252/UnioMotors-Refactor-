<?php

namespace App\Services;

use App\Traits\DestroyTrait;
use App\Traits\FileTrait;
use App\Traits\StoreTrait;
use App\Traits\UpdateTrait;

class BaseService
{
    use StoreTrait, UpdateTrait, DestroyTrait;
    use FileTrait;
}
