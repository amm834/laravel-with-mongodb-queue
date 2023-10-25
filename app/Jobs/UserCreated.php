<?php

namespace App\Jobs;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Mockery\Exception;

class UserCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;



    public $tries = 25;
    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $name,
    )
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $student = Student::create([
                'name' => $this->name,
            ]);
            echo "Student created with id: {$student->id}";
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
