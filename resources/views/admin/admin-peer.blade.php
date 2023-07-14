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
                    <div id="publisher" class="publisher">
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

    {{--    additional js--}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
            integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.0/echo.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    {{--        <script src="{{asset('js/video-streaming-utils.js')}}"></script>--}}
    <script>
        let peer = null;
        let broadcaster_stream = null;
        let session_book_user = '{{$booked_session_user->id}}';
        let auth_id = '{{\Illuminate\Support\Facades\Auth::id()}}';

        $(document).ready(function() {
            userMediaPermission()
                .then(stream => {
                    broadcaster_stream = stream;
                    showMyVideo(stream);
                    peerInit(auth_id).then(newPeer => {
                        peer = newPeer;
                        console.log("Admin Peer initialized", peer);
                    });
                })
                .catch(err => {
                    alert('Error! ' + err.message);
                });
        });

        const peerInit = (auth_id) => {
            return new Promise(resolve => {
                const peer = new Peer('peer-course-user-' + auth_id, {
                    path: "/peerjs",
                    host: "/",
                    port: "3008",
                });

                peer.on('open', function(id) {
                    console.log("Admin Peer ID:", id);
                    resolve(peer);
                });

                peer.on('error', function(error) {
                    console.error('Admin Peer Error:', error);
                });
            });
        }

        const startCallToUser = () => {
            const call = peer.call(session_book_user, broadcaster_stream);
            console.log("Admin Call started to user:", session_book_user);

            call.on('stream', function(remoteStream) {
                console.log("Admin Received user stream:", remoteStream);
                showBroadcasterVideo(remoteStream);
            });

            call.on('close', function() {
                console.log("Admin Call ended");
                // Perform any necessary cleanup or display a call ended message
            });

            call.on('error', function(error) {
                console.error('Admin Call Error:', error);
            });
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
                console.log("in showMyVideo admin blade to start call", stream)

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
                console.log("in showBroadcasterVideo admin blade to start call", stream)

                const broadcaster = document.getElementById('broadcaster')
                if (broadcaster) {
                    broadcaster.srcObject = stream
                    broadcaster.addEventListener("loadedmetadata", () => {
                        // broadcaster.value.controls = true
                        broadcaster.play();
                    })
                }
            }

        function handleCallClose() {
            // Perform any necessary cleanup or display a call ended message
            alert('Call ended');
        }

        {{--</script>--}}

        {{--<script>--}}
        {{--    let auth_id = '{{\Illuminate\Support\Facades\Auth::id()}}';--}}
        {{--    let session_id = '{{ $session->id }}';--}}
        {{--    let avatar_image_url = '{{asset('images/avatar.png')}}';--}}

        {{--    $(document).ready(function () {--}}
        {{--        //establish session_id, session_id, token--}}

        {{--        userMediaPermission()--}}
        {{--            .then(stream => {--}}
        {{--                broadcaster_stream = stream;--}}
        {{--                broadcaster_stream_original = stream;--}}
        {{--                showMyVideo(stream)--}}
        {{--                peerInit(auth_id).then((newPeer) => {--}}
        {{--                    console.log("newPeer in admin", newPeer)--}}
        {{--                    peer = newPeer;--}}

        {{--                    console.log("Echo", window.Echo);--}}

        {{--                    // FOR CALLING OTHERS--}}
        {{--                    broadcasterInitPresenceChannel({echo: window.Echo, auth_id, channel_id: session_id});--}}

        {{--                    console.log("is stream", stream);--}}
        {{--                });--}}

        {{--            })--}}
        {{--            .catch(err => {--}}
        {{--                alert('Error! ' + err.message)--}}
        {{--            })--}}

        {{--    });--}}

        {{--    // Handle errors--}}
        {{--    localPeer.on('error', handleError);--}}

        {{--    // Function to handle incoming calls--}}
        {{--    function handleIncomingCall(call) {--}}
        {{--        // Answer the incoming call--}}
        {{--        call.answer(null); // You can pass a stream as the parameter--}}

        {{--        // Handle the call events--}}
        {{--        call.on('stream', handleRemoteStream); // Handle the remote stream once it's received--}}
        {{--        call.on('close', handleCallClose); // Handle the call closure--}}
        {{--    }--}}

        {{--    // Function to handle the remote stream--}}
        {{--    function handleRemoteStream(stream) {--}}
        {{--        // Display the remote stream (e.g., play it in a video element)--}}
        {{--        const videoElement = document.getElementById('remoteVideo');--}}
        {{--        videoElement.srcObject = stream;--}}
        {{--    }--}}

        {{--    // Function to handle call closure--}}
        {{--    function handleCallClose() {--}}
        {{--        // Perform any necessary cleanup or display a call ended message--}}
        {{--        console.log('Call ended');--}}
        {{--    }--}}

        {{--    // Function to handle errors--}}
        {{--    function handleError(error) {--}}
        {{--        // Handle any errors that occur during the call--}}
        {{--        console.error('Error:', error);--}}
        {{--    }--}}

    </script>


@endsection
