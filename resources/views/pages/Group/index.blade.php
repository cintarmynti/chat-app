@extends('layouts.default')

@push('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/selects/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/forms/selects/select2.min.css') }}">
    <style>
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

        .chats {
            margin-top: 50px;
            /* Menambahkan margin atas pada .chats untuk menghindari tumpang tindih dengan .nav-group */
        }

        .icon:hover {
            color: white;
        }

        .select2-container--default .select2-selection--multiple{
            width: 450px;
        }

        .select2-container--default .select2-results>.select2-results__options{
            width: 450px;
        }

        .select2-container--open .select2-dropdown--below{
            width: 450px !important;
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
                        <input type="text" class="form-control" id="inputPencarian" placeholder="Search Group">
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
                                <img class="media-object rounded-circle" id="img-group"
                                    src="/app-assets/images/group-none.jpeg" alt="Generic placeholder image">
                                <i></i>
                            </span>
                        </div>
                        <div class="align-self-center">
                            <h4 id="group-name"></h4>
                            <i class="ft-eye mr-2 icon" id="lihatAnggota" data-toggle="modal" data-target="#p"></i>
                            <i class="ft-edit mr-2 icon" id="editGroup" data-toggle="modal" data-target="#editGrup1"></i>
                            <i class="ft-plus-square mr-2 icon" id="addMember" data-toggle="modal"
                                data-target="#addAnggota"></i>


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


    {{-- modal list anggota --}}
    <!-- Modal -->
    <div class="modal fade" id="p" tabindex="-1" role="dialog" aria-labelledby="pLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pLabel">Anggota Grup</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body conten-anggota">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    {{-- modal Edit anggota --}}
    <!-- Modal -->
    <div class="modal fade" id="editGrup1" tabindex="-1" role="dialog" aria-labelledby="editGrup1Label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGrup1Label">Edit Grup</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('group.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <fieldset class="form-group">
                            <label for="basicInput">Group Name</label>
                            <input type="text" name="group_name" class="form-control input1" id="basicInput">
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="basicInput">desc</label>
                            <input type="text" name="desc" class="form-control input2" id="basicInput">
                        </fieldset>
                        <input type="hidden" name="id" class="form-control input4" id="basicInput">
                        <fieldset class="form-group">
                            <label for="basicInput">image</label>
                            <input type="file" name="image_file" class="form-control input3" id="basicInput">
                        </fieldset>
                        <img src="" id="image_edit" width="100" height="100" alt="">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>

                </div>
                </form>

            </div>
        </div>
    </div>


    {{-- modal menambah anggota --}}
    <!-- Modal -->
    <div class="modal fade" id="addAnggota" tabindex="-1" role="dialog" aria-labelledby="addAnggotaLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAnggotaLabel">Tambah Anggota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('group.storeMember')}}" method="POST">
                        @csrf
                        <input type="hidden" name="group_id" id="GrupId">
                        <div class="form-group">
                            <select name="anggota[]" class="select2 form-control" multiple="multiple">
                                {{-- ini isi option  --}}
                            </select>
                          </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>


            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/select/form-select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>

    <script>
        // ini untuk pusher nya
        var pusher = new Pusher('32a5a870d066ac495f8c', {
            cluster: 'ap1'
        });

        $(document).ready(function() {
            // $('#addAnggota').on('shown.bs.modal', function() {
            //     $('#select2Element').select2();
            // });
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            fetchItems();

            //menampilkan list group
            function fetchItems() {
                $.ajax({
                    method: 'GET',
                    dataType: 'json',
                    url: "/group-list",
                    success: function(response) {
                        //    console.log(response);
                        var items = response.data;

                        var itemHtmlArray = items.map(function(item) {
                            var imageUrl = item.image_group ? 'storage/' + item.image_group :
                                '/app-assets/images/group-none.jpeg';

                            var htmlContent =
                                '<a href="#" class="list-contact media border-0 edit-item" data-id="' +
                                item.group_id + '" data-nama="' + item.group_name + '">' +
                                '<div class="media-left pr-1">' +
                                '<span class="avatar avatar-md avatar-online">' +
                                '<img class="media-object rounded-circle" src="' + imageUrl +
                                '" alt="Generic placeholder image"><i></i>' +
                                '</span>' +
                                '</div>' +
                                '<div class="media-body w-100">' +
                                '<h6 class="list-group-item-heading">' + item.group_name +
                                // Perbaikan: Mengganti item.name menjadi item.group_name
                                '<span class="font-small-3 float-right primary">' + item
                                .last_chat_time + '</span>' +
                                '</h6>' +
                                '<p class="list-group-item-text text-muted mb-0"><i class="ft-check primary font-small-2"></i>' +
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

            //menampilkan isi chat
            function fetchhGroupChat(messages) {
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

                        return `
                        <div class="chat ${chatClass}">
                            <div class="chat-body">
                            <div class="chat-content">
                                <p>
                                <span class="sender-name">${message.users.name}</span><br>
                                ${message.content}
                                <span class="sent-time">${message.format_created_at}</span>
                                </p>
                            </div>
                            </div>
                        </div>
                        `;
                    }).join(''); // Join the array into a single string

                    // Set the HTML content of the chat container
                    chatContainer.html(chatHtml);
                } else {
                    console.error('Invalid or missing messages array:', msg);
                }
            }

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

            function handleNewChatMessage(data, authUserId, chatContainer) {
                // console.log(data);
                var newMessage = data.chatMessage.content;
                var chatClass = data.chatMessage.sender_id == authUserId ? ' ' : 'chat-left';
                var senderName = data.chatMessage.users.name;
                var chatHtml = `
                <div class="chat ${chatClass}">
                            <div class="chat-body">
                            <div class="chat-content">
                                <p>
                                <span class="sender-name">${senderName}</span><br>
                                ${newMessage}
                                <span class="sent-time">12.20</span>
                                </p>
                            </div>
                            </div>
                        </div>`;

                // Append the new message to the chat container
                chatContainer.append(chatHtml);
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
                        var imageGroup = response.group_id.image_group ? 'storage/' + response
                            .group_id.image_group :
                            '/app-assets/images/group-none.jpeg';
                        $('#img-group').attr('src', imageGroup);

                        $('#group-name').text(response.group_id.group_name)
                        $('#nav-group').removeClass('hidden');
                        $('#lihatAnggota').data('anggota', itemId);
                        $('#editGroup').data('edit', itemId);
                        $('#addMember').data('addMember', itemId);
                        fetchhGroupChat(response);
                    }
                });
            });

            // ketika klik icon mata
            $(document).on('click', '.ft-eye', function() {
                var memberId = $(this).data('anggota');

                $.ajax({
                    type: "GET",
                    url: "/group-member/" + memberId,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        var imageExist = 'http://127.0.0.1:8000/storage/';
                        var imageNull =
                            'http://127.0.0.1:8000/app-assets/images/profile-kosong.jpg'

                        // Assuming you have a container element to display the dynamic content
                        var container = $('.conten-anggota');

                        // Clear the container content before adding new content
                        container.empty();

                        $.each(response.data, function(index, item) {
                            var imageUrl = item.users.image_path ? imageExist + item
                                .users.image_path : imageNull;

                            // Create HTML string for each user
                            var newContent =
                                '<a href="#" class="media border-0 my-1" >' +
                                '<div class="media-left pr-1">' +
                                '<span class="avatar avatar-md avatar-online">' +
                                '<img class="media-object rounded-circle" src="' +
                                imageUrl +
                                '" alt="Generic placeholder image">' +
                                '<i></i>' +
                                '</span>' +
                                '</div>' +
                                '<div class="media-body w-100">' +
                                '<h6 class="list-group-item-heading">' + item.users
                                .name + '</h6>' +
                                '<p class="list-group-item-text text-muted mb-0">' +
                                item.users.desc +
                                '<span class="float-right primary list-member" data-group_id="'+ item.group_id +'" data-user_id="'+ item.users.id +'"><i class="font-medium-1 ft-x-square text-danger lighten-3"></i></span> </p>' +
                                '</div>' +
                                '</a>';

                            // Set the HTML content of the container
                            container.html(container.html() + newContent);
                        });
                    }
                });

            });

            $(document).on('click', '.float-right.primary.list-member', function() {
                console.log("hai");
                var user_id = $(this).data("user_id");
                var group_id = $(this).data("group_id");
                $(".float-right.primary.list-member").on("click", function(){
                    $(this).closest("a").remove();
                });


                $.ajax({
                    type: "POST",
                    url: "/group-kick",
                    data: {user_id: user_id, group_id:group_id, _token: $('meta[name="csrf-token"]').attr('content') },
                    success: function (response) {
                        // console.log(response);
                    },
                    error: function(xhr, status, error){
                        console.log(error)
                    }
                });

            });

            // ketika klik icon edit
            $(document).on('click', '.ft-edit', function() {
                var editId = $(this).data('edit');

                $.ajax({
                    type: "GET",
                    url: "/group/" + editId,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        $('.input1').val(response.group_id.group_name)
                        $('.input2').val(response.group_id.desc)
                        $('.input4').val(response.group_id.id)
                        var imageGroup = response.group_id.image_group ? 'storage/' + response
                            .group_id.image_group :
                            '/app-assets/images/group-none.jpeg';
                        $('#image_edit').attr('src', imageGroup);

                    }
                });

            });

            // ketika click icon tambah
            $(document).on('click', '.ft-plus-square', function() {
                var addMemberId = $(this).data('addMember');
                // console.log('masuk');
                $.ajax({
                    type: "GET",
                    url: "/group-nonmember/" + addMemberId,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        $('#GrupId').val(addMemberId);

                        var selectElement = $('.select2.form-control')
                        var optionsHTML = '';

                        $.each(response.nonMember, function(index, option){
                            optionsHTML += '<option value="' + option.id + '">'+ option.name +'</option>'
                        });

                        selectElement.html(optionsHTML);
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
