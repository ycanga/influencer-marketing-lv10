<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <!-- Modal -->
        <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Yükleme Detayları</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <hr>
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="name">Gönderici Adı</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="email">Gönderici Email</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="amount">Gönderilecek Tutar (₺)</label>
                                        <input type="text" class="form-control" id="amount" name="amount"
                                            disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="date">Talep Tarihi</label>
                                        <input type="text" class="form-control" id="date" name="date"
                                            disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="updated_at">Güncellenme Tarihi</label>
                                        <input type="text" class="form-control" id="updated_at" name="updated_at"
                                            disabled>
                                    </div>
                                    <div class="form-group mb-3 d-flex justify-content-center">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Kapat</button>
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
        var name = $(this).data('item').user.name;
        var email = $(this).data('item').user.email;
        var amount = $(this).data('item').amount;
        var date = $(this).data('item').created_at;
        var updated_at = $(this).data('item').updated_at;

        $("#name").val(name);
        $("#email").val(email);
        $("#amount").val(amount);
        $("#date").val(formatDate(date));
        $("#updated_at").val(formatDate(updated_at));
    })
</script>
