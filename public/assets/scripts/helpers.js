function selectElement(selector) {
    const elements = document.querySelectorAll(selector)
    if (elements.length < 1) return undefined 
    return elements.length === 1 ? elements[0] : elements
}

export {selectElement}