window.history.forward();
    function noBack() {
        window.history.forward();
    }
// <body onpageshow="if (event.persisted) noBack();">


// window.addEventListener('blur',tabchange);

	function tabchange(){
		// window.location.href="./login.php";
	}

	window.onload = window.history.forward(0);
	
	function disableBackButtonAllBrowsers() {
	window.history.forward()
	}; 
	// Grab elements, create settings, etc.
var video = document.getElementById('video');


  
    // Get access to the camera!
    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        // Not adding `{ audio: true }` since we only want video now
        navigator.mediaDevices.getUserMedia({ video: true }).then(function(mediaStream) {
            //video.src = window.URL.createObjectURL(stream);
            video.srcObject = mediaStream;
            video.play();
            call();//call the capture image function 
        }).catch(function(err) {
             console.log(err.name + ": " + err.message); 
             window.location.href="http://localhost/onlineexamination/login.php";
           });;
    }
    

// Elements for taking the snapshot
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
// var video = document.getElementById('video');
// Trigger photo take



//settimeout

function call(){
  setTimeout(    
    function(){
    context.drawImage(video, 0, 0, 260, 199);
      save();
      call();
    },
    10000
    )
}


// setTimeout(function(){
//   toast();
// },5000);

function toast(){

setTimeout(function(){
      iziToast.success({
          title: 'You are under servillence',
          message: 'cant cheat in exam!!!',
          position: 'topRight'
        });
      toast();
},10000);
            
}
// document.getElementById("snap").addEventListener("click", function() {
//   context.drawImage(video, 0, 0, 640, 480);
// });


function save(){
  
  //get canvas id
  var canvas = document.getElementById('canvas');

  $.ajax({
    url : 'controller.php',
    method : 'POST',
    data : {'action':'webCamSnap',web_cam_canvas: canvas.toDataURL('img/png')},
    success : function(res) {
        
        data = JSON.parse(res);

        console.log(data);

        if(data){
          iziToast.success({
              title: 'You are under servillence',
              message: 'cant cheat in exam!!!',
              position: 'topRight'
            });  
        }
         else{
          iziToast.error({
              title: 'fail',
              message: 'record can be inserted!!!',
              position: 'topRight'
            }); 
         }       
    }
  });
}

// Converts image to canvas; returns new canvas element
function convertImageToCanvas(image) {
  var canvas = document.createElement("canvas");
  canvas.width = image.width;
  canvas.height = image.height;
  canvas.getContext("2d").drawImage(image, 0, 0);

  return canvas;
}


// Converts canvas to an image
function convertCanvasToImage(canvas) {
  var image = new Image();
  image.src = canvas.toDataURL("image/png");
  return image;
}





      // <?php echo 'Q'.$num.'.'.$row['qname'].'<br>' ;?>
      // A.&nbsp;<input type="radio"  name="q<?php echo $num ?>" value=<?php echo $row['opt1']?> ><?php echo $row['opt1']; ?>&nbsp;
      // B.&nbsp;<input type="radio" name="q<?php echo $num ?>" value=<?php echo $row['opt2']?> ><?php echo $row['opt2']; ?>&nbsp;<br>
      // C.&nbsp;<input type="radio" name="q<?php echo $num ?>" value=<?php echo $row['opt3']?> ><?php echo $row['opt3']; ?>&nbsp;
      // D.&nbsp;<input type="radio" name="q<?php echo $num ?>" value=<?php echo $row['opt4']?> ><?php echo $row['opt4']; echo "<br>" ?>