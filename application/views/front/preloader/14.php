

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
	width: 40px;
	margin-top: -50px;
	margin-left: -20px;
}
.object{
	width: 40px;
	height: 8px;
	margin-bottom:20px;
	background-color: <?php echo $preloader_obj; ?>;
	-webkit-animation: animate 0.8s infinite;
	animation: animate 0.8s infinite;
	}


#object_two { 
	-webkit-animation-delay: 0.2s; 
    animation-delay: 0.2s;

	}
#object_three {	
	-webkit-animation-delay: 0.4s; 
    animation-delay: 0.4s; 
	}





@-webkit-keyframes animate {
 
  50% {
	-ms-transform: scale(1.5); 
   	-webkit-transform: scale(1.5);   
    transform: scale(1.5);  
	  }
	  


}

@keyframes animate {
  50% {
	-ms-transform: scale(1.5); 
   	-webkit-transform: scale(1.5);   
    transform: scale(1.5);  
	  }

  
}




</style>
<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object" id="object_one"></div>
            <div class="object" id="object_two"></div>
            <div class="object" id="object_three"></div>
        </div>
    </div>
</div>


<