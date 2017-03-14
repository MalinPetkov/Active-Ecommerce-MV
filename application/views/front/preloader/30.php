

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
	height: 150px;
	width: 150px;
	margin-top: -75px;
	margin-left: -75px;
	-ms-transform: rotate(45deg); 
   	-webkit-transform: rotate(45deg);
    transform: rotate(45deg); 

}
.object{
	width: 20px;
	height: 20px;
	background-color: <?php echo $preloader_obj; ?>;
	margin-right: 110px;
	float: left;
	margin-bottom: 110px;

	}
.object:nth-child(2n+0) {
	margin-right: 0px;

}


#object_one {
	-webkit-animation: object_one 2s infinite;
	animation: object_one 2s infinite;
	}
#object_two {
	-webkit-animation: object_two 2s infinite;
	animation: object_two 2s infinite;
	}
#object_three {
	-webkit-animation: object_three 2s infinite;
	animation: object_three 2s infinite;
	}
#object_four {
	-webkit-animation: object_four 2s infinite;
	animation: object_four 2s infinite;
}
#object_big{
	-webkit-animation: object_big 0.5s infinite;
	animation: object_big 0.5s infinite;
	position: absolute;
	width: 50px;
	height: 50px;
	left: 50px;
	top: 50px;
}	






@-webkit-keyframes object_big {
  25% { -webkit-transform:  scale(0.5); }

}

@keyframes object_big {
  25% { 
    transform:  scale(0.5);
    -webkit-transform:   scale(0.5);
  }
}



@-webkit-keyframes object_one {
  25% { -webkit-transform: translate(130px,0) rotate(-90deg) ; }
  50% { -webkit-transform: translate(130px,130px) rotate(-180deg); }
  75% { -webkit-transform:  translate(0,130px) rotate(-270deg) ; }
  100% { -webkit-transform: rotate(-360deg); }
}

@keyframes object_one {
  25% { 
    transform: translate(130px,0) rotate(-90deg) ;
    -webkit-transform: translate(130px,0) rotate(-90deg) ;
  } 
  50% { 
    transform: translate(130px,130px) rotate(-180deg);
    -webkit-transform: translate(130px,130px) rotate(-180deg);
  } 
  75% { 
    transform: translate(0,130px) rotate(-270deg) ;
    -webkit-transform: translate(0,130px) rotate(-270deg) ;
  } 
  100% { 
    transform: rotate(-360deg);
    -webkit-transform: rotate(-360deg);
  }
}


@-webkit-keyframes object_two {
  25% { -webkit-transform: translate(0,130px) rotate(-90deg) ; }
  50% { -webkit-transform: translate(-130px,130px) rotate(-180deg); }
  75% { -webkit-transform:  translate(-130px,0) rotate(-270deg) ; }
  100% { -webkit-transform: rotate(-360deg); }
}

@keyframes object_two {
  25% { 
    transform: translate(0,130px) rotate(-90deg) ; 
    -webkit-transform: translate(0,130px) rotate(-90deg) ; 
  } 
  50% { 
    transform: translate(-130px,130px) rotate(-180deg);
    -webkit-transform: translate(-130px,130px) rotate(-180deg);
  } 
  75% { 
    transform: translate(-130px,0) rotate(-270deg) ;
    -webkit-transform: translate(-130px,0) rotate(-270deg) ;
  } 
  100% { 
    transform: rotate(-360deg);
    -webkit-transform: rotate(-360deg);
  }
}

@-webkit-keyframes object_three {
  25% { -webkit-transform: translate(0,-130px)  rotate(-90deg) ; }
  50% { -webkit-transform: translate(130px,-130px) rotate(-180deg); }
  75% { -webkit-transform:  translate(130px,0) rotate(-270deg) ; }
  100% { -webkit-transform: rotate(-360deg); }
}

@keyframes object_three {
  25% { 
    transform: translate(0,-130px)  rotate(-90deg) ;
    -webkit-transform: translate(0,-130px)  rotate(-90deg) ;
  } 
  50% { 
    transform: translate(130px,-130px) rotate(-180deg);
    -webkit-transform: translate(130px,-130px) rotate(-180deg);
  } 
  75% { 
    transform:  translate(130px,0) rotate(-270deg) ;
    -webkit-transform: translate(130px,0) rotate(-270deg) ;
  } 
  100% { 
    transform: rotate(-360deg);
    -webkit-transform: rotate(-360deg);
  }
}


@-webkit-keyframes object_four {
  25% { -webkit-transform: translate(-130px,0)  rotate(-90deg) ; }
  50% { -webkit-transform: translate(-130px,-130px) rotate(-180deg); }
  75% { -webkit-transform:  translate(0,-130px) rotate(-270deg) ; }
  100% { -webkit-transform: rotate(-360deg); }
}

@keyframes object_four {
  25% { 
    transform: translate(-130px,0)  rotate(-90deg) ; 
    -webkit-transform: translate(-130px,0)  rotate(-90deg) ; 
  } 
  50% { 
    transform: translate(-130px,-130px) rotate(-180deg);
    -webkit-transform: translate(-130px,-130px) rotate(-180deg);
  } 
  75% { 
    transform: translate(0,-130px) rotate(-270deg) ;
    -webkit-transform: translate(0,-130px) rotate(-270deg) ;
  } 
  100% { 
    transform: rotate(-360deg);
    -webkit-transform: rotate(-360deg);
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
<div class="object" id="object_big"></div>
</div>
</div>
 
</div>


