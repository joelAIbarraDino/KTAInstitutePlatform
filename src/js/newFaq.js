import { fetchData, getCourseID } from './modules/api.js';
import { clearContainer, createElement, createInput, createTextArea, createButton } from './modules/dom.js';
import { capitalize, validateInput } from './modules/utilities.js';
import { showSwalAlert, showSwalConfirm, changeAlert, resetAlert } from './modules/alerts.js';
import { initAccordion } from './modules/accordion.js';

class FAQManager {
    constructor() {
        this.btnAdd = document.querySelector("#add_FAQ_btn");
        this.btnExit = document.querySelector("#btn-exit");
        this.FAQContainer = document.querySelector("#faq-container");
        this.containerAlert = document.querySelector("#container-alert");
        this.courseID = getCourseID();
        this.faqs = [];
        
        this.init();
    }

    async init() {
        await this.getFAQs();
        this.setupEventListeners();
    }

    setupEventListeners() {
        this.btnAdd.addEventListener('click', () => this.FAQModal());
        this.btnExit.addEventListener('click', this.showExitMessage);
    }

    async getFAQs() {
        try {
            const url = `/api/faq/${this.courseID}`;
            const response = await fetchData(url);
            this.faqs = response.faq;
            this.showFAQs();
        } catch (error) {
            console.error(error);
            showSwalAlert('error', 'Error', 'No se pudieron cargar las FAQs');
        }
    }

    showFAQs() {
        clearContainer(this.FAQContainer);

        if (this.faqs.length === 0) return;

        this.faqs.forEach(faq => {
            const faqElement = this.createFAQElement(faq);
            this.FAQContainer.appendChild(faqElement);
            initAccordion(faqElement);
        });
    }

    createFAQElement(faq) {
        
    }

    // Resto de métodos específicos de FAQs...
    // ... (FAQModal, addFAQ, updateQuestion, etc.)
}

// Inicialización
document.addEventListener('DOMContentLoaded', () => {
    new FAQManager();
});