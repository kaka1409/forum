function selectElement(selector = '') {
    const elements = Array.from(document.querySelectorAll(selector))
    if (elements.length < 1) return undefined 
    return elements.length === 1 ? elements[0] : elements
}

function truncateText(text = '', limit = undefined) {
    return text.length > limit ? text.slice(0, limit) +  '...' : text
}

function getPostIdInList(e) {
    return parseInt((e.target.closest('.post a').href.split('/')).at(-1))
}

export {
    selectElement, 
    truncateText,
    getPostIdInList
}