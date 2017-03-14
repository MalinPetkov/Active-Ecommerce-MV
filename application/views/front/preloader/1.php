

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
#object{
	width: 80px;
	height: 80px;
	background-color: <?php echo $preloader_obj; ?>;
	-webkit-animation: animate 1s infinite ease-in-out;
	animation: animate 1s infinite ease-in-out;
	margin-right: auto;
	margin-left: auto;
	margin-top: 60px;
}
@-webkit-keyframes animate {
  0% { -webkit-transform: perspective(160px); }
  50% { -webkit-transform: perspective(160px) rotateY(-180deg); }
  100% { -webkit-transform: perspective(160px) rotateY(-180deg) rotateX(-180deg); }
}

@keyframes animate {
  0% { 
    transform: perspective(160px) rotateX(0deg) rotateY(0deg);
    -webkit-transform: perspective(160px) rotateX(0deg) rotateY(0deg); 
  } 50% { 
    transform: perspective(160px) rotateX(-180deg) rotateY(0deg);
    -webkit-transform: perspective(160px) rotateX(-180deg) rotateY(0deg) ;
  } 100% { 
    transform: perspective(160px) rotateX(-180deg) rotateY(-180deg);
    -webkit-transform: perspective(160px) rotateX(-180deg) rotateY(-180deg);
  }
}



</style>
<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
        	<div id="object"></div>
        </div>
    </div>
 
</div>


