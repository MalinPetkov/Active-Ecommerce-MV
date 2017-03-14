

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
	width: 100px;
	margin-top: -50px;
	margin-left: -50px;
}
.object{
	position: absolute;
	height: 10px;
	width: 50px;		
	background-color: <?php echo $preloader_obj; ?>;
}	
.object:nth-child(2n+0) {
	-webkit-animation: animate_right 2s infinite;
	animation: animate_right 2s infinite;
}
.object:nth-child(2n+1) {
	-webkit-animation: animate_left 2s infinite;
	animation: animate_left 2s infinite;
}		
.object:nth-child(1){
	top: 0px;
	left: 0px;	
	}
.object:nth-child(2){
	top: 0px;
	left: 50px;
	}
.object:nth-child(3){
	top: 10px;
	left: 0px;	
	-webkit-animation-delay: 0.1s;
    animation-delay: 0.1s;	
	}
.object:nth-child(4){
	top: 10px;
	left: 50px;
	-webkit-animation-delay: 0.1s;
    animation-delay: 0.1s;	
	}
.object:nth-child(5){
	top: 20px;
	left: 0px;
	-webkit-animation-delay: 0.2s;
    animation-delay: 0.2s;	
	}
.object:nth-child(6){
	top: 20px;
	left: 50px;
	-webkit-animation-delay: 0.2s;
    animation-delay: 0.2s;
	}
.object:nth-child(7){
	top: 30px;
	left: 0px;	
	-webkit-animation-delay: 0.3s;
    animation-delay: 0.3s;		
	}
.object:nth-child(8){
	top: 30px;
	left: 50px;
	-webkit-animation-delay: 0.3s;
    animation-delay: 0.3s;	
	}
.object:nth-child(9){
	top: 40px;
	left: 0px;	
	-webkit-animation-delay: 0.4s;
    animation-delay: 0.4s;
	}				
.object:nth-child(10){
	top: 40px;
	left: 50px;	
	-webkit-animation-delay: 0.4s;
    animation-delay: 0.4s;
	}	
.object:nth-child(11){
	top: 50px;
	left: 0px;	
	-webkit-animation-delay: 0.5s;
    animation-delay: 0.5s;
	}				
.object:nth-child(12){
	top: 50px;
	left: 50px;	
	-webkit-animation-delay: 0.5s;
    animation-delay: 0.5s;
	}	
.object:nth-child(13){
	top: 60px;
	left: 0px;	
	-webkit-animation-delay: 0.6s;
    animation-delay: 0.6s;
	}				
.object:nth-child(14){
	top: 60px;
	left: 50px;	
	-webkit-animation-delay: 0.6s;
    animation-delay: 0.6s;
	}	
.object:nth-child(15){
	top: 70px;
	left: 0px;	
	-webkit-animation-delay: 0.7s;
    animation-delay: 0.7s;
	}				
.object:nth-child(16){
	top: 70px;
	left: 50px;	
	-webkit-animation-delay: 0.7s;
    animation-delay: 0.7s;
	}
.object:nth-child(17){
	top: 80px;
	left: 0px;	
	-webkit-animation-delay: 0.8s;
    animation-delay: 0.8s;
	}				
.object:nth-child(18){
	top: 80px;
	left: 50px;	
	-webkit-animation-delay: 0.8s;
    animation-delay: 0.8s;
	}
.object:nth-child(19){
	top: 90px;
	left: 0px;	
	-webkit-animation-delay: 0.9s;
    animation-delay: 0.9s;
	}				
.object:nth-child(20){
	top: 90px;
	left: 50px;	
	-webkit-animation-delay: 0.9s;
    animation-delay: 0.9s;
	}



@-webkit-keyframes animate_right {
 

50% {
	-ms-transform: translate(200px,-200px) rotate(180deg); 
   	-webkit-transform: translate(200px,-200px) rotate(180deg); 
    transform: translate(200px,-200px) rotate(180deg); 
  }
	  
  

}

@keyframes animate_right {

50% {
	-ms-transform: translate(200px,-200px) rotate(180deg); 
   	-webkit-transform: translate(200px,-200px) rotate(180deg); 
    transform: translate(200px,-200px) rotate(180deg); 
  }
	 
	
	
	}
	


@-webkit-keyframes animate_left {
 

50% {
	-ms-transform: translate(-200px,-200px) rotate(180deg); 
   	-webkit-transform: translate(-200px,-200px) rotate(180deg); 
    transform: translate(-200px,-200px) rotate(180deg); 
  }
	  
  

}

@keyframes animate_left {

50% {
	-ms-transform: translate(-200px,-200px) rotate(180deg); 
   	-webkit-transform: translate(-200px,-200px) rotate(180deg); 
    transform: translate(-200px,-200px) rotate(180deg); 
  }
	 
	
	
	}


</style>
<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
        </div>
    </div>
</div>



