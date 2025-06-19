import { fetchData, getCourseID } from './modules/api.js';
import { clearContainer, createElement, createInput, createButton } from './modules/dom.js';
import { capitalize, validateInput } from './modules/utilities.js';
import { showSwalAlert, showSwalConfirm, changeAlert, resetAlert } from './modules/alerts.js';
import { initAccordion } from './modules/accordion.js';

class CourseContent {
    constructor() {
        this.btnAdd = document.querySelector("#add_module_btn");
        this.btnExit = document.querySelector("#btn-exit");
        this.modulesContainer = document.querySelector("#modules-container");
        this.moduleName = document.querySelector("#new_module_name");
        this.containerAlert = document.querySelector("#container-alert");
        this.courseID = getCourseID();
        this.modules = [];
        
        this.init();
    }

    async init() {
        await this.getModules();
        this.setupEventListeners();
        this.setDraggableModules();
    }

    setupEventListeners() {
        this.btnAdd.addEventListener("click", () => this.addModule());
        this.moduleName.addEventListener('keydown', e => {
            e.target.value = capitalize(e.target.value);
            if (e.key === "Enter") this.addModule();
        });
        this.moduleName.addEventListener('input', e => {
            if (e.target.value.trim().length === 0) e.target.value = "";
        });
        this.btnExit.addEventListener('click', this.showExitMessage);
    }

    async getModules() {
        try {
            const url = `/api/curso/content/${this.courseID}`;
            const response = await fetchData(url);
            this.modules = response.modules;
            this.showModules();
        } catch (error) {
            console.error(error);
            showSwalAlert('error', 'Error', 'No se pudieron cargar los módulos');
        }
    }

    showModules() {
        clearContainer(this.modulesContainer);

        if (this.modules.length === 0) return;

        this.modules.forEach(module => {
            const moduleElement = this.createModuleElement(module);
            this.modulesContainer.appendChild(moduleElement);
            initAccordion(moduleElement);
        });
    }

    createModuleElement(module) {
        // Implementación similar a la original pero usando funciones del módulo DOM
        // ... (código refactorizado usando createElement, createInput, etc.)
    }

    // Resto de métodos específicos de courseContent...
    // ... (addModule, createLessonElement, lessonModal, etc.)
}

// Inicialización
document.addEventListener('DOMContentLoaded', () => {
    new CourseContent();
});