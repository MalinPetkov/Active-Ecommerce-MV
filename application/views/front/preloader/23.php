
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
	height: 200px;
	width: 200px;
	margin-top: -100px;
	margin-left: -100px;
}
.object{
	width: 50px;
	height: 50px;
	background-color: <?php echo $preloader_obj; ?>;
	margin-right: auto;
	margin-left: auto;
	border: 4px solid <?php echo $preloader_obj; ?>;
	left: 73px;
	top: 73px;
	position: absolute;
}

#first_object{
	-webkit-animation: first_object_animate 1s infinite ease-in-out;
	animation: first_object_animate 1s infinite ease-in-out;
}
	
#second_object{
	-webkit-animation: second_object 1s forwards, second_object_animate 1s infinite ease-in-out;
	animation: second_object 1s forwards, second_object_animate 1s infinite ease-in-out;
	}	
#third_object{
	-webkit-animation: third_object 1s forwards, third_object_animate 1s infinite ease-in-out;
	animation: third_object 1s forwards, third_object_animate 1s infinite ease-in-out;
	}	
	
	
	
@-webkit-keyframes second_object {
 100% { width: 100px; height:100px; left: 48px; top: 48px; }
}		
@keyframes second_object {
100% { width: 100px; height:100px; left: 48px; top: 48px; }
}


@-webkit-keyframes third_object {
 100% { width: 150px; height:150px; left: 23px; top: 23px;}
}		
@keyframes third_object {
100% { width: 150px; height:150px; left: 23px; top: 23px;}
}






@-webkit-keyframes first_object_animate {
  0% { -webkit-transform: perspective(100px); }
  50% { -webkit-transform: perspective(100px) rotateY(-180deg); }
  100% { -webkit-transform: perspective(100px) rotateY(-180deg) rotateX(-180deg); }
}

@keyframes first_object_animate {
  0% { 
    transform: perspective(100px) rotateX(0deg) rotateY(0deg);
    -webkit-transform: perspective(100px) rotateX(0deg) rotateY(0deg); 
  } 50% { 
    transform: perspective(100px) rotateX(-180deg) rotateY(0deg);
    -webkit-transform: perspective(100px) rotateX(-180deg) rotateY(0deg) ;
  } 100% { 
    transform: perspective(100px) rotateX(-180deg) rotateY(-180deg);
    -webkit-transform: perspective(100px) rotateX(-180deg) rotateY(-180deg);
  }
}



@-webkit-keyframes second_object_animate {
  0% { -webkit-transform: perspective(200px); }
  50% { -webkit-transform: perspective(200px) rotateY(180deg); }
  100% { -webkit-transform: perspective(200px) rotateY(180deg) rotateX(180deg); }
}	


@keyframes second_object_animate {
  0% { 
    transform: perspective(200px) rotateX(0deg) rotateY(0deg);
    -webkit-transform: perspective(200px) rotateX(0deg) rotateY(0deg); 
  } 50% { 
    transform: perspective(200px) rotateX(180deg) rotateY(0deg);
    -webkit-transform: perspective(200px) rotateX(180deg) rotateY(0deg) ;
  } 100% { 
    transform: perspective(200px) rotateX(180deg) rotateY(180deg);
    -webkit-transform: perspective(200px) rotateX(180deg) rotateY(180deg);
  }
}




@-webkit-keyframes third_object_animate {
  0% { -webkit-transform: perspective(300px); }
  50% { -webkit-transform: perspective(300px) rotateY(-180deg); }
  100% { -webkit-transform: perspective(300px) rotateY(-180deg) rotateX(-180deg); }
}

@keyframes third_object_animate {
  0% { 
    transform: perspective(300px) rotateX(0deg) rotateY(0deg);
    -webkit-transform: perspective(300px) rotateX(0deg) rotateY(0deg); 
  } 50% { 
    transform: perspective(300px) rotateX(-180deg) rotateY(0deg);
    -webkit-transform: perspective(300px) rotateX(-180deg) rotateY(0deg) ;
  } 100% { 
    transform: perspective(300px) rotateX(-180deg) rotateY(-180deg);
    -webkit-transform: perspective(300px) rotateX(-180deg) rotateY(-180deg);
  }
}






</style>
<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object" id="first_object"></div>
            <div class="object" id="second_object"></div>
            <div class="object" id="third_object"></div>
        </div>
    </div>
</div>



