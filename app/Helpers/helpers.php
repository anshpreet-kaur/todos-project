<?php
if (!function_exists('format_task_deadline')) {
function format_task_deadline($date)
{
    return \Carbon\Carbon::parse($date)->format('M d, Y');
}
}
if (!function_exists('task_status_badge')) {
    function task_status_badge($status)
    {
        $badge = [
            'Pending' => 'warning',
            'In Progress' => 'primary',
            'Completed' => 'success'
        ];

        return $badge[$status] ?? 'secondary';
    }
}