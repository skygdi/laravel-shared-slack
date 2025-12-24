@extends('slack::layouts.app')

@section('title', 'Dashboard')
@section('header_title', '📊 Dashboard')
@section('header_subtitle', 'Quick controls for your system.')

@section('content')
<div class="container mt-4">
    <div class="row">
        
        {{-- Slack toggle card --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Slack Notifications</span>
                    <span class="badge {{ $slackSuspended ? 'bg-danger' : 'bg-success' }}" id="slack-status-badge">
                        {{ $slackSuspended ? 'Suspended' : 'Active' }}
                    </span>
                </div>
                <div class="card-body">
                    <p class="mb-2 text-muted">
                        Toggle this to temporarily pause all outgoing Slack messages from the system.
                    </p>

                    <div class="form-check form-switch">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            role="switch"
                            id="slack-suspended-toggle"
                            {{ $slackSuspended ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="slack-suspended-toggle">
                            Suspend Slack notifications
                        </label>
                    </div>

                    <small class="text-muted d-block mt-2" id="slack-status-text">
                        {{ $slackSuspended
                            ? 'Slack is currently suspended. No messages will be sent.'
                            : 'Slack is active. Messages will be sent as normal.' }}
                    </small>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // --- Slack toggle ---
    const slackToggle   = document.getElementById('slack-suspended-toggle');
    const slackBadge    = document.getElementById('slack-status-badge');
    const slackStatusEl = document.getElementById('slack-status-text');

    if (slackToggle) {
        slackToggle.addEventListener('change', function () {
            const suspended = slackToggle.checked ? 1 : 0;

            fetch("{{ route('slack_dashboard.slack-toggle') }}", {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({ suspended })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network error');
                }
                return response.json();
            })
            .then(data => {
                if (suspended) {
                    slackBadge.classList.remove('bg-success');
                    slackBadge.classList.add('bg-danger');
                    slackBadge.textContent = 'Suspended';
                    slackStatusEl.textContent = 'Slack is currently suspended. No messages will be sent.';
                } else {
                    slackBadge.classList.remove('bg-danger');
                    slackBadge.classList.add('bg-success');
                    slackBadge.textContent = 'Active';
                    slackStatusEl.textContent = 'Slack is active. Messages will be sent as normal.';
                }
            })
            .catch(err => {
                slackToggle.checked = !slackToggle.checked;
                alert('Failed to update Slack status. Please try again.');
                console.error(err);
            });
        });
    }

});
</script>
@endpush
