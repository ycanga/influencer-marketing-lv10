<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <!-- Modal -->
        <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Talep Detayları</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <hr>
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="subject">Talep ID</label>
                                        <input type="text" class="form-control" id="id" disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="subject">Talep Tutarı (₺)</label>
                                        <input type="text" class="form-control" id="amount" disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="subject">Durum</label>
                                        <div id="status"></div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="subject">Talep Tarihi</label>
                                        <input type="text" class="form-control" id="date" disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="message">Destek Açıklaması</label>
                                        <div class="input-group">
                                            <textarea class="form-control" id="desc" disabled></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Kapat</button>
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

    $('.showDetails').click(function(event) {
        var id = $(this).data('item').id;
        var amount = $(this).data('item').amount;
        var status = $(this).data('item').status;
        var desc = $(this).data('item').transaction_note;
        var date = formatDate($(this).data('item').created_at);

        $("#id").val(id);
        $("#amount").val(amount);
        
        if (status == 'success') {
            $("#status").html('<span class="badge bg-success">Başarılı</span>');
        } else if (status == 'failed') {
            $("#status").html('<span class="badge bg-danger">Başarısız</span>');
        } else {
            $("#status").html('<span class="badge bg-warning">Beklemede</span>');
        }

        $("#desc").val(desc);
        $("#date").val(date);
    })
</script>