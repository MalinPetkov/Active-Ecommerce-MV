

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
	height: 118px;
	width: 72px;
	margin-top: -59px;
	margin-left: -36px;
}
.object{
	width: 26px;
	height: 26px;
	background-color: <?php echo $preloader_obj; ?>;
	margin-right: 20px;
	float: left;
	margin-bottom: 20px;
	}
.object:nth-child(2n+0) {
	margin-right: 0px;
}


#object_one {
	-webkit-animation: object_one 1s infinite;
	animation: object_one 1s infinite;
	}
#object_two {
	-webkit-animation: object_two 1s infinite;
	animation: object_two 1s infinite;
	}
#object_three {
	-webkit-animation: object_three 1s infinite;
	animation: object_three 1s infinite;
	}
#object_four {
	-webkit-animation: object_four 1s infinite;
	animation: object_four 1s infinite;
	}
#object_five {
	-webkit-animation: object_five 1s infinite;
	animation: object_five 1s infinite;
	}
#object_six {
	-webkit-animation: object_six 1s infinite;
	animation: object_six 1s infinite;
	}

@-webkit-keyframes object_one {
 

  50% {
    -ms-transform: translate(-100px,46px) rotate(-179deg);
   	-webkit-transform: translate(-100px,46px) rotate(-179deg); 
    transform: translate(-100px,46px) rotate(-179deg);
	  }
 
  100% {
    -ms-transform: translate(0,0); 
   	-webkit-transform: translate(0,0); 
    transform: translate(0,0); 
	  }

}

@keyframes object_one {
  50% {
    -ms-transform: translate(-100px,46px) rotate(-179deg);
   	-webkit-transform: translate(-100px,46px) rotate(-179deg); 
    transform: translate(-100px,46px) rotate(-179deg);
	  }
 
  100% {
    -ms-transform: translate(0,0); 
   	-webkit-transform: translate(0,0); 
    transform: translate(0,0); 
	  }

  
}


@-webkit-keyframes object_two {

  50% {
    -ms-transform: translate(100px,46px) rotate(179deg);
   	-webkit-transform: translate(100px,46px) rotate(179deg); 
    transform: translate(100px,46px) rotate(179deg);
	  }
 
  100% {
    -ms-transform: translate(0,0); 
   	-webkit-transform: translate(0,0); 
    transform: translate(0,0); 
	  }

}

@keyframes object_two {
	
  50% {
    -ms-transform: translate(100px,46px) rotate(179deg);
   	-webkit-transform: translate(100px,46px) rotate(179deg); 
    transform: translate(100px,46px) rotate(179deg);
	  }
 
  100% {
    -ms-transform: translate(0,0); 
   	-webkit-transform: translate(0,0); 
    transform: translate(0,0); 
	  }
  
}


@-webkit-keyframes object_three {

  50% {
    -ms-transform: translate(-100px,0) rotate(-179deg);
   	-webkit-transform: translate(-100px,0) rotate(-179deg);
    transform: translate(-100px,0) rotate(-179deg);
	  }
 
  100% {
    -ms-transform: translate(0,0); 
   	-webkit-transform: translate(0,0); 
    transform: translate(0,0); 
	  }

}

@keyframes object_three {
	
  50% {
    -ms-transform: translate(-100px,0) rotate(-179deg);
   	-webkit-transform: translate(-100px,0) rotate(-179deg);
    transform: translate(-100px,0) rotate(-179deg);
	  }
 
  100% {
    -ms-transform: translate(0,0); 
   	-webkit-transform: translate(0,0); 
    transform: translate(0,0); 
	  }
  
}

@-webkit-keyframes object_four {

  50% {
 -ms-transform: translate(100px,0) rotate(179deg);
   	-webkit-transform: translate(100px,0) rotate(179deg);
    transform: translate(100px,0) rotate(179deg);
	  }
 
  100% {
    -ms-transform: translate(0,0); 
   	-webkit-transform: translate(0,0); 
    transform: translate(0,0); 
	  }

}

@keyframes object_four {
	
  50% {
 -ms-transform: translate(100px,0) rotate(179deg);
   	-webkit-transform: translate(100px,0) rotate(179deg);
    transform: translate(100px,0) rotate(179deg);
	  }
 
  100% {
    -ms-transform: translate(0,0); 
   	-webkit-transform: translate(0,0); 
    transform: translate(0,0); 
	  }
  
}


@-webkit-keyframes object_five {

  50% {
   -ms-transform: translate(-100px,-46px) rotate(-179deg);
   	-webkit-transform: translate(-100px,-46px) rotate(-179deg);
    transform: translate(-100px,-46px) rotate(-179deg);
	  }
 
  100% {
    -ms-transform: translate(0,0); 
   	-webkit-transform: translate(0,0); 
    transform: translate(0,0); 
	  }

}

@keyframes object_five {
	
  50% {
   -ms-transform: translate(-100px,-46px) rotate(-179deg);
   	-webkit-transform: translate(-100px,-46px) rotate(-179deg);
    transform: translate(-100px,-46px) rotate(-179deg);
	  }
 
  100% {
    -ms-transform: translate(0,0); 
   	-webkit-transform: translate(0,0); 
    transform: translate(0,0); 
	  }
  
}


@-webkit-keyframes object_six {

  50% {
   -ms-transform: translate(100px,-46px) rotate(179deg);
   	-webkit-transform: translate(100px,-46px) rotate(179deg);
    transform: translate(100px,-46px) rotate(179deg);
	  }
 
  100% {
    -ms-transform: translate(0,0); 
   	-webkit-transform: translate(0,0); 
    transform: translate(0,0); 
	  }

}

@keyframes object_six {
	
  50% {
   -ms-transform: translate(100px,-46px) rotate(179deg);
   	-webkit-transform: translate(100px,-46px) rotate(179deg);
    transform: translate(100px,-46px) rotate(179deg);
	  }
 
  100% {
    -ms-transform: translate(0,0); 
   	-webkit-transform: translate(0,0); 
    transform: translate(0,0); 
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
            <div class="object" id="object_five"></div>
            <div class="object" id="object_six"></div>
        </div>
    </div>
</div>

