<?php

namespace App\Enums;

enum PostStatus: string
{
    case DRAFTED = 'drafted';
    case PUBLISHED = 'published';
}
