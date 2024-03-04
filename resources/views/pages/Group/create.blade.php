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
                                    <div class="row justify-content-left">

                                        <div class="col-xl-6  mb-1">
                                            <h3 class="content-header-title mb-0">Buat Grup Chat</h3>

                                            <form action="{{ route('group.store') }}" method="POST" class="mt-2" enctype="multipart/form-data">
                                                @csrf
                                                <fieldset class="form-group">
                                                    <label for="basicInput">Nama Group</label>
                                                    <input type="text" name="group_name" required class="form-control"
                                                        id="basicInput">
                                                </fieldset>

                                                <fieldset class="form-group">
                                                    <label for="basicInput">Deskripsi Group</label>
                                                    <input type="text" name="desc" required class="form-control"
                                                        id="basicInput">
                                                </fieldset>
                                                <fieldset class="form-group">
                                                    <label for="basicInput">Gambar Group</label>
                                                    <input type="file" name="image" required class="form-control"
                                                        id="basicInput">
                                                </fieldset>
                                                <input type="hidden" value="{{ Auth::user()->id }}" name="anggota[]">

                                                <div class="form-group">
                                                    <div class="text-bold-600 font-medium-2">
                                                        Masukkan Anggota
                                                    </div>

                                                    <select class="select2 form-control" multiple="multiple"
                                                        name="anggota[]">

                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <button class="btn btn-primary mt-1" type="submit">Save</button>
                                            </form>
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
