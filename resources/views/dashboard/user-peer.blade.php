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

    <section class="chattingSec" id="parentSection">
        <div class="videoBox">
            <figure class="videoThumbMain">
                <div class="class_ended_wrapper">

                </div>
                <div id="subscriber" class="subscriber"></div>
                <div id="publisher" class="publisher">
                    <video autoplay id="broadcaster"></video>
                </div>
            </figure>

            <figure class="videoThumbMain myCast">
                <div class="class_ended_wrapper">

                </div>
                <div id="subscriber" class="subscriber"></div>
                <div id="publisher" class="publisher">
                    <video autoplay id="myCast"></video>
                </div>
            </figure>
        </div>
    </section>

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
        let peer_calls = {};
        let broadcaster_stream = null;
        let broadcaster_stream_original = null;
        let is_peer_open = false;
        let viewer_streams = null;
        {{--let session_book_user = '{{$booked_session_user->id}}';--}}

        const peerInit = (auth_id) => {

            return new Promise(resolve => {
                const peer = new Peer('peer-course-user-' + auth_id, {
                    path: "/peerjs",
                    host: "/",
                    port: "3008",
                });
                //when peer is opened
                peer.on('open', function (id) {
                    // console.log("session_book_user", session_book_user);
                    console.log("test id admin", id)
                    is_peer_open = true;
                    resolve(peer);
                    // alert('Peer connected. My peer ID is: ' + id);
                });
                peer.on('close', () => {
                    // Perform actions when the peer connection is closed
                    alert('Peer connection closed');
                    console.log('Peer connection User 3');

                    // Add your custom code here
                });

            });
        }

        const broadcasterInitPresenceChannel = ({echo, auth_id, channel_id}) => {
            console.log("in blade admin broadcasterInitPresenceChannel", echo, auth_id, channel_id)

            if (!echo || !auth_id || !channel_id) return

            console.log("Pass Condition");

            console.log(`streaming-channel.${channel_id}`)
            const channel = echo.join(
                `streaming-channel.${channel_id}`
            );
            console.log("channel Created", channel);

            // console.log("session_book_user.id", session_book_user)

            callingToViewer(2);

            return channel;
        }

        const customerInitPresenceChannel = ({echo, channel_id}) => {
            if (!echo || !channel_id) return

            const channel = echo.join(
                `streaming-channel.${channel_id}`
            );


            return channel
        }

        const callingToViewer = (user_id) => {
            console.log("in callingToViewer blade to start call", user_id)
            if (peer && broadcaster_stream) {
                const call = peer.call('peer-course-user-' + user_id, broadcaster_stream)
                console.log("call", call);

                peer.on('close', () => {
                    // Perform actions when the peer connection is closed
                    alert('Peer connection closed');
                    console.log('Peer connection User 2');

                    // Add your custom code here
                });


                call.on('stream', (viewer_streams) => {
                    console.log("in watcher viewer stream", viewer_streams)
                    showBroadcasterVideo(viewer_streams);

                })
                console.log('call senders', call)

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

        const getUserProfilePicture = (user_id) => {
            return $.ajax({
                type: 'POST',
                url: '{{route("getUserProfilePicture")}}',
                data: {
                    _token: '{{csrf_token()}}',
                    user_id: user_id
                },

            });
        }
    </script>

    <script>
        let auth_id = '{{\Illuminate\Support\Facades\Auth::id()}}';
        let session_id = '{{ $session->id }}';
        let avatar_image_url = '{{asset('images/avatar.png')}}';

        $(document).ready(function () {
            //establish session_id, session_id, token
            console.log("THIS IS SESSION ID", session_id)
            userMediaPermission()
                .then(stream => {
                    broadcaster_stream = stream;
                    broadcaster_stream_original = stream;
                    showMyVideo(stream)
                    peerInit(auth_id).then((newPeer) => {
                        console.log("newPeer in admin", newPeer)
                        peer = newPeer;
                        peer.on('close', () => {
                            // Perform actions when the peer connection is closed
                            alert('Peer connection closed');
                            console.log('Peer connection User 1');
                            // Add your custom code here
                        });
                        console.log("Echo", window.Echo);

                        // FOR CALLING OTHERS
                        broadcasterInitPresenceChannel({echo: window.Echo, auth_id, channel_id: session_id});

                        console.log("is stream", stream);
                    });
                    let channel = customerInitPresenceChannel({echo: window.Echo, channel_id: session_id});


                })
                .catch(err => {
                    alert('Error! ' + err.message)
                })

            // window.Echo.join(`streaming-channel.${session_id}`)
            //     .listen('.StopStreaming', (e) => {
            //         // Handle the received notification data
            //         alert("Stop In Listen");
            //         toastr.success(e.message);
            //         console.log("eee", e)
            //
            //     })


        });
    </script>

    <script>
        // If not subscibe channel remove documnet ready
        //         $(document).ready(function () {

        console.log("listen 1")

        // Listen for the "StopStreaming" event on the user side
        const presenceChannel = window.Echo.join(`streaming-channel.${session_id}`);
        presenceChannel.listen('.StopStreaming', (data) => {
            console.log('Call closed BY PRESENCE');

            // Your new HTML content to be appended
            var newHTML = `
              <div id="overlay">
                  <div class="content">
                    <h2>Admin Ended The Streaming</h2>
                    <a href="{{ route('user.dashboard') }}">Go Back</a>
                  </div>
               </div>
            `;

            // Identify the target element by its ID
            var targetElement = $("#parentSection");

            // Empty the current content of the target element
            targetElement.empty();

            // Append the new HTML content to the target element
            targetElement.append(newHTML);
        });
        console.log('Call closed');


    </script>



@endsection
