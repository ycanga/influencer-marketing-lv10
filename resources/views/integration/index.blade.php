@extends('layouts.app')

@section('title', 'Entegrasyon Yönetimi')

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
                                            belirleyebilirsiniz. ( <a href="{{ route('profile.index') }}#apiKey">Profil
                                                sayfasında</a> yer alan token bilgisini kullanabilirsiniz. )
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>refCode</td>
                                        <td>
                                            Bu parametre ile influencer'ın hangi kampanya bağlantısından satış yaptığını
                                            belirleyebilirsiniz. Bu parametre, verilen JavaScript kodunu doğru şekilde
                                            entegre ettiğinizde 15 gün web sitenizin çerezlerinde saklanır.
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
                                {{-- <h5 class="fw-bold">Örnek PHP-Curl İsteği</h5>
                                <div class="col-12">
                                    <div class="card bg-dark text-white">
                                        <div class="card-body">
                                            <pre><code id="js-code-2" class="text-white">
                                                &lt;?php
                                                function getClientIp()
                                                {
                                                    $ipAddress = '';
                                                    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                                                        $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
                                                    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                                                        $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
                                                    } else {
                                                        $ipAddress = $_SERVER['REMOTE_ADDR'];
                                                    }
                                                    $ipArray = explode(',', $ipAddress);
                                                    return trim($ipArray[0]);
                                                }
                                                $refcode = $_COOKIE["refCode"];
                                                $campaign = $_COOKIE["campaign"];
                                                 $curl = curl_init();
                                            
                                                curl_setopt_array($curl, array(
                                               CURLOPT_URL => 'https://aymo.4lphasoftware.com/api/campaigns/purchase/success',
                                                   CURLOPT_RETURNTRANSFER => true,
                                                  CURLOPT_ENCODING => '',
                                                  CURLOPT_MAXREDIRS => 10,
                                                   CURLOPT_TIMEOUT => 0,
                                              CURLOPT_FOLLOWLOCATION => true,
                                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                               CURLOPT_CUSTOMREQUEST => 'POST',
                                               CURLOPT_POSTFIELDS => array('bearerToken' => 'YOUR-API-TOKEN','refCode' => $refcode,'campaignId' => $campaign,'purchaseValue' => 'YOUR-PURCHASE-VALUE','ipAddress' => 'getClientIp()'),
                                                                                            ));
                                            
                                              $response = curl_exec($curl);
                                            
                                               curl_close($curl);
                                                ?&gt;
                                                                        </code></pre>
                                            <button class="btn btn-primary mt-3" id="copy-button-2">Kopyala</button>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-xl-12">
                                    <h3 class="text-muted">Örnek İstekler</h3>
                                    <div class="nav-align-top mb-4">
                                        <ul class="nav nav-tabs nav-fill" role="tablist">
                                            <li class="nav-item">
                                                <button type="button" class="nav-link active" role="tab"
                                                    data-bs-toggle="tab" data-bs-target="#navs-justified-home"
                                                    aria-controls="navs-justified-home" aria-selected="true">
                                                    <i class='tf-icons bx bxl-php'></i> PHP Curl
                                                </button>
                                            </li>
                                            <li class="nav-item">
                                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                                    data-bs-target="#navs-justified-profile"
                                                    aria-controls="navs-justified-profile" aria-selected="false">
                                                    <i class='tf-icons bx bxl-c-sharp'></i>
                                                    .NET
                                                </button>
                                            </li>
                                            <li class="nav-item">
                                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                                    data-bs-target="#navs-justified-messages"
                                                    aria-controls="navs-justified-messages" aria-selected="false">
                                                    <i class='tf-icons bx bxl-django'></i> Django
                                                </button>
                                            </li>
                                            <li class="nav-item">
                                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                                    data-bs-target="#navs-justified-js"
                                                    aria-controls="navs-justified-js" aria-selected="false">
                                                    <i class="tf-icons bx bxl-javascript"></i> Javascript
                                                </button>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                                                <div class="card bg-dark text-white">
                                                    <div class="card-body">
                                                        <pre><code id="js-code-php" class="text-white">
&lt;?php

function getClientIp()
{
    $ipAddress = '';
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
    }
    $ipArray = explode(',', $ipAddress);
    return trim($ipArray[0]);
}

$refcode = $_COOKIE["refCode"];
$campaign = $_COOKIE["campaign"];

$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => 'https://aymo.4lphasoftware.com/api/campaigns/purchase/success',
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'POST',
CURLOPT_POSTFIELDS => array('bearerToken' => 'YOUR-API-TOKEN','refCode' => $refcode,'campaignId' => $campaign,'purchaseValue' => 'YOUR-PURCHASE-VALUE','ipAddress' => 'getClientIp()'),
));

$response = curl_exec($curl);

curl_close($curl);
?&gt;
                                                                                </code></pre>
                                                        <button class="btn btn-primary mt-3"
                                                            id="copy-button-php">Kopyala</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                                                <div class="card bg-dark text-white">
                                                    <div class="card-body">
                                                        <pre><code id="js-code-net" class="text-white">
using System;
using System.Net;
using System.Net.Http;
using System.Threading.Tasks;
using System.Web;

public class Program
{
    public static async Task Main(string[] args)
    {
        string refCode = GetCookie("refCode");
        string campaign = GetCookie("campaign");
        string clientIp = GetClientIp();

        using (var client = new HttpClient())
        {
            var values = new FormUrlEncodedContent(new[]
            {
                new KeyValuePair<string, string>("bearerToken", "YOUR-API-TOKEN"),
                new KeyValuePair<string, string>("refCode", refCode),
                new KeyValuePair<string, string>("campaignId", campaign),
                new KeyValuePair<string, string>("purchaseValue", "YOUR-PURCHASE-VALUE"),
                new KeyValuePair<string, string>("ipAddress", clientIp)
            });

            var response = await client.PostAsync("https://aymo.4lphasoftware.com/api/campaigns/purchase/success", values);
            var responseString = await response.Content.ReadAsStringAsync();

            Console.WriteLine(responseString);
        }
    }

    public static string GetClientIp()
    {
        string ipAddress = HttpContext.Current.Request.ServerVariables["HTTP_CLIENT_IP"];

        if (string.IsNullOrEmpty(ipAddress))
        {
            ipAddress = HttpContext.Current.Request.ServerVariables["HTTP_X_FORWARDED_FOR"];
        }

        if (string.IsNullOrEmpty(ipAddress))
        {
            ipAddress = HttpContext.Current.Request.ServerVariables["REMOTE_ADDR"];
        }

        if (!string.IsNullOrEmpty(ipAddress) && ipAddress.Contains(","))
        {
            ipAddress = ipAddress.Split(',')[0].Trim();
        }

        return ipAddress;
    }

    public static string GetCookie(string key)
    {
        var cookie = HttpContext.Current.Request.Cookies[key];
        return cookie != null ? cookie.Value : string.Empty;
    }
}

                                                                                </code></pre>
                                                        <button class="btn btn-primary mt-3"
                                                            id="copy-button-net">Kopyala</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
                                                <div class="card bg-dark text-white">
                                                    <div class="card-body">
                                                        <pre><code id="js-code-dj" class="text-white">
import requests
from django.http import JsonResponse
from django.shortcuts import render

def get_client_ip(request):
    ip_address = request.META.get('HTTP_CLIENT_IP') or request.META.get('HTTP_X_FORWARDED_FOR') or request.META.get('REMOTE_ADDR')
    ip_address = ip_address.split(',')[0].strip() if ip_address else None
    return ip_address

def purchase_success(request):
    ref_code = request.COOKIES.get('refCode')
    campaign = request.COOKIES.get('campaign')
    client_ip = get_client_ip(request)

    url = 'https://aymo.4lphasoftware.com/api/campaigns/purchase/success'
    payload = {
        'bearerToken': 'YOUR-API-TOKEN',
        'refCode': ref_code,
        'campaignId': campaign,
        'purchaseValue': 'YOUR-PURCHASE-VALUE',
        'ipAddress': client_ip
    }

    response = requests.post(url, data=payload)
    return JsonResponse(response.json())

# In your urls.py, you should add the corresponding URL pattern:
# from django.urls import path
# from .views import purchase_success

# urlpatterns = [
#     path('purchase-success/', purchase_success, name='purchase_success'),
# ]
                                                            
                                                                                </code></pre>
                                                        <button class="btn btn-primary mt-3"
                                                            id="copy-button-dj">Kopyala</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="navs-justified-js" role="tabpanel">
                                                <div class="card bg-dark text-white">
                                                    <div class="card-body">
                                                        <pre><code id="js-code-js" class="text-white">
// IP adresini almak için üçüncü parti bir API kullanabiliriz.
async function getClientIp() {
    const response = await fetch('https://api.ipify.org?format=json');
    const data = await response.json();
    return data.ip;
}

// Çerezleri almak için bir yardımcı fonksiyon
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

// Ana fonksiyon
async function sendPurchaseSuccess() {
    const refCode = getCookie('refCode');
    const campaign = getCookie('campaign');
    const clientIp = await getClientIp();

    const url = 'https://aymo.4lphasoftware.com/api/campaigns/purchase/success';
    const payload = {
        bearerToken: 'YOUR-API-TOKEN',
        refCode: refCode,
        campaignId: campaign,
        purchaseValue: 'YOUR-PURCHASE-VALUE',
        ipAddress: clientIp
    };

    const response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(payload)
    });

    const responseData = await response.json();
    console.log(responseData);
}

// Bu fonksiyonu istediğiniz bir yerde çağırarak işlemi başlatabilirsiniz.
sendPurchaseSuccess();
                                                            
                                                            
                                                                                </code></pre>
                                                        <button class="btn btn-primary mt-3"
                                                            id="copy-button-js">Kopyala</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3">
                                <b>Not:</b> İsteğin başarılı bir şekilde tamamlanması durumunda, sistemimiz otomatik olarak
                                influencerlarınıza ödeme yapacaktır. İsteğin başarısız olması durumunda ya da hiç
                                gönderilmemesi durumunda tüm işlemler iptal edilecektir.
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
        document.getElementById('copy-button-php').addEventListener('click', function() {
            var code = document.getElementById('js-code-php').innerText.trim();
            var textarea = document.createElement('textarea');
            textarea.value = code;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            alert('Kod kopyalandı!');
        });
        document.getElementById('copy-button-net').addEventListener('click', function() {
            var code = document.getElementById('js-code-net').innerText.trim();
            var textarea = document.createElement('textarea');
            textarea.value = code;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            alert('Kod kopyalandı!');
        });
        document.getElementById('copy-button-dj').addEventListener('click', function() {
            var code = document.getElementById('js-code-dj').innerText.trim();
            var textarea = document.createElement('textarea');
            textarea.value = code;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            alert('Kod kopyalandı!');
        });
        document.getElementById('copy-button-js').addEventListener('click', function() {
            var code = document.getElementById('js-code-js').innerText.trim();
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
