<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <!-- Modal -->
        <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Bakiye Yükleyin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <hr>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center flex-wrap" id="icons-container">
                            @foreach ($paymentModels as $models)
                                <button class="card icon-card cursor-pointer text-center mb-4 mx-2 shadow"
                                    onclick="showDetail('{{ $models->key }}', '{{ $models->value }}')">
                                    <div class="card-body">
                                        {!! $models->icon_html ?? "<i class='bx bxs-bank'></i>" !!}
                                        <p class="icon-name text-capitalize text-truncate mb-0">{{ $models->name }}
                                        </p>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                        <hr>
                        <div class="modal-body" id="iban-form" style="display: none;">
                            <form action="{{ route('balance.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="amount">Yüklenecek Tutar (₺) <b class="text-danger">*</b></label>
                                            <input type="number" class="form-control" id="amount" name="amount"
                                                placeholder="Yüklenecek Tutarı giriniz...">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="iban">Gönderilecek IBAN</label>
                                            <div class="form-text mb-1">
                                                <b class="text-danger">*</b>
                                                Bakiye yüklemesi yapacağınız IBAN bilgisi bu alandadır.
                                            </div>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="iban"
                                                    aria-describedby="iban-copy" disabled>
                                                <button class="btn btn-outline-secondary" type="button"
                                                    id="iban-copy">Kopyala</button>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="desc">Açıklama Alanı</label>
                                            <div class="form-text mb-1">
                                                <b class="text-danger">*</b>
                                                Göndereceğiniz tutarın açıklama alanına aşağıda belirtilen ID numarasını
                                                yazınız.
                                            </div>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="desc"
                                                    aria-describedby="desc"
                                                    value="{{ ($lastId->id ?? auth()->id()) + 1 }}" disabled>
                                                <button class="btn btn-outline-secondary" type="button"
                                                    id="desc-copy">Kopyala</button>
                                            </div>
                                        </div>
                                        <input type="hidden" value="iban" name="payment_method">
                                        <div class="form-group mb-3 d-flex justify-content-center">
                                            <button class="btn btn-primary">Kaydet</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-body" id="iyzico-form" style="display: none;">
                            <form action="{{ route('balance.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="amount">Yüklenecek Tutar (₺) <b class="text-danger">*</b></label>
                                            <input type="number" class="form-control" id="amount" name="amount"
                                                placeholder="Yüklenecek Tutarı giriniz...">
                                        </div>
                                        <input type="hidden" value="credit-card" name="payment_method">
                                        <div class="form-group mb-3 d-flex justify-content-center">
                                            <button class="btn btn-primary">Kaydet</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="copyToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Bilgilendirme</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Açıklama kopyalandı.
        </div>
    </div>
</div>

<script>
    var iban_form = document.getElementById("iban-form");
    var iyzico_form = document.getElementById("iyzico-form");

    function showDetail(key, value) {
        console.log(key, value);
        if (key == "iban") {
            iyzico_form.style.display = "none";
            iban_form.style.display = "block";
            document.getElementById("iban").value = value;
        } else if(key == "iyzico") {
            iban_form.style.display = "none";
            iyzico_form.style.display = "block";
            document.getElementById("iyzico-form").style.display = "block";
        }
         else {
            iban_form.style.display = "none";
            iyzico_form.style.display = "none";
        }
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.getElementById('iban-copy').addEventListener('click', function() {
            // IBAN input elemanını seç
            var ibanInput = document.getElementById('iban');

            // IBAN değerini kopyala
            if (navigator.clipboard) {
                navigator.clipboard.writeText(ibanInput.value).then(function() {
                    alert('IBAN kopyalandı: ' + ibanInput.value);
                }).catch(function(err) {
                    console.error('Kopyalama işlemi başarısız oldu:', err);
                });
            } else {
                // Kopyalama işlemi için geçici bir textarea oluştur
                var tempInput = document.createElement('textarea');
                tempInput.value = ibanInput.value;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);
                alert('IBAN kopyalandı: ' + ibanInput.value);
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.getElementById('desc-copy').addEventListener('click', function() {
            // IBAN input elemanını seç
            var ibanInput = document.getElementById('desc');

            // IBAN değerini kopyala
            if (navigator.clipboard) {
                navigator.clipboard.writeText(ibanInput.value).then(function() {
                    alert('Açıklama kopyalandı: ' + ibanInput.value);
                }).catch(function(err) {
                    console.error('Kopyalama işlemi başarısız oldu:', err);
                });
            } else {
                // Kopyalama işlemi için geçici bir textarea oluştur
                var tempInput = document.createElement('textarea');
                tempInput.value = ibanInput.value;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);
                alert('Açıklama kopyalandı: ' + ibanInput.value);
            }
        });
    });
</script>
