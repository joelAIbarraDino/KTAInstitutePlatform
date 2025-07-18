
const Font = Quill.import('formats/font');
Font.whitelist = [
    'lato', 'caveat', 'anton', 'pacifico', 'playwrite-hu', 'indie-flower',
    'dancing-script', 'arial', 'georgia', 'courier-new', 'times-new-roman',
    'verdana', 'comic-sans-ms'
];
Quill.register(Font, true);

const quill = new Quill('#editor', {
    theme: 'snow',
    modules: {
        toolbar: [
            [{ 'font': [] }],
            [{ 'size': [] }],
            [{ 'color': [] }, { 'background': [] }],
            [{ 'align': [] }],
            ['bold', 'italic', 'underline'],
            [{ 'script': 'sub'}, { 'script': 'super' }],   
            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
            ['link']
        ]
    }
});

const hiddenInput = document.querySelector('#input-editor');
if (hiddenInput.value.trim() !== '') {
    quill.root.innerHTML = hiddenInput.value;
}

const form = document.querySelector('form');
form.addEventListener('submit', function () {
    hiddenInput.value = quill.root.innerHTML;
});
