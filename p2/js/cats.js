function cats(){
	a = ["https://images.pexels.com/photos/104827/cat-pet-animal-domestic-104827.jpeg?auto=compress&cs=tinysrgb&h=350","https://upload.wikimedia.org/wikipedia/commons/thumb/3/3a/Cat03.jpg/1200px-Cat03.jpg","http://www.insajderi.com/wp-content/uploads/2018/04/ruyada-kedi-gormek.jpg","http://www.catster.com/wp-content/uploads/2017/08/Pixiebob-cat.jpg","https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQZskVq4sKoOopx8gYOEA4vSiK2J_XTkn_FOPneHg-BYEgPMwcQ"]
	for (i=0;i<100;i++){
	    document.getElementsByTagName('img')[i].src=a[parseInt(Math.random()*a.length)]
	}
}
cats();