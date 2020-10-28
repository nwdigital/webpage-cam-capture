<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Display Webcam Stream</title>

<style>
.container {
	margin: 0px auto;
	width: 500px;
	height: 282px;
	border: 10px #333 solid;
}
#videoElement,#video {
	width: 500px;
	height: 282px;
	background-color: #666;
}
.controller {

  margin: 25px;
  text-align: center;
}
.controller button {
  cursor: pointer;
  -webkit-appearance: none;
  padding: 15px 30px;
  background-color: rgb(54, 168, 0);
  border:none;
  color: white;
}
.controller button:hover {
  background-color: rgb(45, 136, 2);
}
</style>

</head>

<body>
<div class="container">
  <!-- Stream video via webcam -->
  <div class="video-wrap">
      <video id="video" playsinline autoplay></video>
  </div>
</div>

<!-- Trigger canvas web API -->
<div class="controller">
    <button id="snap">Capture</button>
</div>

<!-- Webcam video snapshot -->
<div class="container video-wrap">
  <canvas id="canvas" width="500" height="282"></canvas>
</div>
<a href="#" class="button" id="btn-download" download="my-file-name.png">Download</a>
<script>
// var video = document.querySelector("#videoElement");
//
// if (navigator.mediaDevices.getUserMedia) {
//   navigator.mediaDevices.getUserMedia({ video: true })
//     .then(function (stream) {
//       video.srcObject = stream;
//     })
//     .catch(function (error) {
//       console.log("Something went wrong!");
//       console.log(error);
//
//     });
// }

'use strict';

const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const snap = document.getElementById("snap");
const errorMsgElement = document.querySelector('span#errorMsg');

const constraints = {
  audio: true,
  video: {
    width: 1280, height: 720
  }
};

// Access webcam
async function init() {
  try {
    const stream = await navigator.mediaDevices.getUserMedia(constraints);
    handleSuccess(stream);
  } catch (e) {
    errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
  }
}

// Success
function handleSuccess(stream) {
  window.stream = stream;
  video.srcObject = stream;
}

// Load init
init();

// Draw image
var context = canvas.getContext('2d');
var button = document.getElementById('btn-download');
snap.addEventListener("click", function() {
	context.drawImage(video, 0, 0, 500, 282);
  var image = canvas.toDataURL("image/png");
	var png = image;
  image = image.replace('data:image/png;base64,', '');
	var dataURL = canvas.toDataURL('image/png');
    button.href = dataURL;
});

</script>
</body>
</html>
