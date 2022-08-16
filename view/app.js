function test(e){
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