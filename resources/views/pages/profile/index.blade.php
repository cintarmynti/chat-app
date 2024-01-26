@extends('layouts.default')

@push('style')
    <style>
        .circle-div {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background-color: salmon;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper m-2">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Profile</h3>
            </div>
            <div class="content-header-right col-md-6 col-12">

            </div>
        </div>
        <div class="content-body">
            <!-- Basic Elements start -->
            <section class="basic-elements">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                            {{-- ini img profile  --}}

                                            <div class="row justify-content-center">
                                                <div class="col-md-4 text-center">
                                                    <div class="circle-div">
                                                        <!-- Content inside the circular div -->
                                                        Your Content Here
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                            <fieldset class="form-group">
                                                <label for="disabledInput">Nama</label>
                                                <input type="text" class="form-control" id="readonlyInput"
                                                    readonly="readonly" value="{{ $user->name }}">
                                            </fieldset>

                                            <fieldset class="form-group">
                                                <label for="disabledInput">Email</label>
                                                <input type="text" class="form-control" id="readonlyInput"
                                                    readonly="readonly" value="{{ $user->email }}">
                                            </fieldset>

                                            <button class="btn btn-primary mt-1" data-toggle="modal"
                                                data-target="#exampleModal">Edit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('profile.update')}}" method="POST">
            @csrf
            @method('PUT')
            <fieldset class="form-group">
                <label for="basicInput">Nama</label>
                <input type="text" name="name" class="form-control" id="namaKamu">
              </fieldset>

              <fieldset class="form-group">
                <label for="basicInput">Email</label>
                <input type="text" name="email" class="form-control" id="emailKamu">
              </fieldset>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
        </div>
      </div>
    </div>
  </div>
@endsection


@push('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
  $(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "/profile-user",
        dataType: "json",
        success: function (response) {
            $('#namaKamu').val(response.data.name);
            $('#emailKamu').val(response.data.email);
        }
    });
});


  </script>
@endpush
