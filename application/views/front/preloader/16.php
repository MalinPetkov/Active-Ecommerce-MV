

<style>
#loading-center{
	width: 100%;
	height: 100%;
	position: relative;
	}
#loading-center-absolute {
	position: absolute;
	left: 50%;
	top: 50%;
	height: 50px;
	width: 50px;
	margin-top: -25px;
	margin-left: -25px;
}
.object{
	width: 50px;
	height: 5px;
	background-color: <?php echo $preloader_obj; ?>;
	-webkit-animation: animate 2s infinite;
	animation: animate 2s infinite;
	position: absolute;
	top: 0px;
	right: -200px;
	}



@-webkit-keyframes animate {
 
  50% {
	-ms-transform: translate(-400px,0) rotate(-360deg); 
   	-webkit-transform: translate(-400px,0) rotate(-360deg); 
    transform: translate(-400px,0) rotate(-360deg); 
	  }

 100% {
	-ms-transform: translate(0,0) rotate(360deg); 
   	-webkit-transform: translate(0,0) rotate(360deg); 
    transform: translate(0,0) rotate(360deg); 
	  }	  


}

@keyframes animate {
  50% {
	-ms-transform: translate(-400px,0) rotate(-360deg); 
   	-webkit-transform: translate(-400px,0) rotate(-360deg); 
    transform: translate(-400px,0) rotate(-360deg); 
	  }

 100% {
	-ms-transform: translate(0,0) rotate(360deg); 
   	-webkit-transform: translate(0,0) rotate(360deg); 
    transform: translate(0,0) rotate(360deg); 
	  }	 	
  
}




</style>
<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
        	<div class="object" id="object_one"></div>
        </div>
    </div>
</div>


