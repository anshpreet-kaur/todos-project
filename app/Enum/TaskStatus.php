<?php
namespace App\Enums;

class TaskStatus
{
    public const PENDING = 'Pending';
    public const IN_PROGRESS = 'In Progress';
    public const COMPLETED = 'Completed';

    public static function values(): array
    {
        return [
            self::PENDING,
            self::IN_PROGRESS,
            self::COMPLETED,
        ];
    }
}
