function show_comments(e){
	let comment_id = e.id
	
	post_id = comment_id.replace('comment','post')
	post_element = document.getElementById(post_id)
	comment_box = post_element.lastChild.previousSibling
	if (comment_box.classList.contains('d-none')){
		comment_box.classList.remove('d-none')
	}else{
		comment_box.classList.add('d-none')
	}
	
}


function show_likers(e){
	likersBox = document.getElementById('likers_box')
	if (likersBox.classList.contains('d-none')){
		likersBox.classList.remove('d-none')
		likersBox.classList.add('d-flex')
	}else{
		likersBox.classList.add('d-none')
		likersBox.classList.remove('d-flex')
	}
}