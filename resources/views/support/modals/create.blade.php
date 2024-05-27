<script src="https://cdn.tiny.cloud/1/c8irtbmev6k4bshau3nhc79i52h8dsshesj9n5mt33zoiegr/tinymce/7/tinymce.min.js"
referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#editor',
        menubar: false,
        height: 300,
        width: '100%',
    });
</script>
<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <!-- Modal -->
        <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Destek Talebi Oluşturun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <hr>
                    <div class="modal-body">
                        <div class="modal-body">
                            <form action="{{ route('support.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="subject">Konu <b class="text-danger">*</b></label>
                                            <input type="text" class="form-control" id="subject" name="subject"
                                                placeholder="Destek talebinde bulunacağınız konu nedir ?" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="message">Destek Açıklaması</label>
                                            <div class="form-text mb-1">
                                                <b class="text-danger">*</b>
                                                İşlemlerin hızlı gerçekleşmesi için lütfen detaylı bir şekilde konuyu açıklayınız.
                                            </div>
                                            <div class="input-group">
                                                <textarea id="editor" name="message"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary">Kaydet</button>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"
        integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>