import {Element, selectElement} from "./elements.js";

function updateStyle(elementName = null, behavior = '', css = '') {
    const element = elementName .nodeType === 1 ? elementName : selectElement(elementName)

    if (element) {
        element.addEventListener(behavior, () => {
            element.setAttribute('style', css)
        })
    }
}

function updateIcon(elementName = null, behavior = '', iconName = '', defaultBehavior = false) {
    const element = selectElement(elementName)

    if (element) {
        element.addEventListener(behavior, (e) => {
            if (defaultBehavior) {
                e.preventDefault()
                e.stopPropagation()
            }
    
            element.src = '/forum/public/assets/icons/'+ iconName 
        })
    }
}

function updateClassList(elementName = null, method = '', className = '') {
    const element = selectElement(elementName)

    switch (method) {
        case 'add':
            element.classList.add(className)
            break
        case 'remove':
            element.classList.remove(className)
            break
        case 'contains':
            return element.classList.contains(className)
            break
        case 'toggle':
            element.classList.toggle(className)
            break
        default:
            console.error('No class list method exist')
            break
    }
}

export {updateStyle, updateIcon, updateClassList }