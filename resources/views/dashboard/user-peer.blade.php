@extends('dashboard.layouts.app')

@section('title', 'Dashboard')
@section('description', '')
@section('keywords', '')

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
@endsection


@section('content')

    <style>
        header, footer, .sideNAvigation {
            display: none;
        }
    </style>

    <section class="chattingSec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="videoBox" style="width: 100%">
                        {{--                        <div class="headingCont">--}}
                        {{--                            <h3></h3>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="videoControllers" style="z-index: 1;">--}}
                        {{--                            <a href="#" id="btn_revert_stream" data-user="" hidden><i class="fas fa-phone"></i></a>--}}
                        {{--                        </div>--}}
                        <figure class="videoThumbMain">
                            <div class="class_ended_wrapper"
                                 style="width: 100%; height: 100%; position: absolute; background-color: black;" hidden>
                                <h1 class="text-center"
                                    style="right: 50%; bottom: 50%; transform: translate(50%,50%); position: absolute; color:white;">
                                    Class Ended
                                </h1>
                            </div>
                            <div id="subscriber" class="subscriber"></div>
                            <div id="publisher" class="publisher">
                                <video autoplay id="broadcaster"></video>
                            </div>
                        </figure>

                        <figure class="videoThumbMain">
                            <div class="class_ended_wrapper"
                                 style="width: 100%; height: 100%; position: absolute; background-color: black;" hidden>
                                <h1 class="text-center"
                                    style="right: 50%; bottom: 50%; transform: translate(50%,50%); position: absolute; color:white;">
                                    Class Ended
                                </h1>
                            </div>
                            <div id="subscriber" class="subscriber"></div>
                            <div id="publisher" class="publisher" style="border:2px solid red !important;">
                                <video autoplay id="myCast"></video>
                            </div>
                        </figure>
                        <form action="{{route('admin.stopStream', $session->id)}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-phone">End Call</i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-md-1"></div>

                {{--                <div class="col-md-2">--}}
                {{--                    <div class="video-thumbs lobby_viewers_wrapper">--}}
                {{--                        <main class="container py-4">--}}
                {{--                            <button class="btn btn-primary btn-block" id="btn_raise_hand"><i class="fa fa-hand-paper-o"></i></button>--}}
                {{--                        </main>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div>
    </section>

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
        let viewer_stream = null;
        let auth_id = '{{\Illuminate\Support\Facades\Auth::id()}}';

        $(document).ready(function() {
            userMediaPermission()
                .then(stream => {
                    viewer_stream = stream;
                    showMyVideo(stream);
                    peerInit(auth_id).then(newPeer => {
                        peer = newPeer;
                        console.log("User Peer initialized", peer);
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
                    console.log("User Peer ID:", id);
                    resolve(peer);
                });

                peer.on('error', function(error) {
                    console.error('User Peer Error:', error);
                });

                peer.on('call', function(call) {
                    console.log("User Incoming call from admin:", call);
                    call.answer(viewer_stream);

                    call.on('stream', function(remoteStream) {
                        console.log("User Received admin stream:", remoteStream);
                        showBroadcasterVideo(remoteStream);
                    });

                    call.on('close', function() {
                        console.log("User Call ended");
                        // Perform any necessary cleanup or display a call ended message
                    });

                    call.on('error', function(error) {
                        console.error('User Call Error:', error);
                    });
                });
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


    </script>
@endsection
