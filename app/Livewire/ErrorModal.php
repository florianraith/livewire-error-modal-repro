<?php

namespace App\Livewire;

use Livewire\Component;

class ErrorModal extends Component
{
    public function fail(int $attempt): void
    {
        abort(response("<h1 style=\"color: white; font-family: sans-serif\">Failure {$attempt}</h1>", 500));
    }

    public function render(): string
    {
        return <<<'HTML'
        <div>
            <p>
                Click the button. The first request fails and opens the error modal.
                One second later a second request fails while the modal is still open,
                like a <code>wire:poll</code> on a stale page.
            </p>

            <button type="button" x-on:click="$wire.fail(1).catch(() => {}); setTimeout(() => $wire.fail(2).catch(() => {}), 1000)">
                Fail twice
            </button>

            <div style="position: relative; margin-top: 1rem; height: 60vh; background: tomato; color: white; padding: 1rem">
                Positioned page content. It must stay below the error modal.
            </div>
        </div>
        HTML;
    }
}
