@extends('layouts.app')

@section('title', 'Sıkça Sorulan Sorular')
@section('content')
    @include('layouts.alert')
    <div class="container">
        <!-- Accordion -->
        <h5 class="mt-4">Sıkça Sorulan Sorular</h5>
        @admin
            <div class="d-flex justify-content-end">
                <button data-bs-toggle="modal" data-bs-target="#createModal" class="btn btn-primary">Yeni Soru Ekle +</button>
            </div>
        @endadmin
        <div class="row">
            <div class="col-md mb-4 mb-md-0">
                <div class="accordion mt-3" id="accordionExample">
                    @foreach ($faqs as $key => $faq)
                        <div class="card accordion-item @if ($key == 0) active @endif">
                            <h2 class="accordion-header" id="{{ $key }}">
                                <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                    data-bs-target="#accordion{{ $key }}" aria-expanded="true"
                                    aria-controls="accordion{{ $key }}">
                                    {{ ucfirst($faq->question) }}
                                </button>
                            </h2>
                            <div id="accordion{{ $key }}"
                                class="accordion-collapse collapse @if ($key == 0) show @endif"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {!! ucfirst($faq->answer) !!}
                                </div>
                            </div>
                        </div>
                        @admin
                            <div class="mb-3">
                                @if ($key != 0)
                                    <a href="{{ route('faq.up', ['id' => $faq->id]) }}" class="btn btn-secondary btn-sm">Yukarı
                                        Taşı</a>
                                @endif
                                <a href="{{ route('faq.down', ['id' => $faq->id]) }}" class="btn btn-primary btn-sm">Aşağı
                                    Taşı</a>
                                <a href="{{ route('faq.destroy', ['id' => $faq->id]) }}" class="btn btn-danger btn-sm">Sil</a>
                                @if ($faq->status == 1)
                                    <a href="{{ route('faq.status', ['id' => $faq->id]) }}"
                                        class="btn btn-warning btn-sm">Pasif</a>
                                @else
                                    <a href="{{ route('faq.status', ['id' => $faq->id]) }}"
                                        class="btn btn-success btn-sm">Aktif</a>
                                @endif
                            </div>
                        @endadmin
                    @endforeach
                </div>
            </div>
        </div>
        <!--/ Accordion -->
    </div>
    @admin
        @include('faq.modals.create')
    @endadmin
@endsection
