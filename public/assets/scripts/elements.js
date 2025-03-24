
function Element(name) {
    this.elements = {
        // side menu components
        "collapse_icon": document.querySelector('.collapse_icon'),
        "sidemenu": document.querySelector('.side_menu'),
        "newBtn": document.querySelector('.new_btn'),
        
        // post's components
        "posts": Array.from(document.querySelectorAll('.post')), // get an array of posts
        "post": document.querySelector('.post_container'), // get a post when viewing a single post
    
        // create post form components
        "create_post_form": document.querySelector('.post_form form'),
    
        "module": document.querySelector('.post_form #module'),
    
        "title": document.querySelector('.post_form #title'),
        "title_char_count": document.querySelector('.post_form #title_char_count'),
    
        "thumbnailButton": document.querySelector('.post_form .form_thumbnail'),
        "thumbnail": document.querySelector('.post_form #thumbnail'),
        "thumbnailPreview": document.querySelector('.post_form #thumbnail_preview'),
        "thumbnailTitle": document.querySelector('.post_form .thumbnail_title'),
    
        "content": document.querySelector('.post_form #content'),
        "content_char_count": document.querySelector('.post_form #content_char_count'),
    
        // modal
        "modal" : document.querySelector('.modal')
    }

    return this.elements[name];
}

function selectElement(name) {
    return Element[name]
}

export {selectElement, Element}