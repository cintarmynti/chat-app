@extends('layouts.default')

@push('style')
    <style>
         .profile-circle {
      width: 250px;
      height: 250px;
      border-radius: 50%;
      overflow: hidden;
      margin: auto;
    }

    .profile-image {
      width: 100%;
      height: 100%;
      object-fit: cover;

    }
    </style>
@endpush

@section('content')
    <div class="content-wrapper m-2">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/chat">Private Chat</a>
                            </li>
                            <li class="breadcrumb-item active">Profile
                            </li>
                        </ol>
                    </div>
                </div>
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
                                        <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                            <div class="container ">
                                                <div class="profile-circle">

                                                    <img src="{{ isset($user->image_path) ? asset('storage/'. $user->image_path) : asset('app-assets/images/profile-kosong.jpg') }}" alt="Profil" class="profile-image">
                                                </div>
                                              </div>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
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

                        <fieldset class="form-group">
                            <label for="basicInputFile">Simple File Input</label>
                            <input type="file" name="image" class="form-control-file" >
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
        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "/profile-user",
                dataType: "json",
                success: function(response) {
                    $('#namaKamu').val(response.data.name);
                    $('#emailKamu').val(response.data.email);
                }
            });
        });
    </script>
@endpush
