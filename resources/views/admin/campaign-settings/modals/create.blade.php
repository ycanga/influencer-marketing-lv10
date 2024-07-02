<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <!-- Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Kategori Oluştur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <hr>
                    <div class="modal-body">
                        <form action="{{ route('admin.categories.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="name">Kategori Adı <b class="text-danger">*</b></label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Kategori adını giriniz..." required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="type">Kategori Tipi <b class="text-danger">*</b></label>
                                            <select class="form-select" name="parent_id" required>
                                                <option value="main">Ana Kategori</option>
                                                @foreach ($campaignCategories as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ ucfirst($category->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
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
