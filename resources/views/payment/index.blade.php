@extends('layouts.app')

@section('title', 'Ödeme Bilgileri')

@section('content')
    <div class="container mt-3">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Banka Bilgileri</h5>
                <p class="container">
                    <b class="text-danger">*</b> ile işaretlenmiş alanlar zorunludur.
                </p>
                <div class="container">
                    @if (session('validation'))
                        @foreach (array_reverse(json_decode(session('validation'), true)) as $error)
                            <div class=" position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                                <div id="liveToast" class="toast toast-danger show" role="alert" aria-live="assertive"
                                    aria-atomic="true">
                                    <div class="toast-header">
                                        @foreach ($error as $item)
                                            <label class="me-auto">{{ $item }}</label>
                                        @endforeach
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    @if (session('success'))
                        <div class=" position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                            <div id="liveToast" class="toast toast-success show" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                    <label class="me-auto">{{ session('success') }}</label>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>


                <form action="{{ route('payment.store') }}" method="POST">
                    @csrf
                    <div class="card-body row align-items-center">
                        <div class="col-12 col-xl-6 mb-3 mb-xl-0">
                            <label for="bankName" class="form-label">BANKA ISMı <b class="text-danger">*</b> </label>
                            <input type="text" class="form-control" id="bankName" name="bank_name"
                                value="{{ $data->bank_name ?? '' }}" placeholder="Banka ismini giriniz..."
                                aria-describedby="formControlHelp1" />
                            <div id="formControlHelp1" class="form-text">
                                Bankanıza ait isim bilgisini giriniz.
                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <label for="accountNumber" class="form-label">Hesap Numarası ya da IBAN <b
                                    class="text-danger">*</b> </label>
                            <input type="text" class="form-control" id="accountNumber" name="account_number"
                                value="{{ $data->iban ?? '' }}" placeholder="Hesap numarasını giriniz..."
                                aria-describedby="formControlHelp2" />
                            <div id="formControlHelp2" class="form-text">
                                Banka hesap numaranızı ya da IBAN numaranızı giriniz.
                            </div>
                        </div>
                        <div class="col-12 col-xl-6 mb-3 mb-xl-0 mt-3">
                            <label for="accountUsername" class="form-label">Banka Hesap Sahibi Ismı <b
                                    class="text-danger">*</b> </label>
                            <input type="text" class="form-control" id="accountUsername" name="account_username"
                                value="{{ $data->account_username ?? '' }}"
                                placeholder="Banka Hesap Sahibinim ismini giriniz..." aria-describedby="formControlHelp1" />
                            <div id="formControlHelp1" class="form-text">
                                Banka hesap sahibinin ismini giriniz.
                            </div>
                        </div>
                        <div class="col-12 col-xl-6 mt-3">
                            <label for="desc" class="form-label">Açıklama</label>
                            <input type="text" class="form-control" id="desc" name="desc"
                                placeholder="Açıklama giriniz..." value="{{ $data->desc ?? '' }}"
                                aria-describedby="formControlHelp2" />
                            <div id="formControlHelp2" class="form-text">
                                Ödeme ile ilgili açıklama giriniz.
                            </div>
                        </div>
                        <div class="col-12 mt-3 d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">Kaydet</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
