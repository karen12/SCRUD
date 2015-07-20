$(document).ready(main);

var contador = 1;

function main(){
	$('.menu_bar').click(function(){

		if(contador == 1){
			$('nav').animate({
				left: '00'
				document.write("no funciona");
			});
			contador = 0;
		} else {
			contador = 1;
			$('nav').animate({
				left: '-100%'
				document.write("no funciona2");
			})
		}
		});

	}
 