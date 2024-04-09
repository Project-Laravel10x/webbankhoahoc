<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\News\src\Models\News;

class NewTeacherCreated implements ShouldBroadcast
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
    public $data;

    public function __construct(News $new, $data = [])
    {
        $this->name = $new->name;
        $this->teacher = $new->teachers->name;
        $this->created_at = $new->created_at;
        $this->id = $new->id;
        $this->slug = $new->slug;
        $this->data = $data;
        $this->thumbnail = $new->thumbnail;
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
                'data-notification' => $this->data,
            ]
        ];
    }

    public function notificationType()
    {
        return 'notification-new';
    }
}
