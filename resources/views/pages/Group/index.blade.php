@extends('layouts.default')

@section('content')
    <div id="authUserId" data-user-id="{{ Auth::user()->id }}"></div>
    <div class="sidebar-left sidebar-fixed">
        <div class="sidebar">
            <div class="sidebar-content card d-none d-lg-block">
                <div class="card-body chat-fixed-search">
                    <fieldset class="form-group position-relative has-icon-left m-0">
                        <input type="text" class="form-control" id="inputPencarian" placeholder="Search user">
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
                        <div class="chats" id="chat-container">

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
                            <input type="text" class="form-control" name="messages" id="msg"
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
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <script>
        $(document).ready(function() {

            fetchItems();

            //menampilkan list group
            function fetchItems() {
                $.ajax({
                    method: 'GET',
                    dataType: 'json',
                    url: "/group-list",
                    success: function(response) {
                        // console.log(response.data);
                        var items = response.data;

                        var itemHtmlArray = items.map(function(item) {
                            var htmlContent =
                                '<a href="#" class="list-contact media border-0 edit-item" data-id="' +
                                item.id + '" data-nama="' + item.group_name + '">' +
                                '<div class="media-left pr-1">' +
                                '<span class="avatar avatar-md avatar-online">' +
                                '<img class="media-object rounded-circle" src="{{ asset('app-assets/images/portrait/small/avatar-s-3.png') }}" alt="Generic placeholder image"><i></i>' +
                                '</span>' +
                                '</div>' +
                                '<div class="media-body w-100">' +
                                '<h6 class="list-group-item-heading">' + item.group_name +
                                // Perbaikan: Mengganti item.name menjadi item.group_name
                                '<span class="font-small-3 float-right primary">4:14 AM</span>' +
                                '</h6>' +
                                '<p class="list-group-item-text text-muted mb-0"><i class="ft-check primary font-small-2"></i> Okay' +
                                '<span class="float-right primary"></span>' +
                                '</p>' +
                                '</div>' +
                                '</a>';

                            return htmlContent;
                        });


                        $('#item-list').html(itemHtmlArray.join(''));
                    }
                });
            }

            function fetchhGroupChat(messages) {
                var authUserId = $('#authUserId').data('user-id');
                var chatContainer = $('#chat-container');
                var msg = messages.data;
                console.log(msg)



                if (Array.isArray(msg)) {
                    var chatHtml = msg.map(function(message) {
                        var chatClass = message.sender_id == authUserId ? '' : 'chat-left';

                        return '<div class="chat ' + chatClass + '">' +
                            '<div class="chat-body ml-0">' +
                            '<div class="chat-content">' +
                            '<span class="sender-name">'+ message.users.name +'</span>'+
                            '<p>' + message.content + '</p>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    }).join(''); // Join the array into a single string

                    // Set the HTML content of the chat container
                    chatContainer.html(chatHtml);
                } else {
                    console.error('Invalid or missing messages array:', msg);
                }
            }

            $(document).on('click', '.list-contact', function() {
                var itemId = $(this).data('id');
                // console.log(itemId);
                $('#receiver_id').val(itemId);

                $.ajax({
                    type: "GET",
                    url: "/group/" + itemId,
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);
                        fetchhGroupChat(response);
                    }
                });


            });


            //fungsi untuk mengirim pesan kepada kontak lain
            $('#create-item-form').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    type: "POST",
                    url: "/group-send",
                    data: $(this).serialize(),
                    success: function(response) {
                        // console.log(response)
                        // Handle the success response

                        form.find('#msg').val('');
                    },
                    error: function(error) {
                        // Handle the error response
                    }
                });
            });
        });
    </script>
@endpush
