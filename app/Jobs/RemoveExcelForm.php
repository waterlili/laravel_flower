<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class RemoveExcelForm extends Job implements ShouldQueue {
    use InteractsWithQueue, Queueable, SerializesModels;
  protected $name;

  /**
   * Create a new job instance.
   *
   * @param $name
   */
  public function __construct($name) {
    $this->name = $name;
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle() {
    Storage::disk('local')->delete('excel/export/' . $this->name);
  }
}
