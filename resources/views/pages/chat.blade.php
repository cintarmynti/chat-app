@extends('layouts.default')

@section('content')
    <div class="sidebar-left sidebar-fixed">
        <div class="sidebar">
            <div class="sidebar-content card d-none d-lg-block">
                <div class="card-body chat-fixed-search">
                    <fieldset class="form-group position-relative has-icon-left m-0">
                        <input type="text" class="form-control" id="iconLeft4" placeholder="Search user">
                        <div class="form-control-position">
                            <i class="ft-search"></i>
                        </div>
                    </fieldset>
                </div>
                <div id="users-list" class="list-group position-relative">
                    <div class="users-list-padding media-list" id="item-list">



                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-right">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="chat-app-window">
                    <div class="badge badge-default mb-1">Chat History</div>
                    <div class="chats">
                        <div class="chats">
                            <div class="chat">
                                <div class="chat-body mr-0">
                                    <div class="chat-content">
                                        <p>How can we help? We're here for you!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="chat chat-left">

                                <div class="chat-body ml-0">
                                    <div class="chat-content">
                                        <p>Hey John, I am looking for the best admin template.</p>
                                        <p>Could you please help me to find it out?</p>
                                    </div>
                                    <div class="chat-content">
                                        <p>It should be Bootstrap 4 compatible.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="chat-app-form">
                    <form class="chat-app-input d-flex" id="create-item-form">
                        @csrf
                        <fieldset class="form-group position-relative has-icon-left col-10 m-0">
                            <div class="form-control-position">
                                <i class="icon-emoticon-smile"></i>
                            </div>
                            <input type="text" name="receiver_id" id="receiver_id">
                            <input type="text" class="form-control" name="messages" id="iconLeft4"
                                placeholder="Type your message">
                            <div class="form-control-position control-position-right">
                                <i class="ft-image"></i>
                            </div>
                        </fieldset>
                        <fieldset class="form-group position-relative has-icon-left col-2 m-0">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane-o d-lg-none"></i>
                                <span class="d-none d-lg-block">Send</span>
                            </button>
                        </fieldset>
                    </form>
                </section>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            fetchItems();

            function fetchItems() {
                $.ajax({
                    method: 'GET',
                    dataType: 'json',
                    url: "http://127.0.0.1:8000/user",
                    success: function(response) {
                        var items = response[0].data;

                        var itemHtmlArray = items.map(function(item) {
                            var htmlContent =
                                '<a href="#" class="list-contact media border-0 edit-item" data-id="' +
                                item.id + '">' +
                                '<div class="media-left pr-1">' +
                                '<span class="avatar avatar-md avatar-online">' +
                                '<img class="media-object rounded-circle" src="{{ asset('app-assets/images/portrait/small/avatar-s-3.png') }}" alt="Generic placeholder image"><i></i>' +
                                '</span>' +
                                '</div>' +
                                '<div class="media-body w-100">' +
                                '<h6 class="list-group-item-heading">' + item.name +
                                '<span class="font-small-3 float-right primary">4:14 AM</span>' +
                                '</h6>' +
                                '<p class="list-group-item-text text-muted mb-0"><i class="ft-check primary font-small-2"></i> Okay' +
                                '<span class="float-right primary"><i class="font-medium-1 icon-pin blue-grey lighten-3"></i></span>' +
                                '</p>' +
                                '</div>' +
                                '</a>';

                            return htmlContent;
                        });

                        $('#item-list').html(itemHtmlArray.join(''));
                    }
                });
            }

            $(document).on('click', '.list-contact', function() {
                var itemId = $(this).data('id');
                console.log(itemId);
                $('#receiver_id').val(itemId);
            });

            window.editItem = function(id) {
                $.ajax({
                    url: '/chat/' + id,
                    type: 'GET',
                    success: function(response) {
                        $('#name').val(response.name);
                        $('#description').val(response.description);
                        // Assuming you have an update button with id="update-item"
                        $('#update-item').data('id', id);
                    }
                });
            };

            $('#create-item-form').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "/chat",
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log(response)
                        // Handle the success response
                    },
                    error: function(error) {
                        // Handle the error response
                    }
                });
            });


        });
    </script>
@endpush
