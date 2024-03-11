document.addEventListener('DOMContentLoaded', () => {
    const dropContainer = document.getElementById('dropContainer');
    const fileInput = document.getElementById('fileInput');

    dropContainer.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropContainer.classList.add('dragover');
    });

    dropContainer.addEventListener('dragleave', () => {
        dropContainer.classList.remove('dragover');
    });

    dropContainer.addEventListener('drop', (e) => {
        e.preventDefault();
        dropContainer.classList.remove('dragover');

        const files = e.dataTransfer.files;

        if (files.length > 0) {
            fileInput.files = files;
        }
    });

    fileInput.addEventListener('change', () => {
        // Aqui você pode adicionar lógica para lidar com o arquivo selecionado, se necessário
        console.log(fileInput.files[0]);
    });
});
