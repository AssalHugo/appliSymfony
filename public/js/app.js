
class FormCollectionController {
    constructor() {
        this.collectionContainer = document.querySelector('.collectionContainer');
        this.index = 0;
        this.prototype = '<li>Prototype Element</li>'; // Remplacez ceci par votre propre prototype
    }

    addCollectionElement(event) {
        const item = document.createElement('li');
        item.innerHTML = this.prototype.replace(/__name__/g, this.index);
        this.collectionContainer.appendChild(item);
        this.index++;
    }
}

// Instanciation et gestion des événements
const controller = new FormCollectionController();
document.getElementById("addTag").addEventListener('click', (event) => controller.addCollectionElement(event));