class FileUtils {

    getExtension(filename) {
        const split = filename.split('.');
        return split.length > 1  ? split.pop().toLowerCase() : 'Unknown'
    }

    formatBytes(bytes, decimals = 2) {
        if (bytes === 0) return '0 Bytes';

        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

        const i = Math.floor(Math.log(bytes) / Math.log(k));

        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }

    isImage(extension) {
        return /(jpg|png|gif)$/ig.test(extension);
    }

    imageDataURLAsync(file) {
        return new Promise((resolve, reject) => {
            let reader = new FileReader();

            reader.onload = () => {
                resolve(reader.result);
            };

            reader.onerror = reject;

            reader.readAsDataURL(file);
        })
    }
}


class FileInput extends FileUtils {

    constructor(id) {
        super()
        this.input = document.getElementById(id);
        this.label = this.input.parentElement;
        this.input.addEventListener('change', _ => this.inputChangeEvent())
        this.inputChangeEvent()

    }

    inputChangeEvent() {
        const {files} = this.input
        this.renderFilePreviews(files)
    }

    async renderFilePreviews(files) {

        const currentPreviewsContainer = this.getPreviewsContainer();

        for (const file of files)
            currentPreviewsContainer.appendChild(await this.renderFilePreview(file))

        this.previewsContainer = currentPreviewsContainer;
    }

    getPreviewsContainer() {
        if (this.previewsContainer)
            this.previewsContainer.innerHTML = null;
        else
            this.createEmptyPreviewsContainer()

        return this.previewsContainer
    }

    createEmptyPreviewsContainer() {

        this.previewsContainer = document.createElement('span')
        this.previewsContainer.classList.add('homeless-files-previews')
        this.label.appendChild(this.previewsContainer)
    }

    async renderFilePreview(file) {
        const preview = document.createElement('span')
        const extension = this.getExtension(file.name)


        preview.classList.add('homeless-files-preview', extension)

        if (this.isImage(extension))
            preview.innerHTML = await this.imageTemplate(file)
        else
            preview.innerHTML = this.documentTemplate(file)

        return preview
    }

    documentTemplate({name, size}) {

        const extension = this.getExtension(name)
        const sizeFormatted = this.formatBytes(size)

        return `
            <span class="homeless-file-icon">${extension}</span>
            <span class="homeless-file-name">${name}</span>
            <span class="homeless-file-size">${sizeFormatted}</span>
        `
    }

    async imageTemplate(file){

        const {name, size} = file
        const sizeFormatted = this.formatBytes(size)
        const image_data = await this.imageDataURLAsync(file)

        return `
            <img class="homeless-file-image" src="${image_data}">
            <span class="homeless-file-name">${name}</span>
            <span class="homeless-file-size">${sizeFormatted}</span>
        `
    }
}


class DropFileInput extends FileInput {

    constructor(id) {
        super(id)
        this.container = this.label.parentElement;
        this.dropEventListeners()
    }

    dropEventListeners() {
        for (const type of ['dragover', 'dragenter'])
            this.input.addEventListener(type, event => this.draggingOver(event))

        for (const type of ['dragleave', 'dragend', 'drop'])
            this.input.addEventListener(type, event => this.draggingOut(event))
    }

    draggingOver() {
        this.container.classList.add('is-dragover')
    }

    draggingOut() {
        this.container.classList.remove('is-dragover')
    }
}





