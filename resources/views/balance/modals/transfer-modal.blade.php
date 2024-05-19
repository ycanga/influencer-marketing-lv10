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
                                <div class="card icon-card cursor-pointer text-center mb-4 mx-2 shadow">
                                    <div class="card-body">
                                        {!! $models->icon_html ?? "<i class='bx bxs-bank'></i>" !!}
                                        <p class="icon-name text-capitalize text-truncate mb-0">{{$models->name}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
