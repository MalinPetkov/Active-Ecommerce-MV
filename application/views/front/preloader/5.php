


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
	width: 200px;
	margin-top: -25px;
	margin-left: -100px;
}
.object{
	width: 20px;
	height:20px;
	background-color: <?php echo $preloader_obj; ?>;
	float: left;
    margin-top: 15px;
	-moz-border-radius: 50% 50% 50% 50%;
	-webkit-border-radius: 50% 50% 50% 50%;
	border-radius: 50% 50% 50% 50%;
}


#first_object{
	-webkit-animation: first_object 2s infinite;
	animation: first_object 2s infinite;
 
}

#second_object{
	-webkit-animation: second_object 2s infinite;
	animation: second_object 2s infinite;
}	
	
	
	
	


	
@-webkit-keyframes first_object {

 25% {
    -ms-transform: translate(90px,0) scale(2); 
   	-webkit-transform: translate(90px,0) scale(2);
    transform: translate(90px,0) scale(2);
	 }

 50% {
    -ms-transform: translate(180px,0) scale(1); 
   	-webkit-transform: translate(180px,0) scale(1);
    transform: translate(180px,0) scale(1);
	 }	 
 
  75% {
     -ms-transform: translate(90px,0) scale(2); 
   	-webkit-transform: translate(90px,0) scale(2);
    transform: translate(90px,0) scale(2);
	 }	 
 
}		
@keyframes first_object {

 25% {
    -ms-transform: translate(90px,0) scale(2); 
   	-webkit-transform: translate(90px,0) scale(2);
    transform: translate(90px,0) scale(2);
	 }

 50% {
    -ms-transform: translate(180px,0) scale(1); 
   	-webkit-transform: translate(180px,0) scale(1);
    transform: translate(180px,0) scale(1);
	 }	 
 
  75% {
     -ms-transform: translate(90px,0) scale(2); 
   	-webkit-transform: translate(90px,0) scale(2);
    transform: translate(90px,0) scale(2);
	 }	 
 

}
	


	
@-webkit-keyframes second_object {

 25% {
    -ms-transform: translate(-90px,0) scale(2); 
   	-webkit-transform: translate(-90px,0) scale(2);
    transform: translate(-90px,0) scale(2);
	 }

 50% {
    -ms-transform: translate(-180px,0) scale(1); 
   	-webkit-transform: translate(-180px,0) scale(1);
    transform: translate(-180px,0) scale(1);
	 }	 
 
  75% {
     -ms-transform: translate(-90px,0) scale(2); 
   	-webkit-transform: translate(-90px,0) scale(2);
    transform: translate(-90px,0) scale(2);
	 }	 
 

}		
@keyframes second_object {

 25% {
    -ms-transform: translate(-90px,0) scale(2); 
   	-webkit-transform: translate(-90px,0) scale(2);
    transform: translate(-90px,0) scale(2);
	 }

 50% {
    -ms-transform: translate(-180px,0) scale(1); 
   	-webkit-transform: translate(-180px,0) scale(1);
    transform: translate(-180px,0) scale(1);
	 }	 
 
  75% {
     -ms-transform: translate(-90px,0) scale(2); 
   	-webkit-transform: translate(-90px,0) scale(2);
    transform: translate(-90px,0) scale(2);
	 }	 
 

}







</style>
<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object" id="first_object"></div>
            <div class="object" id="second_object" style="float:right;"></div>
		</div>
	</div>
 </div>


