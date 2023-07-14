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
@endsection
@section('section')


    <style>
        header, footer, .main-sidebar {
            display: none;
        }
    </style>

    <section class="chattingSec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="videoBox" style="width: 100%">
{{--                        <div class="headingCont">--}}
{{--                            <h3></h3>--}}
{{--                        </div>--}}
                        <div class="videoControllers" style="z-index: 1;">
                            <a href="#" id="btn_revert_stream" data-user="" hidden><i class="fas fa-undo"></i></a>
                        </div>
                        <figure class="videoThumbMain">
                            <div id="subscriber" class="subscriber"></div>
                            <div id="publisher" class="publisher" style="border:2px solid blue;">
                                <video autoplay id="myCast"></video>
                            </div>
                        </figure>

                        <figure class="videoThumbMain" style="margin-top: 42% !important;">
                            <div id="subscriber" class="subscriber"></div>
                            <div id="publisher" class="publisher" style="border:2px solid red;">
                                <video autoplay id="broadcaster"></video>
                            </div>
                        </figure>
                    </div>

                </div>
                <div class="col-md-2">
                    <div class="video-thumbs lobby_viewers_wrapper">

                    </div>
                </div>
            </div>
            <div class="row" class="d-flex justify-content-center">
                <form action="{{route('admin.stopStream', $session->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger align-items-center">
                        <i class="fas fa-phone">End Call</i>
                    </button>
                </form>
            </div>
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
                    console.log("session_book_user" , session_book_user);
                    console.log("test id admin", id)
                    is_peer_open = true;
                    resolve(peer);
                    // alert('Peer connected. My peer ID is: ' + id);
                });
            });
        }

        const broadcasterInitPresenceChannel = ({echo, auth_id, channel_id}) => {
            console.log("in blade admin broadcasterInitPresenceChannel", echo, auth_id, channel_id)

            if (!echo || !auth_id || !channel_id) return

            console.log("Pass Condition");

            console.log(`admin-streaming-channel.${channel_id}`)
            const channel = echo.join(
                `admin-streaming-channel.${channel_id}`
            );
            console.log("channel Created", channel);

            console.log("session_book_user.id" , session_book_user , session_book_user.id)

            callingToViewer(session_book_user);
            // channel.joining((user) => {
            //     console.log('User Joined', user);
            //     callingToViewer(user.id);
            //     toastr.info(user.name + ' has joined the session.');
            //     let img_req = getUserProfilePicture(user.id);
            //     $('.lobby_viewers_wrapper')
            //         .append(`<div id="viewer-id-${user.id}">
            //                         <div class="thumbBox d-flex align-items-center" style="min-width: 286px; min-height: 250px;">
            //                             <div class="text-center" style="width: 100%;">
            //                                 <i class="fa fa-hand-paper-o text-warning" id="raised_hand_` + user.id + `" hidden></i>
            //                                 <br />
            //                                 <img src="` + img_req.responseText + `" style="background-color: white; max-width: 100px; max-height: 100px;">
            //                                 <h4 style="color:white;">` + user.name + `</h4>
            //                                 <button class="btn btn-primary btn-sm btn_allow_user_screen" id="btn_allow_user_screen_` + user.id + `" data-user="` + user.id + `" hidden>Allow screen share</button>
            //                             </div>
            //                         </div>
            //                     </div>`);
            // });
            channel.leaving((user) => {
                console.log('User Left', user);
                // console.log(user.name, "Left");
                $(`#viewer-id-${user.id}`).remove()
            });

            channel.listen('.viewer.raised.hand', (e) => {
                toastr.warning('<i class="fa fa-hand-paper-o"></i>' + e.data.customer.name + ' has raised hand.');
                $('#raised_hand_' + e.data.customer.id).prop('hidden', false);
                $('#btn_allow_user_screen_' + e.data.customer.id).prop('hidden', false);
            })

            return channel;
        }

        const customerInitPresenceChannel = ({echo, channel_id}) => {
            if (!echo || !channel_id) return

            console.log(`customerInitPresenceChannel admin-streaming-channel.${channel_id}`)
            const channel = echo.join(
                `admin-streaming-channel.${channel_id}`
            );


            return channel
        }

        const callingToViewer = (user_id) => {
            console.log("in callingToViewer blade to start call", user_id)
            if (peer && broadcaster_stream) {
                const call = peer.call('peer-course-user-' + user_id, broadcaster_stream)
                // peer.on('call', (incomingCall) => {
                //     incomingCall.answer(yourMediaStream); // Answer the call with your own stream
                //     incomingCall.on('stream', (remoteStream) => {
                //         // Handle the received remote stream
                //         showBroadcasterVideo(remoteStream);
                //     });
                // });
                call.on('stream', (viewer_streams) => {
                    console.log("in watcher viewer stream", viewer_streams)
                            showBroadcasterVideo(viewer_streams);

                })
                console.log('call senders', call)
            }
        }

        // const callingToViewer = (user_id) => {
        //     console.log("in callingToViewer blade to start call", user_id)
        //     if (peer && broadcaster_stream) {
        //         peer_calls['peer-course-user-' + user_id] = peer.call('peer-course-user-' + user_id, broadcaster_stream)
        //         let call = peer_calls['peer-course-user-' + user_id]
        //         call.on('stream', (viewer_stream) => {
        //             console.log("in watcher viewer stream", viewer_stream)
        //             viewer_streams['peer-course-user-' + user_id] = viewer_stream
        //         })
        //         console.log('call senders', peer_calls)
        //     }
        // }

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
            console.log("in showBroadcasterVideo admin blade to start call" , stream)

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

            userMediaPermission()
                .then(stream => {
                    broadcaster_stream = stream;
                    broadcaster_stream_original = stream;
                    showMyVideo(stream)
                    peerInit(auth_id).then((newPeer) => {
                        console.log("newPeer in admin", newPeer)
                        peer = newPeer;

                        console.log("Echo", window.Echo);

                        // FOR CALLING OTHERS
                        broadcasterInitPresenceChannel({echo: window.Echo, auth_id, channel_id: session_id});

                        console.log("is stream" , stream);
                    });

                })
                .catch(err => {
                    alert('Error! ' + err.message)
                })

            // on allow screen click
            // $('body').on('click', '.btn_allow_user_screen', function () {
            //     //prep data
            //     var customer_id = $(this).data('user');
            //
            //     //hide all buttons
            //     $('.btn_allow_user_screen').each(function () {
            //         $(this).prop('hidden', true);
            //     });
            //     $('#btn_revert_stream').prop('hidden', false);
            //     $('#btn_revert_stream').data('user', customer_id);
            //
            //     const viewer_stream_c = viewer_streams['peer-batch-user-' + customer_id]
            //     const [videoTrack] = viewer_stream_c.getVideoTracks();
            //     const [audioTrack] = viewer_stream_c.getAudioTracks();
            //     showMyVideo(viewer_stream_c)
            //     // const broadcaster_stream_c = broadcaster_stream
            //
            //     console.log("calls", peer_calls, videoTrack, audioTrack)
            //
            //     for (let key in peer_calls) {
            //         if (videoTrack) {
            //             const sender_video = peer_calls[key].peerConnection.getSenders().find((s) => s.track.kind === videoTrack.kind);
            //             sender_video.replaceTrack(videoTrack);
            //         }
            //         if (audioTrack) {
            //             const sender_audio = peer_calls[key].peerConnection.getSenders().find((s) => s.track.kind === audioTrack.kind);
            //             sender_audio.replaceTrack(audioTrack);
            //         }
            //     }
            //
            // });
            //
            // //on revert stream click
            // $('body').on('click', '#btn_revert_stream', function () {
            //     //prep data
            //     var customer_id = $(this).data('user');
            //
            //     //hide button
            //     $(this).prop('hidden', true);
            //
            //     const [videoTrack] = broadcaster_stream.getVideoTracks();
            //     const [audioTrack] = broadcaster_stream.getAudioTracks();
            //     // const broadcaster_stream_c = broadcaster_stream
            //     showMyVideo(broadcaster_stream)
            //
            //     console.log("calls", peer_calls, videoTrack, audioTrack)
            //
            //     for (let key in peer_calls) {
            //         if (videoTrack) {
            //             const sender_video = peer_calls[key].peerConnection.getSenders().find((s) => s.track.kind === videoTrack.kind);
            //             sender_video.replaceTrack(videoTrack);
            //         }
            //         if (audioTrack) {
            //             const sender_audio = peer_calls[key].peerConnection.getSenders().find((s) => s.track.kind === audioTrack.kind);
            //             sender_audio.replaceTrack(audioTrack);
            //         }
            //     }
            // });

        });
    </script>

@endsection
