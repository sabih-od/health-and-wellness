@extends('admin.layouts.app')
@section('title', 'Services')
@section('page_css')
    {{--additional css--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
          integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
        id="favicon"
        rel="icon"
        href="https://tokbox.com/developer/favicon.ico"
        type="image/x-icon"
    />

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="{{asset('admin/stream/style.css')}}"/>
    {{--    <style>--}}
    {{--        .publisher{--}}
    {{--            /*width: 100%;*/--}}
    {{--            border:2px solid green--}}
    {{--        }--}}
    {{--.wrapper{--}}
    {{--    height:100vh;--}}
    {{--    min--}}
    {{--}--}}
    {{--    </style>--}}
@endsection
@section('section')


    <style>
        .main-header, footer, .main-sidebar {
            display: none;
        }
    </style>

    {{--    <section class="chattingSec">--}}
    <div class="container mt-5" style="height:100vh !important;">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <div class="col-md-10">
                    <div class="videoBox" style="width: 100%">
                        <figure class="videoThumbMain">
                            <div id="subscriber" class="subscriber"></div>
                            <div id="publisher" class="publisher">
                                <video autoplay id="broadcaster" style="width: 100%"></video>
                            </div>
                        </figure>
                    </div>
                </div>

                <div class="row ml-5" class="d-flex justify-content-center">
                    <form action="{{route('admin.stopStream', $session->id)}}" method="POST">
                        @csrf
                        <button id="end-call-button" type="submit" class="btn btn-danger align-items-center">
                            <i class="fas fa-phone ml-2">End Call</i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <figure class="videoThumbMain">
                    <div id="subscriber" class="subscriber"></div>
                    <div id="publisher" class="publisher" >
                        <video autoplay id="myCast" style="width: 100%"></video>
                    </div>
                </figure>
            </div>
        </div>

    </div>
    {{--    </section>--}}
@endsection

@section('script')
    <script src="https://unpkg.com/peerjs@1.4.7/dist/peerjs.min.js"></script>
    <script src="{{asset('js/app.js')}}"></script>

    {{--additional js--}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
            integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{--    <script src="{{asset('js/video-streaming-utils.js')}}"></script>--}}
    <script>
        let peer = null;
        let peer_calls = {};
        let broadcaster_stream = null;
        let broadcaster_stream_original = null;
        let is_peer_open = false;
        let viewer_streams = [];
        let session_book_user = '{{$booked_session_user->id}}';

        const peerInit = (auth_id) => {

            return new Promise(resolve => {
                const peer = new Peer('peer-course-user-' + auth_id, {
                    path: "/peerjs",
                    host: "/",
                    port: "3008",
                });

                //when peer is opened
                peer.on('open', function (id) {
                    console.log("test id in blade", id)
                    is_peer_open = true;
                    resolve(peer);
                    // alert('Peer connected. My peer ID is: ' + id);
                });
            });
        }

        const broadcasterInitPresenceChannel = ({echo, auth_id, channel_id}) => {
            console.log("in broadcasterInitPresenceChannel" , echo, auth_id, channel_id)
            if (!echo || !auth_id || !channel_id) return


            console.log(`streaming-channel.${channel_id}`)
            const channel = echo.join(
                `streaming-channel.${channel_id}`
            );

            callingToViewer(session_book_user);

            channel.joining((user) => {
                console.log('User Joined', user);
                callingToViewer(user.id);
                toastr.info(user.name + ' has joined the session.');
                let img_req = getUserProfilePicture(user.id);
                $('.lobby_viewers_wrapper')
                    .append(`<div id="viewer-id-${user.id}">
                                    <div class="thumbBox d-flex align-items-center" style="min-width: 286px; min-height: 250px;">
                                        <div class="text-center" style="width: 100%;">
                                            <i class="fa fa-hand-paper-o text-warning" id="raised_hand_` + user.id + `" hidden></i>
                                            <br />
                                            <img src="`+img_req.responseText+`" style="background-color: white; max-width: 100px; max-height: 100px;">
                                            <h4 style="color:white;">` + user.name + `</h4>
                                            <button class="btn btn-primary btn-sm btn_allow_user_screen" id="btn_allow_user_screen_` + user.id + `" data-user="` + user.id + `" hidden>Allow screen share</button>
                                        </div>
                                    </div>
                                </div>`);
            });
            channel.leaving((user) => {
                console.log('User Left', user);
                // console.log(user.name, "Left");
                $(`#viewer-id-${user.id}`).remove()
            });

            return channel;
        }

        const customerInitPresenceChannel = ({echo, channel_id}) => {
            console.log("in customerInitPresenceChannel user", echo, channel_id)
            if (!echo || !channel_id) return

            console.log(`streaming-channel.${channel_id}`)
            const channel = echo.join(
                `streaming-channel.${channel_id}`
            );


            return channel
        }

        const callingToViewer = (user_id) => {
            console.log("in callingToViewer user" , user_id)

            if (peer && broadcaster_stream) {
                peer_calls['peer-course-user-' + user_id] = peer.call('peer-course-user-' + user_id, broadcaster_stream)
                let call = peer_calls['peer-course-user-' + user_id]
                call.on('stream', (viewer_stream) => {
                    console.log("in watcher viewer stream", viewer_stream)
                    viewer_streams['peer-course-user-' + user_id] = viewer_stream
                })
                console.log('call senders', peer_calls)
            }
        }

        const userMediaPermission = () => {
            // Older browsers might not implement mediaDevices at all, so we set an empty object first
            if (navigator.mediaDevices === undefined) {
                navigator.mediaDevices = {};
            }

            // Some browsers partially implement media devices. We can't just assign an object
            // with getUserMedia as it would overwrite existing properties.
            // Here, we will just add the getUserMedia property if it's missing.
            if (navigator.mediaDevices.getUserMedia === undefined) {
                navigator.mediaDevices.getUserMedia = function (constraints) {
                    // First get ahold of the legacy getUserMedia, if present
                    const getUserMedia =
                        navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

                    // Some browsers just don't implement it - return a rejected promise with an error
                    // to keep a consistent interface
                    if (!getUserMedia) {
                        return Promise.reject(
                            new Error("getUserMedia is not implemented in this browser")
                        );
                    }

                    // Otherwise, wrap the call to the old navigator.getUserMedia with a Promise
                    return new Promise((resolve, reject) => {
                        getUserMedia.call(navigator, constraints, resolve, reject);
                    });
                };
            }
            navigator.mediaDevices.getUserMedia =
                navigator.mediaDevices.getUserMedia ||
                navigator.webkitGetUserMedia ||
                navigator.mozGetUserMedia;

            return new Promise((resolve, reject) => {
                navigator.mediaDevices
                    .getUserMedia({video: true, audio: true})
                    .then(stream => {
                        resolve(stream);
                    })
                    .catch(err => {
                        reject(err);
                        //   throw new Error(`Unable to fetch stream ${err}`);
                    });
            });
        }

        const showMyVideo = (stream) => {
            console.log("in showMyVideo user", stream)

            const myCast = document.getElementById('myCast')
            if (myCast) {
                myCast.srcObject = stream
                myCast.muted = true
                myCast.addEventListener("loadedmetadata", () => {
                    // myCast.value.controls = true
                    myCast.play();
                })
            }
        }

        const showBroadcasterVideo = (stream) => {
            console.log("in showBroadcasterVideo user", stream)
            const broadcaster = document.getElementById('broadcaster')
            if (broadcaster) {
                broadcaster.srcObject = stream
                broadcaster.addEventListener("loadedmetadata", () => {
                    // broadcaster.value.controls = true
                    broadcaster.play();
                })
            }
        }

        const getUserProfilePicture = (user_id) => {
            return $.ajax({
                type: 'POST',
                url: '{{route("getUserProfilePicture")}}',
                data: {
                    _token: '{{csrf_token()}}',
                    user_id: user_id
                },
                // success:function(data) {
                //     return data;
                // }
            });
        }
    </script>
    <script>
        let auth_id = '{{\Illuminate\Support\Facades\Auth::id()}}';
        let session_id = '{{ $session->id }}';
        let avatar_image_url = '{{asset('images/avatar.png')}}';

        $(document).ready(function () {

            userMediaPermission()
                .then(stream => {
                    console.log("In User", stream)
                    broadcaster_stream = stream;
                    showMyVideo(stream)
                    peerInit(auth_id).then((newPeer) => {
                        console.log("auth_id", auth_id)
                        console.log("newPeer", newPeer)
                        peer = newPeer;
                        console.log("is stream", stream);

                        peer.on("call", (call) => {
                            console.log("onCall", call.peer)
                            call.answer(stream);
                            // // const video = document.createElement("audio");
                            call.on("stream", (broadcaster_stream) => {
                                console.log("in watcher broadcaster_stream", broadcaster_stream)
                                showBroadcasterVideo(broadcaster_stream)
                                // addVideoStream(video, userVideoStream, call.peer);
                            });
                        });
                        let channel = customerInitPresenceChannel({echo: window.Echo, channel_id: session_id});
                        channel.listen('StopStreaming', () => {
                            peer.disconnect();
                            console.log("IN STOP STREAM @")
                            alert("The Call Has Been Closed");
                            // Close video/audio streams
                            // yourVideoStream.getTracks().forEach(track => track.stop());
                            // Disconnect from the signaling server
                            // window.close();
                        });
                    });

                })
                .catch(err => {
                    alert('Error! ' + err.message)
                })

        });
    </script>
@endsection


