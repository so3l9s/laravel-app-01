<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static draft()
 * @method static static published()
 * @method static static archived()
 */
final class PostsState extends Enum
{
    const draft = 0;
    const published = 1;
    const archived = 2;
}
