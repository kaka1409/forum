function selectElement(selector) {
    const elements = Array.from(document.querySelectorAll(selector))
    if (elements.length < 1) return undefined 
    return elements.length === 1 ? elements[0] : elements
}

function truncateText() {
    
}

export {selectElement}