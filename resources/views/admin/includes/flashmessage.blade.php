@if (session('success'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong><i class="fa fa-check-circle"></i></strong> {{session('success')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
@if (session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Oh no!</strong> {{session('error')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
@if (count($errors) > 0)
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
@if (session('apiValidationErrors'))
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-danger">
              @foreach (session('apiValidationErrors') as $key => $value)
              {{ $key }}
              <ul>
                  @foreach ($value as $ix => $message)
                    <li>{{ $message }}</li>
                  @endforeach
                </ul>
              @endforeach
              
            </div>
        </div>
    </div>
@endif