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
    <div class="container">
        <div class="videoBox">
            <figure class="videoThumbMain">
                <div id="subscriber" class="subscriber"></div>
                <div id="publisher" class="publisher">
                    <video autoplay id="broadcaster" style="width: 100%"></video>
                </div>
            </figure>
        </div>
        <form action="{{route('admin.stopStream', $session->id)}}" method="POST">
            @csrf
            <button id="end-call-button" type="submit" class="btn btn-danger align-items-center">
                <i class="fas fa-phone ml-2">End Call</i>
            </button>
        </form>
        <figure class="videoThumbMain">
            <div id="subscriber" class="subscriber"></div>
            <div id="publisher" class="publisher" >
                <video autoplay id="myCast"></video>
            </div>
        </figure>

    </div>
    {{--    </section>--}}
@endsection

@section('script')
    <script src="https://unpkg.com/peerjs@1.4.7/dist/peerjs.min.js"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

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

            return channel;
        }

        const customerInitPresenceChannel = ({echo, channel_id}) => {
            console.log("in customerInitPresenceChannel user", echo, channel_id)
            if (!echo || !channel_id) return

            const channel = echo.join(
                `streaming-channel.${channel_id}`
            );
            console.log("channel Joined Admin" , channel);

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
                            console.log("STOP STREAM");
                            alert("STOP STREAM");
                        });
                    });

                })
                .catch(err => {
                    alert('Error! ' + err.message)
                })


            // Event listener for "End Call" button
            $('#end-call-button').click(function (e) {
                endCall();
            });

            // Function to end the call
            function endCall() {
                // Close the peer connection
                if (peer) {
                    peer.close();
                }

                // Stop the broadcaster stream
                if (broadcaster_stream) {
                    broadcaster_stream.getTracks().forEach(track => track.stop());
                }

                // Show "Call ended" alert
                toastr.success('Call Successfully Ended');


                if (window.Echo && session_id) {
                    window.Echo.private(`streaming-channel.${session_id}`)
                        .whisper('StopStreaming', { message: 'Call successfully ended' });
                }
                // Optionally, you can redirect the user to another page or perform any other necessary actions.
            }

        });
    </script>



@endsection


