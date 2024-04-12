<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Courses\src\Models\Course;
use Modules\Students\src\Models\Student;

class CheckUserOnline implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return ['user-online'];
    }


    public function broadcastAs()
    {
        return 'notification-user-online';
    }

}
