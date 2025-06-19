// Módulo para manipulación del DOM
export function clearContainer(container) {
    while (container.firstChild) {
        container.removeChild(container.firstChild);
    }
}

export function createElement(tag, classes = [], attributes = {}) {
    const element = document.createElement(tag);
    element.classList.add(...classes);
    
    for (const [key, value] of Object.entries(attributes)) {
        element.setAttribute(key, value);
    }
    
    return element;
}

export function createInput(type, placeholder, value = '', classes = [], attributes = {}) {
    const input = createElement('input', classes, { type, placeholder, ...attributes });
    input.value = value;
    return input;
}

export function createTextArea(placeholder, value = '', classes = [], attributes = {}) {
    const textarea = createElement('textarea', classes, { placeholder, ...attributes });
    textarea.textContent = value;
    return textarea;
}

export function createButton(text, classes = [], iconClass = '', attributes = {}) {
    const button = createElement('button', classes, attributes);
    
    if (iconClass) {
        const icon = createElement('i', iconClass.split(' '));
        button.appendChild(icon);
    }
    
    if (text) {
        button.appendChild(document.createTextNode(text));
    }
    
    return button;
}