var a_link = document.querySelectorAll('.menu_ul li a');
for (var i = 0, len = a_link.length; i < len; i++) {
	a_link[i].addEventListener('click',function(e){
		console.log(this.parentNode.children[1])
		if(this.parentNode.children[1].style.display == 'block'){
			this.parentNode.children[1].style.display = 'none';
			this.parentNode.children[0].children[2].children[0].className = 'fa fa-angle-down';
		}else{
			this.parentNode.children[1].style.display = 'block';
			this.parentNode.children[0].children[2].children[0].className = 'fa fa-angle-up';
		}
	},false);
}