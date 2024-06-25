<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <!-- Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Yeni Soru Ekle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <hr>
                    <div class="modal-body">
                        <form action="#" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="question">Soru <b class="text-danger">*</b></label>
                                            <input type="text" class="form-control" id="question" name="question"
                                                placeholder="Soru giriniz..." required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="answer">Soru Açıklaması <b class="text-danger">*</b></label>
                                            <textarea id="answer" cols="30" rows="5" class="form-control" name="answer"
                                                placeholder="Soru açıklaması giriniz..."></textarea>
                                        </div>
                                        <div class="form-group mb-3 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary">Kaydet</button>
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
    document.addEventListener('DOMContentLoaded', function() {
        var type = document.getElementById('type');
        var campaignRevenueTable = document.getElementById('campaignRevenueTable');
        var sbmDiv = document.getElementById('sbmDiv');
        var tbmDiv = document.getElementById('tbmDiv');

        type.addEventListener('change', function() {
            if (type.value == 'sales') {
                campaignRevenueTable.style.display = 'block';
                sbmDiv.style.display = 'block';
                tbmDiv.style.display = 'none';
            } else if (type.value == 'click') {
                campaignRevenueTable.style.display = 'block';
                sbmDiv.style.display = 'none';
                tbmDiv.style.display = 'block';
            } else if (type.value == 'multiple') {
                campaignRevenueTable.style.display = 'block';
                sbmDiv.style.display = 'block';
                tbmDiv.style.display = 'block';
            } else {
                campaignRevenueTable.style.display = 'none';
                sbmDiv.style.display = 'none';
                tbmDiv.style.display = 'none';
            }
        });
    });
</script>
