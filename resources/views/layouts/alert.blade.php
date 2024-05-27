<div class="container mt-3">
    @if (session('error'))
        <div class="alert alert-danger shadow">
            {{ session('error') }}
        </div>
    @else
        @if (session('success'))
            <div class="alert alert-success shadow">
                {{ session('success') }}
            </div>
        @endif
    @endif
</div>
@if (session('validation'))
    @foreach (array_reverse(json_decode(session('validation'), true)) as $error)
        <div class=" position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast toast-danger show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    @foreach ($error as $item)
                        <label class="me-auto">{{ $item }}</label>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endforeach
@endif