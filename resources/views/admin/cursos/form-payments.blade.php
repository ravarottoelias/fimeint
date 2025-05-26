

<div class="container-fluid">
    <div class="">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-3 d-flex justify-content-center align-items-center">
                    <div class="icon2 bg-primary text-white d-flex justify-content-center align-items-center">
                        <i class="fas fa-th-list"></i>
                    </div>
                    </div>
                <div class="col">
                    <p class="card-title text-muted mb-0">Total Pagos</p>
                    <span class="h2 font-weight-bold mb-0">{{ $payments->count() }}</span>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-3 d-flex justify-content-center align-items-center">
                    <div class="icon2 bg-primary text-white d-flex justify-content-center align-items-center">
                        <i class="fas fa-dollar-sign indicator-icon"></i>
                    </div>
                    </div>
                <div class="col">
                    <p class="card-title text-muted mb-0">Total Cobrado</p>
                    <span class="h2 font-weight-bold mb-0">$  @precio($paymentsIndicator['totalAmount'])</span>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-3 d-flex justify-content-center align-items-center">
                    <div class="icon2 bg-primary text-white d-flex justify-content-center align-items-center">
                        <i class="fas fa-dollar-sign indicator-icon"></i>
                    </div>
                    </div>
                <div class="col">
                    <p class="card-title text-muted mb-0">Total Recibido</p>
                    <span class="h2 font-weight-bold mb-0">$ @precio($paymentsIndicator['netTotalAmount']) </span>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="my-3">
        <div class="row">
            <div class="col">
                <a href="{{ route('payments') }}?cursoId={{ $curso->id }}&cursoTitulo={{ $curso->titulo }}" class="btn btn-block btn-primary">VER PAGOS</a>
            </div>
        </div>
    </div>
</div>
