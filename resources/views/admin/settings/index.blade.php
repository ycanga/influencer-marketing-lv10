@extends('layouts.app')

@section('title', 'Genel Ayarlar')

@section('content')
    @include('layouts.alert')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <h3>Genel Ayarlar</h3>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="site_title">Site Başlığı</label>
                                <input type="text" name="site_title" id="site_title" class="form-control"
                                    value="{{ $settings->site_title ?? '' }}" placeholder="Site başlığını giriniz...">
                            </div>
                            <div class="form-group mt-3">
                                <label for="site_description">Site Açıklaması</label>
                                <div id="defaultFormControlHelp" class="form-text">
                                    <b class="text-danger">**</b>
                                    Site açıklaması, arama motorlarında sitenizin tanıtımı için kullanılır.
                                </div>
                                <textarea name="site_description" id="site_description" class="form-control" rows="5"
                                    placeholder="Site açıklamasını giriniz...">{{ $settings->site_description ?? '' }}</textarea>
                            </div>
                            <div class="form-group mt-3">
                                <label for="site_keywords">Anahtar Kelimeler</label>
                                <div id="defaultFormControlHelp" class="form-text">
                                    <b class="text-danger">**</b>
                                    Anahtar kelimeler, arama motorlarında sitenizin tanıtımı için kullanılır.
                                </div>
                                <input type="text" name="site_keywords" id="site_keywords" class="form-control"
                                    value="{{ $settings->site_keywords ?? '' }}"
                                    placeholder="Anahtar kelimeleri giriniz...">
                            </div>
                            <div class="form-group mt-3">
                                <label for="site_keywords">Minimum Bakiye Tutarı (₺)</label>
                                <div id="defaultFormControlHelp" class="form-text">
                                    <b class="text-danger">**</b>
                                    Minimum bakiye tutarı, kullanıcıların site üzerinden para yatırırken en az ne kadar
                                    yatırabileceğini belirler.
                                </div>
                                <input type="text" name="site_min_balance" id="site_min_balance" class="form-control"
                                    value="{{ $settings->site_min_balance ?? '' }}"
                                    placeholder="Minimum bakiye tutarı giriniz...">
                            </div>
                            <div class="form-group mt-3">
                                <label for="site_logo">Site Logosu</label>
                                <div id="defaultFormControlHelp" class="form-text">
                                    <b class="text-danger">**</b>
                                    Site logosu, sitenizin üst kısmında yer alır.
                                </div>
                                <input type="file" name="site_logo" id="site_logo" class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <label for="site_favicon">Site Favicon</label>
                                <div id="defaultFormControlHelp" class="form-text">
                                    <b class="text-danger">**</b>
                                    Site faviconu, tarayıcınızın sekme kısmında yer alır.
                                </div>
                                <input type="file" name="site_favicon" id="site_favicon" class="form-control">
                            </div>
                            <div class="form-group mt-3 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h3>İyzico Ayarları</h3>
                        <form action="{{route('admin.settings.pos')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="ApiKey">API Anahtarı <b class="text-danger">*</b></label>
                                <input type="text" name="ApiKey" id="ApiKey" class="form-control"
                                    value="{{ $posSettings->ApiKey ?? '' }}" placeholder="API anahtarını giriniz...">
                            </div>
                            <div class="form-group mt-3">
                                <label for="SecretKey">Gizli Anahtar <b class="text-danger">*</b></label>
                                <input type="text" name="SecretKey" id="SecretKey" class="form-control"
                                    value="{{ $posSettings->SecretKey ?? '' }}" placeholder="Gizli anahtarını giriniz...">
                            </div>
                            <div class="form-group mt-3">
                                <label for="BaseUrl">Base URL <b class="text-danger">*</b></label>
                                <input type="text" name="BaseUrl" id="BaseUrl" class="form-control"
                                    value="{{ $posSettings->BaseUrl ?? '' }}" placeholder="Base URL'i giriniz...">
                            </div>
                            <div class="form-group mt-3">
                                <label for="status">Durum</label>
                            </div>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" id="status" name="status" @if($posSettings->status == 'active') checked @endif />
                                <label class="form-check-label" for="status"
                                  >Pasif / Aktif</label
                                >
                              </div>
                            <div class="form-group mt-3 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
