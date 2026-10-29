$(document).ready(function () {
    
    var socket = io('https://node.notarybd.com/');
    socket.on('connect', function () {
        
    });
    socket.on('event', function (data) { });
    socket.on('disconnect', function () { });
    // getting dom elements
    var divSelectRoom = document.getElementById("selectRoom");
    var divConsultingRoom = document.getElementById("consultingRoom");
    var inputRoomNumber = document.getElementById("roomNumber");
    var btnGoRoom = document.getElementById("goRoom");
    var localVideo = document.getElementById("localVideo");
    var remoteVideo = document.getElementById("remoteVideo");
    
    // variables
    var localStream;
    var remoteStream;
    var rtcPeerConnection;
    var mediascreen;
    var bitvalue = 0;
    var recorder;
    var iceServers = {
        'iceServers': [
            { 'urls': 'stun:stun.services.mozilla.com' },
            { 'urls': 'stun:stun.l.google.com:19302' }
        ]
    }
    var streamConstraints = { audio: true, video: false };
    var isCaller;

    $("#goRoom").click(function(){
        roomNumber = inputRoomNumber.value
        next();
    }); 
    function next() {

        socket.emit('create or join', roomNumber);
    
    }

    // message handlers
    socket.on('created', function (room) {
        console.log('created');
        navigator.mediaDevices.getUserMedia({ audio: true, video: false }).then(function (stream) {
            localStream = stream;
            
            isCaller = true;
        }).catch(function (err) {
            console.log('An error ocurred when accessing media devices', err);
        });
        
    
    });

    socket.on('joined', function (room) {
        console.log('joined');
        navigator.mediaDevices.getUserMedia({ audio: true, video: false }).then(function (stream) {
            localStream = stream;
        
            socket.emit('ready', roomNumber);
        }).catch(function (err) {
            console.log('An error ocurred when accessing media devices', err);
        });
    });

    socket.on('candidate', function (event) {
        var candidate = new RTCIceCandidate({
            sdpMLineIndex: event.label,
            candidate: event.candidate
        });
        rtcPeerConnection.addIceCandidate(candidate);
    });

    socket.on('ready', function () {
        if (isCaller) {
            rtcPeerConnection = new RTCPeerConnection(iceServers);
            rtcPeerConnection.onicecandidate = onIceCandidate;
            rtcPeerConnection.ontrack = onAddStream;
            rtcPeerConnection.addTrack(localStream.getTracks()[0], localStream);            
        
            rtcPeerConnection.createOffer()
                .then(sessionDescription => {
                    rtcPeerConnection.setLocalDescription(sessionDescription);
            socket.emit('offer', {
                type: 'offer',
                sdp: sessionDescription,
                room: roomNumber
            });
        })
        .catch(error => {
            console.log(error)
        })
    }
    });

socket.on('offer', function (event) {
    if (!isCaller) {
        rtcPeerConnection = new RTCPeerConnection(iceServers);
        rtcPeerConnection.onicecandidate = onIceCandidate;
        rtcPeerConnection.ontrack = onAddStream;
        rtcPeerConnection.addTrack(localStream.getTracks()[0], localStream);
        
        rtcPeerConnection.setRemoteDescription(new RTCSessionDescription(event));
        rtcPeerConnection.createAnswer()
            .then(sessionDescription => {
                rtcPeerConnection.setLocalDescription(sessionDescription);
        socket.emit('answer', {
            type: 'answer',
            sdp: sessionDescription,
            room: roomNumber
        });
    })
    .catch(error => {
        console.log(error)
    })
}
});

socket.on('answer', function (event) {
    rtcPeerConnection.setRemoteDescription(new RTCSessionDescription(event));
})

// handler functions
function onIceCandidate(event) {
    if (event.candidate) {
        console.log('sending ice candidate');
        socket.emit('candidate', {
            type: 'candidate',
            label: event.candidate.sdpMLineIndex,
            id: event.candidate.sdpMid,
            candidate: event.candidate.candidate,
            room: roomNumber
        })
    }
}

function onAddStream(event) {
    console.log(isCaller);
    document.getElementById("remoteVideo").srcObject = event.streams[0];
            
    
}



});