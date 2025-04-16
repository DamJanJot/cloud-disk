document.addEventListener("DOMContentLoaded", () => {
    const folderStructure = document.getElementById('folder-content');
    const editor = document.getElementById('editor');
    const saveFileButton = document.getElementById('save-file');
    const uploadForm = document.getElementById('upload-form');
    const createForm = document.getElementById('create-form');
    const goBackButton = document.getElementById('go-back');
    let currentPath = '';

    function loadFolderStructure(path = '') {
        currentPath = path;
        fetch(`file_manager.php?action=list&path=${encodeURIComponent(path)}`)
            .then(response => response.json())
            .then(data => {
                renderFolders(data);
            });
    }

    function renderFolders(data) {
        folderStructure.innerHTML = '';
        data.forEach(item => {
            const div = document.createElement('div');
            div.textContent = item.name;
            div.classList.add(item.type === 'folder' ? 'folder' : 'file');
            div.onclick = () => {
                if (item.type === 'folder') {
                    loadFolderStructure(item.path);
                } else if (item.type === 'file') {
                    fetchFileContent(item.path);
                }
            };
            folderStructure.appendChild(div);
        });
    }

    function fetchFileContent(path) {
        fetch(`file_manager.php?action=read&path=${encodeURIComponent(path)}`)
            .then(response => response.text())
            .then(content => {
                editor.value = content;
                editor.dataset.filePath = path;
            });
    }

    saveFileButton.addEventListener('click', () => {
        const path = editor.dataset.filePath;
        const content = editor.value;

        fetch('file_manager.php?action=save', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ path, content })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
        });
    });

    uploadForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(uploadForm);
        formData.append('path', currentPath);

        fetch('file_manager.php?action=upload', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            loadFolderStructure(currentPath);
        });
    });

    createForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const name = document.getElementById('new-name').value;
        const type = document.getElementById('type-select').value;

        fetch('file_manager.php?action=create', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ path: currentPath, name, type })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            loadFolderStructure(currentPath);
        });
    });

    goBackButton.addEventListener('click', () => {
        const parts = currentPath.split('/').filter(Boolean);
        parts.pop();
        loadFolderStructure(parts.join('/'));
    });

    loadFolderStructure();
});
