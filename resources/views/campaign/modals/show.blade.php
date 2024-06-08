{{-- <div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <!-- Modal -->
        <div class="modal fade" id="showModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Kampanya Detayları</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <hr>
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="name">Kampanya Adı <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            required placeholder="Kampanya adını giriniz...">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="desc">Kampanya Açıklaması</label>
                                        <textarea id="desc" cols="30" rows="5" class="form-control" name="desc" required
                                            placeholder="Kampanya açıklaması giriniz..."></textarea>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="link">Kampanya Yönlendirilecek Bağlantı <b
                                                class="text-danger">*</b></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="link" name="link"
                                                required placeholder="Kampanya Yönlendirilecek bağlantıyı giriniz..." />
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="link">Kampanya Kapak Resmi </label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="image" name="image"
                                                required placeholder="Kampanya kapak resmi seçiniz..." />
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="link">Kampanya Tipi <b class="text-danger">*</b></label>
                                        <div class="input-group">
                                            <select class="form-select" aria-label="Default select example" required
                                                name="type" id="type">
                                                <option value="" selected>Seçiniz...</option>
                                                <option value="sales">Satış Kampanyası</option>
                                                <option value="click">Tıklanma Kampanyası</option>
                                                <option value="multiple">Çoklu işlem Kampanyası</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3" id="campaignRevenueTable" style="display: none;">
                                        <label for="merchant">Kampanya Kazanç Tablosu <b
                                                class="text-danger">*</b></label> <br>
                                        <div id="defaultFormControlHelp" class="form-text">
                                            <b class="text-danger">**</b>
                                            Kampanya tipine göre Influencer kazanç tablosu oluşturulacaktır.
                                        </div>
                                        <div class="container mt-3">
                                            <div class="form-group mb-3" id="sbm" style="display: none;">
                                                <label for="sbm">Satış Başına Kazanç (%)</label>
                                                <input type="text" class="form-control" id="sbm" required
                                                    name="sbm" placeholder="Satış başına kazanç oranı (%)">
                                            </div>
                                            <div class="form-group mb-3" id="tbm" style="display: none;">
                                                <label for="tbm">Tıklanma Başına Kazanç (₺)</label>
                                                <input type="text" class="form-control" id="tbm" required
                                                    name="tbm" placeholder="Tıklanma başına kazanç oranı (₺)">
                                                <div class="form-group mb-3 mt-3" id="multipleClick">
                                                    <label for="multipleClick">Çoklu tıklama kullanılabilir mi ?</label>
                                                    <div id="defaultFormControlHelp" class="form-text">
                                                        <b class="text-danger">**</b>
                                                        Çoklu tıklama aktif edilirse aynı kullanıcı birden fazla tıklama
                                                        yapabilir ve Influencer bu işlemlerden kazanç sağlayabilir.
                                                    </div>
                                                    <select name="multipleClick" class="form-select" required>
                                                        <option value="1">Evet</option>
                                                        <option value="0" selected>Hayır</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="time">Kampanya Süresi</label>
                                        <div id="defaultFormControlHelp" class="form-text">
                                            <b class="text-danger">*</b>
                                            Boş bırakılırsa süresiz olarak işaretlenecektir.
                                        </div>
                                        <input type="date" class="form-control" id="time" name="time">
                                    </div>
                                    <div class="form-group mb-3 d-flex justify-content-center">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                            aria-label="Close">Kapat</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var type = document.getElementById('type');
    var campaignRevenueTable = document.getElementById('campaignRevenueTable');
    var sbm = document.getElementById('sbm');
    var tbm = document.getElementById('tbm');

    type.addEventListener('change', function() {
        if (type.value == 'sales') {
            campaignRevenueTable.style.display = 'block';
            sbm.style.display = 'block';
            tbm.style.display = 'none';
        } else if (type.value == 'click') {
            campaignRevenueTable.style.display = 'block';
            sbm.style.display = 'none';
            tbm.style.display = 'block';
        } else if (type.value == 'multiple') {
            campaignRevenueTable.style.display = 'block';
            sbm.style.display = 'block';
            tbm.style.display = 'block';
        } else {
            campaignRevenueTable.style.display = 'none';
            sbm.style.display = 'none';
            tbm.style.display = 'none';
        }
    });
</script>

<script>
    function formatDate(dateString) {
        const date = new Date(dateString);

        // Gün ve ayları iki haneli hale getirmek için 'padStart' kullanımı
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0'); // Aylar 0-11 arası olduğu için +1 ekliyoruz
        const year = date.getFullYear();

        // Saat ve dakikaları iki haneli hale getirmek için 'padStart' kullanımı
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');

        // İstenen formatta tarih ve zaman döndürülüyor
        return `${day}.${month}.${year} ${hours}:${minutes}`;
    }

    $('.dataShow').click(function(event) {
        console.log($(this).data('item'));

        var merchant = $(this).data('item').name;
        var status = $(this).data('item').status;
        var desc = $(this).data('item').description;
        var date = formatDate($(this).data('item').created_at);
        var name = $(this).data('item').name;
        var link = $(this).data('item').link;
        var sale = $(this).data('item').sbm ?? '-';
        var click = $(this).data('item').tbm ?? '-';
        var action = $(this).data('item').ibm ?? '-';
        var time = $(this).data('item').time ?? 'Süresiz';
        var visitLink = document.getElementById('visitLink');

        console.log(merchant, status, desc, date, name, link, sale, click, action, time);

        if (status == 'active') {
            $("#status").html('<span class="badge bg-success">Aktif</span>');
        } else if (status == 'inactive') {
            $("#status").html('<span class="badge bg-danger">Pasif</span>');
        } else {
            $("#status").html('<span class="badge bg-warning">Beklemede</span>');
        }

        $("#name").val(merchant);
        $("#desc").val(desc);
        $("#date").val(date);
        $("#name").val(name);
        $("#link").val(link);
        $("#sbm").html("%"+sale);
        $("#tbm").html(click+" ₺");
        $("#ibm").html(action + " ₺");
        $("#time").val(time);

    });
</script> --}}

<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <!-- Modal -->
        <div class="modal fade" id="showModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Kampanya Detayları</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <hr>
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="merchant">Kampanya Sahibi (Marka)</label>
                                        <input type="text" class="form-control" id="merchant" disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name">Kampanya Adı</label>
                                        <input type="text" class="form-control" id="name" name="name" disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="desc">Kampanya Açıklaması</label>
                                        {{-- <input type="text" class="form-control" id="desc" disabled> --}}
                                        <textarea id="desc" cols="30" rows="5" class="form-control" disabled></textarea>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="link">Kampanya Bağlantısı</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="link" disabled
                                                placeholder="Kampanya bağlantısı..."/>
                                            <a href="#" class="btn btn-outline-primary" id="visitLink" target="_blank">Ziyaret Et</a>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Satış Başına Kazanç (%) </th>
                                                    <th>Tıklanma Başına Kazanç (₺)</th>
                                                    <th>İşlem Başına Kazanç (₺)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td id="sbm"></td>
                                                    <td id="tbm"></td>
                                                    <td id="ibm"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="time">Kampanya Süresi</label>
                                        <input type="text" class="form-control" id="time" disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="status">Durum</label>
                                        <div id="status"></div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="date">Kampanya Oluşturulma Tarihi</label>
                                        <input type="text" class="form-control" id="date" disabled>
                                    </div>
                                    <div class="form-group mb-3 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal"
                                            aria-label="Close">Kapat</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function formatDate(dateString) {
        const date = new Date(dateString);

        // Gün ve ayları iki haneli hale getirmek için 'padStart' kullanımı
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0'); // Aylar 0-11 arası olduğu için +1 ekliyoruz
        const year = date.getFullYear();

        // Saat ve dakikaları iki haneli hale getirmek için 'padStart' kullanımı
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');

        // İstenen formatta tarih ve zaman döndürülüyor
        return `${day}.${month}.${year} ${hours}:${minutes}`;
    }

    $('.showCampaignData').click(function(event) {
        var status = $(this).data('item').status;
        var desc = $(this).data('item').description;
        var date = formatDate($(this).data('item').created_at);
        var name = $(this).data('item').name;
        var link = $(this).data('item').link;
        var sale = $(this).data('item').sbm ?? '-';
        var click = $(this).data('item').tbm ?? '-';
        var action = $(this).data('item').ibm ?? '-';
        var time = $(this).data('item').time ?? 'Süresiz';
        var visitLink = document.getElementById('visitLink');
        var merchant = $(this).data('item').merchant.name;

        console.log(merchant);

        if (status == 'active') {
            $("#status").html('<span class="badge bg-success">Aktif</span>');
        } else if (status == 'inactive') {
            $("#status").html('<span class="badge bg-danger">Pasif</span>');
        } else {
            $("#status").html('<span class="badge bg-warning">Beklemede</span>');
        }

        $("#desc").val(desc);
        $("#date").val(date);
        $("#name").val(name);
        $("#link").val(link);
        $("#sbm").html("%"+sale);
        $("#tbm").html(click+" ₺");
        $("#ibm").html(action + " ₺");
        $("#time").val(time);
        visitLink.href = link;
        $("#merchant").val(merchant);
    })
</script>

