<?php

namespace App\Http\Livewire;

use App\Models\streamTargetSchedule;
use Livewire\Component;

class ScheduleStreamTarget extends Component
{
    public $stream;
    public $app;
    public $start_time;
    public $end_time;

    public function mount($app, $stream)
    {
        $this->stream = $stream;
        $this->app = $app;
    }

    public $show_schedule_form=false;

    public function toggle_form()
    {
        $this->show_schedule_form = !$this->show_schedule_form;
    }

    public function schedule_stream_target()
    {
        $this->validate([
            'stream' => "required",
            'start_time' => "required",
            'end_time' => "required",
        ]);
        streamTargetSchedule::create([
            'stream' => $this->stream,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'status' => "waiting",
        ]);
        $this->start_time='';
        $this->end_time='';
        $this->toggle_form();
        return session()->flash("successmessage",'Schedule added successfully!.');
    }
    public function render()
    {
        // dd("schedule stream target");
        return view('livewire.schedule-stream-target',[
            'schedule' => streamTargetSchedule::where('stream' ,$this->stream)->latest()->first()
        ])->layout('layouts.livewire');
    }
}
