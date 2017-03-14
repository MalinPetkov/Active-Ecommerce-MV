

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
	height: 100px;
	width: 50px;
	margin-top: -50px;
	margin-left: -25px;
}
.object{
	width: 50px;
	height: 8px;
	margin-bottom:15px;
	background-color: <?php echo $preloader_obj; ?>;
	-webkit-animation: animate 0.8s infinite;
	animation: animate 0.8s infinite;
	}

#object_two { 
	-webkit-animation-delay: 0.2s; 
    animation-delay: 0.2s;

	}

	
#object_four {	
	-webkit-animation-delay: 0.2s; 
    animation-delay: 0.2s; 
	}


@-webkit-keyframes animate {
 
  50% {
	-ms-transform: translate(50%,0); 
   	-webkit-transform: translate(50%,0); 
    transform: translate(50%,0); 
	  }

	  


}

@keyframes animate {
  50% {
	-ms-transform: translate(50%,0); 
   	-webkit-transform: translate(50%,0); 
    transform: translate(50%,0); 
	  }

  
}




</style>
<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object" id="object_one"></div>
            <div class="object" id="object_two"></div>
            <div class="object" id="object_three"></div>
            <div class="object" id="object_four"></div>
        </div>
    </div>
</div>



