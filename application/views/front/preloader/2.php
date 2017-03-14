
<style>

#loading-center{
	width: 100%;
	height: 100%;
	position: relative;
	}
#loading-center-absolute-one {
	position: absolute;
	left: 50%;
	top: 50%;
	height: 300px;
	width: 50px;
	margin-top: -150px;
	margin-left: -25px;	
}
#loading-center-absolute-two {
	position: absolute;
	left: 50%;
	top: 50%;
	height: 300px;
	width: 50px;
	margin-top: -150px;
	margin-left: 50px;	
}
.object-one{
	width: 18px;
	height: 18px;
	background-color: <?php echo $preloader_obj; ?>;
	float: left;
    margin-top: 15px;
	margin-right: 15px;
	-ms-transform: rotate(45deg); 
   	-webkit-transform: rotate(45deg);
    transform: rotate(45deg);
    -webkit-animation: object-one 1s infinite;
	animation: object-one 1s infinite;
}
.object-two{
	width: 18px;
	height: 18px;
	background-color: <?php echo $preloader_obj; ?>;
	float: left;
    margin-top: 15px;
	margin-right: 15px;
	-ms-transform: rotate(45deg); 
   	-webkit-transform: rotate(45deg);
    transform: rotate(45deg);
	-webkit-animation: object-two 1s infinite;
	animation: object-two 1s infinite;
}


.object-one:nth-child(6){
	-webkit-animation-delay: 0.6s;
    animation-delay: 0.6s;
	}
.object-one:nth-child(5){
	-webkit-animation-delay: 0.5s;
    animation-delay: 0.5s;
	}
.object-one:nth-child(4){
	-webkit-animation-delay: 0.4s;
    animation-delay: 0.4s;
	}
.object-one:nth-child(3){
	-webkit-animation-delay: 0.3s;
    animation-delay: 0.3s;
	}
.object-one:nth-child(2){
	-webkit-animation-delay: 0.2s;
    animation-delay: 0.2s;
	}
		
.object-two:nth-child(9){
	-webkit-animation-delay: 0.9s;
    animation-delay: 0.9s;
	}
.object-two:nth-child(8){
	-webkit-animation-delay: 0.8s;
    animation-delay: 0.8s;
	}
.object-two:nth-child(7){
	-webkit-animation-delay: 0.7s;
    animation-delay: 0.7s;
	}	
.object-two:nth-child(6){
	-webkit-animation-delay: 0.6s;
    animation-delay: 0.6s;
	}
.object-two:nth-child(5){
	-webkit-animation-delay: 0.5s;
    animation-delay: 0.5s;
	}
.object-two:nth-child(4){
	-webkit-animation-delay: 0.4s;
    animation-delay: 0.4s;
	}
.object-two:nth-child(3){
	-webkit-animation-delay: 0.3s;
    animation-delay: 0.3s;
	}
.object-two:nth-child(2){
	-webkit-animation-delay: 0.2s;
    animation-delay: 0.2s;
	}
											

@-webkit-keyframes object-one{
50% {
    -ms-transform: translate(100px,0); 
   	-webkit-transform: translate(100px,0);
    transform: translate(100px,0);
	}
}		
@keyframes object-one{
50% {
    -ms-transform: translate(100px,0); 
   	-webkit-transform: translate(100px,0);
    transform: translate(100px,0);
	}
}


@-webkit-keyframes object-two{
50% {
    -ms-transform: translate(-100px,0); 
   	-webkit-transform: translate(-100px,0);
    transform: translate(-100px,0);
	}
}		
@keyframes object-two{
50% {
    -ms-transform: translate(-100px,0); 
   	-webkit-transform: translate(-100px,0);
    transform: translate(-100px,0);
	}
}



</style>
<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute-one">
            <div class="object-one"></div>
            <div class="object-one"></div>
            <div class="object-one"></div>
            <div class="object-one"></div>
            <div class="object-one"></div>
            <div class="object-one"></div>
        </div>
        <div id="loading-center-absolute-two">
            <div class="object-two"></div>
            <div class="object-two"></div>
            <div class="object-two"></div>
            <div class="object-two"></div>
            <div class="object-two"></div>
            <div class="object-two"></div>
        </div>
    </div>
</div>



