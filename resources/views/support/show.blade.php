@extends('layouts.app')
@section('title', 'Support and Help - ' . $support->subject)

@section('content')
    <script src="https://cdn.tiny.cloud/1/c8irtbmev6k4bshau3nhc79i52h8dsshesj9n5mt33zoiegr/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: 'textarea#editor',
            menubar: false,
            height: 300,
            width: '100%',
        });
    </script>
    <div class="container mt-3">
        <div class="card">
            <h5 class="card-header">Destek Talebi Detayı - <b>#{{ $support->id }}</b></h5>
            <hr>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 mb-4">
                        <div class="card text-white border border-2">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col text-start">
                                        <h5 class="card-title text-dark">{{ ucfirst($support->user->name) }} <span
                                                class="badge bg-label-dark">Üye</span></h5>
                                    </div>
                                    <div class="col text-end">
                                        <h5 class="card-title text-end text-dark">
                                            {{ $support->created_at->format('d.m.Y H:i') }} </h5>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body text-dark">
                                    {!! $support->message !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border">
                            <div class="card-header">
                                <h5 class="card-title text-center bg-primary text-white p-3">Destek Talebi Bilgileri</h5>
                                <hr>
                                <div class="card-body">
                                    <p><strong>Ticket ID:</strong> #{{ $support->id }}</p>
                                    <p><strong>Konu:</strong> {{ ucfirst($support->subject) }}</p>
                                    <p><strong>Durum:</strong>
                                        @if ($support->status == 'replied')
                                            <span class="badge bg-success">Yanıtlandı</span>
                                        @elseif($support->status == 'closed')
                                            <span class="badge bg-secondary">Kapatıldı</span>
                                        @else
                                            <span class="badge bg-warning">Beklemede</span>
                                        @endif
                                    </p>
                                    <p><strong>Oluşturma Tarihi:</strong> {{ $support->created_at->format('d.m.Y H:i') }}
                                    <p><strong>Son Güncellenme Tarihi:</strong>
                                        {{ $support->updated_at ? $support->updated_at->format('d.m.Y H:i') : '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 mb-4">
                        <div class="card bg-admin text-white border border-2">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col text-start">
                                        <h5 class="card-title text-dark">Otomatik Yanıt <span
                                                class="badge bg-label-info">Bot</span></h5>
                                    </div>
                                    <div class="col text-end">
                                        <h5 class="card-title text-end text-dark">
                                            {{ $support->created_at->format('d.m.Y H:i') }} </h5>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <p>
                                        Destek talebiniz alınmıştır. En kısa sürede size geri dönüş yapılacaktır. Bu süreçte
                                        lütfen beklemeye devam ediniz.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($support->messages as $message)
                        <div class="col-md-8 mb-4">
                            <div class="card border">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col text-start">
                                            <h5 class="card-title">
                                                @if ($message->replied_user_id)
                                                    {{ ucfirst($message->user->name) }}
                                                    <span class="badge bg-label-info">Yetkili</span>
                                                @else
                                                    {{ ucfirst($message->user->name) }}
                                                    <span class="badge bg-label-dark">ÜYE</span>
                                                @endif
                                            </h5>
                                        </div>
                                        <div class="col text-end">
                                            <h5 class="card-title text-end">
                                                {{ $message->created_at->format('d.m.Y H:i') }}
                                            </h5>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <p>
                                            {!! $message->message !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if ($support->status != 'closed')
                        @if ($support->status == 'replied' || auth()->user()->role == 'admin')
                            <form action="{{ route('support.reply', ['id' => $support->id]) }}" method="POST"
                                class="col-md-8  p-3 card border mt-5">
                                @csrf
                                <input type="hidden" value="{{ $support->id }}" name="parent_id">
                                <input type="hidden" value="{{ auth()->id() }}" name="replied_user_id">
                                <div class="mb-3">
                                    <label for="message" class="form-label fw-bold">Mesaj</label>
                                    <textarea id="editor" name="reply_message"></textarea>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success">Yanıtla</button>
                                </div>
                            </form>
                        @endif
                    @else
                        <div class="col-md-8 mt-5">
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Destek Talebi Kapatıldı!</h4>
                                <p>
                                    Bu destek talebi kapatılmıştır. Eğer talebinizi tekrar açmak isterseniz, yeni bir destek
                                    talebi oluşturabilirsiniz.
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"
        integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@endsection
