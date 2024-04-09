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

class CourseCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $id;
    public $name;
    public $teacher;
    public $created_at;
    public $thumbnail;
    public $slug;

    public function __construct(Course $course)
    {
        $this->name = $course->name;
        $this->teacher = $course->teachers->name;
        $this->created_at = $course->created_at;
        $this->id = $course->id;
        $this->slug = $course->slug;
        $this->thumbnail = $course->thumbnail;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return ['my-channel'];
    }


    public function broadcastAs()
    {
        return 'notification';
    }

    public function broadcastWith()
    {
        return [
            'type' => $this->notificationType(),
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'teacher' => $this->teacher,
                'created_at' => $this->created_at,
                'slug' => $this->slug,
                'thumbnail' => $this->thumbnail,
            ]
        ];
    }

    public function notificationType()
    {
        return 'notification-course';
    }
}
