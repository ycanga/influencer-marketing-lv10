<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <!-- Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Kampanya Oluştur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <hr>
                    <div class="modal-body">
                        <form action="{{ route('merchant.campaign.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="name">Kampanya Adı <b class="text-danger">*</b></label>
                                            <input type="text" class="form-control" id="name" name="name" disa
                                                placeholder="Kampanya adını giriniz...">
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
                                                <input type="text" class="form-control" id="link" name="link" required
                                                    placeholder="Kampanya Yönlendirilecek bağlantıyı giriniz..." />
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="link">Kampanya Kapak Resmi </label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" id="image" name="image" required
                                                    placeholder="Kampanya kapak resmi seçiniz..." />
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
                                                    <div class="form-group mb-3 mt-3" id="multipleClick" >
                                                        <label for="multipleClick">Çoklu tıklama kullanılabilir mi ?</label>
                                                        <div id="defaultFormControlHelp" class="form-text">
                                                            <b class="text-danger">**</b>
                                                            Çoklu tıklama aktif edilirse aynı kullanıcı birden fazla tıklama yapabilir ve Influencer bu işlemlerden kazanç sağlayabilir.
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
                                            <input type="date" class="form-control" id="time"
                                                name="time">
                                        </div>
                                        <div class="form-group mb-3 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal"
                                                aria-label="Close">Kaydet</button>
                                        </div>
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
