@extends('layouts.default')

@push('style')
    <style>
        .users-list-padding {
            background-color: white;
            height: 100vh;
        }

        .list-contact {
            background-color: white;
        }

        .sidebar-left {
            padding-left: 0;
        }

        .sidebar-content {
            height: 100vh;
            background-color: white;

        }

        .chat-app-window {
            margin: 0;
            padding: 0 !important;
            position: relative;

        }

        .nav-group {
            position: fixed;
            width: 90%;
            height: 70px;
            z-index: 100;
        }

        .chat-application .chat-app-window{
            text-align: left;
        }

        .chats {
            margin-top: 50px;
            /* Menambahkan margin atas pada .chats untuk menghindari tumpang tindih dengan .nav-group */
        }
    </style>
@endpush
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
                    <div class="d-flex bg-primary m-0 p-0 nav-group hidden" id="nav-group">
                        <div class="ml-3 media-left pr-1 align-self-center">
                            <span class="avatar avatar-md avatar-online">
                                <img class="media-object img-group rounded-circle" id="img-profile"
                                    src="/app-assets/images/group-none.jpeg" alt="Generic placeholder image">
                                <i></i>
                            </span>
                        </div>
                        <div class="">
                            <h4 id="profile-name" class="mt-1"> </h4>
                           <p id="profile-desc"></p>
                        </div>
                    </div>
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
                            <input type="hidden" name="receiver_id" id="receiver_id">
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
        // ini untuk pusher nya
        var pusher = new Pusher('32a5a870d066ac495f8c', {
            cluster: 'ap1'
        });


        $(document).ready(function() {
            fetchItems();

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;


            //fungsi untuk menampilkan list kontak
            function fetchItems() {
                $.ajax({
                    method: 'GET',
                    dataType: 'json',
                    url: "http://127.0.0.1:8000/user",
                    success: function(response) {
                        // console.log(response.data);
                        var items = response.data;


                        var itemHtmlArray = items.map(function(item) {
                            var imageUrl = item.image_path ? 'storage/' + item.image_path :
                                '/app-assets/images/profile-kosong.jpg';
                            var htmlContent =
                                '<a href="#" class="list-contact media border-0 edit-item" data-id="' +
                                item.user_id + '" data-nama="' + item.user_name + '">' +
                                '<div class="media-left pr-1">' +
                                '<span class="avatar avatar-md avatar-online">' +
                                '<img class="media-object rounded-circle" src="' + imageUrl +
                                '" alt="Generic placeholder image"><i></i>' +
                                '</span>' +
                                '</div>' +
                                '<div class="media-body w-100">' +
                                '<h6 class="list-group-item-heading">' + item.user_name +
                                '<span class="font-small-3 float-right primary">' + item
                                .last_chat_time + '</span>' +
                                '</h6>' +
                                '<p class="list-group-item-text text-muted mb-0"><i class="ft-check primary font-small-2"></i> ' +
                                item.last_message +
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

            //trigger untuk fungsi pencarian
            $('#inputPencarian').keyup(function() {
                var kataKunci = $(this).val();
                cariUser(kataKunci);
            })

            //fungsi untuk menampilkan list kontak yang dicari
            function cariUser(nama) {
                var listKontak = $('.list-contact');

                listKontak.each(function() {
                    var namaUser = $(this).data('nama').toLowerCase();

                    if (namaUser.includes(nama.toLowerCase())) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }


            //fitur untuk menampilkn chat
            function fetchUserChat(messages) {
                var authUserId = $('#authUserId').data('user-id');
                var chatContainer = $('#chat-container');
                var msg = messages.data;
                // console.log(msg)

                var channel = pusher.subscribe('my-channel-chat');
                channel.bind('my-event-chat', function(data) {
                    handleNewChatMessage(data, authUserId, chatContainer);
                });

                if (Array.isArray(msg)) {
                    var chatHtml = msg.map(function(message) {
                        var chatClass = message.sender_id == authUserId ? '' : 'chat-left';

                        return '<div class="chat ' + chatClass + '">' +
                            '<div class="chat-body ml-0">' +
                            '<div class="chat-content">' +
                            '<p>' + message.messages + '</p>' +
                            '<p>' + message.time + '</p>' +
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

            //fitur untuk menambahkan chat baru
            function handleNewChatMessage(data, authUserId, chatContainer) {
                // console.log(data);
                var currentTime = new Date();

                var options = {
                    hour12: true,
                    hour: '2-digit',
                    minute: '2-digit',
                    hourCycle: 'h24',
                    timeZone: 'Asia/Jakarta'
                };

                var currentTimeFormatted = currentTime.toLocaleTimeString('id-ID', options);
                var newMessage = data.chatMessage.messages;
                var chatClass = data.chatMessage.sender_id == authUserId ? ' ' : 'chat-left';
                var chatHtml = `
                                    <div class="chat ${chatClass}">
                                        <div class="chat-body ml-0">
                                            <div class="chat-content">
                                                <p>${newMessage}</p>
                                                <p>${currentTimeFormatted}</p>

                                            </div>
                                        </div>
                                    </div>`;

                // Append the new message to the chat container
                chatContainer.append(chatHtml);
            }

            //Dom apabila di klik sesuai id user akan menjalankan fungsi fetchUserChat
            $(document).on('click', '.list-contact', function() {
                var itemId = $(this).data('id');
                // console.log(itemId);
                $('#receiver_id').val(itemId);

                $.ajax({
                    type: "GET",
                    url: "/chat/" + itemId,
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);
                        var imageGroup = response.user.image_path ? 'storage/' + response
                            .user.image_path :
                            '/app-assets/images/profile-kosong.jpg';
                        $('#img-profile').attr('src', imageGroup);
                        $('#profile-name').text(response.user.name)
                        $('#profile-desc').text(response.user.desc)
                        $('#nav-group').removeClass('hidden');

                        fetchUserChat(response)

                    }
                });


            });

            //fungsi untuk mengirim pesan kepada kontak lain
            $('#create-item-form').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    type: "POST",
                    url: "/chat",
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
