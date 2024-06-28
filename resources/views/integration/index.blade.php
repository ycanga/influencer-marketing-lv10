@extends('layouts.app')

@section('Title', 'Entegrasyon Yönetimi')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-xl-12">
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                                Tıklama Entegrasyonu
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">
                                Satış ve Çoklu İşlem Entegrasyonu
                            </button>
                        </li>
                    </ul>
                    <style>
                        .card-body {
                            padding: 1rem;
                        }

                        .card pre {
                            text-align: left;
                            white-space: pre-wrap;
                            word-wrap: break-word;
                        }

                        .card {
                            height: auto;
                        }
                    </style>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                            <p>
                                Bu entegrasyon türü, tıklama başına ödeme yapılmasını sağlar. Tıklama başına ödeme, bir
                                reklam verenin reklamını yayınlayan bir influencer'a ödeme yapma yöntemidir.
                            </p>
                            <p>
                                Eğer bir Marka veya Reklam veren iseniz, bu entegrasyon türünü kullanarak
                                influencerlarınızın reklamlarını yayınlamasını sağlayabilir ve tıklama başına ödeme
                                yapabilirsiniz. Bu işlem için sistem içerisinde gerekli olan minimum tutardaki bakiye
                                yükleme işlemini gerçekleştirmeniz gerekmektedir.
                            </p>
                            <p>
                                Bakiye yükleme işlemi için <a href="{{ route('balance.index') }}">buraya</a> tıklayınız.
                            </p>
                            <p>
                                Her tıklama başına influencerlar, kampanya oluştururken belirlediğiniz komisyon oranı
                                üzerinden ödeme alır. Bu ödemeler, influencerlarınızın hesaplarına otomatik olarak yansır.
                            </p>
                            <p class="mt-3">
                                <b>Entegrasyon Adı:</b> Tıklama Entegrasyonu <br>
                                <b>Gerekli Parametreler:</b> - <br>
                            </p>

                            <p class="mt-3">
                                Web sitenize entegrasyonu yapmak için aşağıda yer alan JavaScript kodunu kopyalayıp, web
                                sitenizin <b>head</b> etiketi içerisine yapıştırınız. Sistemimiz otomatik olarak tıklama
                                başına ödeme yapılmasını sağlayacak olan kodu oluşturacaktır.
                            </p>
                            <div class="row">
                                <div class="col-6">
                                    <div class="card bg-dark text-white">
                                        <div class="card-body">
                                            <code id="js-code-0" class="text-white">
                                                &lt;script
                                                src="{{ $mainUrl }}{{ asset('assets/js/cookie.js') }}"&gt;&lt;/script&gt;
                                            </code>
                                            <button class="btn btn-primary mt-3" id="copy-button-0">Kopyala</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                            <p>
                                Bu entegrasyon türü, satış başına ödeme yapılmasını sağlar. Satış başına ödeme, influencer'a
                                verilen kampanya bağlantısında yer alan ürünlerin satışı gerçekleştiğinde ödeme yapılmasını
                                sağlar.
                            </p>
                            <p>
                                Eğer bir Marka veya Reklam veren iseniz, bu entegrasyon türünü kullanarak
                                influencerlarınızın kampanyalarını yayınlamasını sağlayabilir ve satış başına ödeme
                                yapabilirsiniz. Bu işlem için sistem içerisinde gerekli olan minimum tutardaki bakiye
                                yükleme işlemini gerçekleştirmeniz gerekmektedir.
                            </p>
                            <p>
                                Bakiye yükleme işlemi için <a href="{{ route('balance.index') }}">buraya</a> tıklayınız.
                            </p>
                            <p>
                                Her satış başına influencerlar, kampanya oluştururken belirlediğiniz komisyon oranı
                                üzerinden ödeme alır. Bu ödemeler, influencerlarınızın hesaplarına otomatik olarak yansır.
                            </p>
                            <p class="mt-3">
                                <b>Entegrasyon Adı:</b> Satış ve Çoklu İşlem Entegrasyonu <br>
                                <b>Gerekli Parametreler:</b>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Parametre Adı</th>
                                        <th>Parametre Açıklaması</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>token</td>
                                        <td>
                                            Bu parametre ile işlemin gerçekleştiği kullanıcının token'ını
                                            belirleyebilirsiniz. ( <a href="{{route('profile.index')}}#apiKey">Profil sayfasında</a> yer alan token bilgisini kullanabilirsiniz. )
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>refCode</td>
                                        <td>
                                            Bu parametre ile influencer'ın hangi kampanya bağlantısından satış yaptığını
                                            belirleyebilirsiniz. Bu parametre, verilen JavaScript kodunu doğru şekilde entegre ettiğinizde 15 gün web sitenizin çerezlerinde saklanır.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>purchaseValue</td>
                                        <td>
                                            Bu parametre ile satışın gerçekleştiği tutarı belirleyebilirsiniz.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ipAddress</td>
                                        <td>
                                            Bu parametre ile satışın gerçekleştiği IP adresini belirleyebilirsiniz.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>campaignId</td>
                                        <td>
                                            Bu parametre ile satışın gerçekleştiği kampanya ID'sini belirleyebilirsiniz.
                                        </td>
                                    </tr>
                            </table>
                            </p>
                            <p class="mt-3">
                                Web sitenize entegrasyonu yapmak için aşağıda yer alan JavaScript kodunu kopyalayıp, web
                                sitenizin <b>head</b> etiketi içerisine yapıştırınız. Sistemimiz otomatik olarak tıklama
                                başına ödeme yapılmasını sağlayacak olan kodu oluşturacaktır.
                            </p>
                            <div class="row">
                                <div class="col-6">
                                    <div class="card bg-dark text-white">
                                        <div class="card-body">
                                            <code id="js-code-1" class="text-white">
                                                &lt;script
                                                src="{{ $mainUrl }}{{ asset('assets/js/cookie.js') }}"&gt;&lt;/script&gt;
                                            </code>
                                            <button class="btn btn-primary mt-3" id="copy-button-1">Kopyala</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3">
                                Influencerlar tarafından yönlendirilen satış işlemlerinin tamamlanması için aşağıda yer alan
                                API endpoint'ini kullanabilirsiniz. Bu endpoint'e HTTP <b>POST</b> metodu ile istek yaparak
                                satış işlemini tamamlayabilirsiniz.
                            </p>
                            <div class="row">
                                <h5 class="fw-bold">Örnek PHP-Curl İsteği</h5>
                                <div class="col-12">
                                    <div class="card bg-dark text-white">
                                        <div class="card-body">
                                            <pre><code id="js-code-2" class="text-white">
                                                &lt;?php
                                                $curl = curl_init();
                                                
                                                curl_setopt_array($curl, array(
                                                CURLOPT_URL => '{{ $mainUrl }}/api/campaigns/purchase/success',
                                                CURLOPT_RETURNTRANSFER => true,
                                                CURLOPT_ENCODING => '',
                                                CURLOPT_MAXREDIRS => 10,
                                                CURLOPT_TIMEOUT => 0,
                                                CURLOPT_FOLLOWLOCATION => true,
                                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                CURLOPT_CUSTOMREQUEST => 'POST',
                                                CURLOPT_POSTFIELDS => array('bearerToken' => 'YOUR-BEARER-TOKEN','refCode' => 'CAMPAIGN-REFERANCE-CODE','campaignId' => 'CAMPAIGN-ID','purchaseValue' => 'PURCHASE-VALUE','ipAddress' => 'IP-ADDRESS'),
                                                ));
                                                
                                                $response = curl_exec($curl);
                                                
                                                curl_close($curl);
                                                echo $response;
                                                ?&gt;
                                                                        </code></pre>
                                            <button class="btn btn-primary mt-3" id="copy-button-2">Kopyala</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3">
                                <b>Not:</b> İsteğin başarılı bir şekilde tamamlanması durumunda, sistemimiz otomatik olarak
                                influencerlarınıza ödeme yapacaktır. İsteğin başarısız olması durumunda ya da hiç gönderilmemesi durumunda tüm işlemler iptal edilecektir.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('copy-button-0').addEventListener('click', function() {
            var code = document.getElementById('js-code-0').innerText.trim();
            var textarea = document.createElement('textarea');
            textarea.value = code;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            alert('Kod kopyalandı!');
        });
        document.getElementById('copy-button-1').addEventListener('click', function() {
            var code = document.getElementById('js-code-1').innerText.trim();
            var textarea = document.createElement('textarea');
            textarea.value = code;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            alert('Kod kopyalandı!');
        });
        document.getElementById('copy-button-2').addEventListener('click', function() {
            var code = document.getElementById('js-code-2').innerText.trim();
            var textarea = document.createElement('textarea');
            textarea.value = code;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            alert('Kod kopyalandı!');
        });
    </script>
@endsection
