/**
 * Módulo para validación de formularios
 * @module FormValidator
 */

const defaultMessages = {
    required: 'Este campo es obligatorio',
    email: 'Ingrese un email válido',
    number: 'Debe ser un número',
    minLength: (min) => `Mínimo ${min} caracteres`,
    maxLength: (max) => `Máximo ${max} caracteres`,
    pattern: 'El formato no es correcto'
  };
  
  /**
   * Clase para validar formularios
   */
  export class FormValidator {
    /**
     * @param {Object} config - Configuración del validador
     * @param {string} config.formId - ID del formulario
     * @param {Object} config.fields - Configuración de campos
     * @param {string} config.submitButtonId - ID del botón de enviar
     * @param {Object} [config.messages] - Mensajes personalizados
     */
    constructor(config) {
      this.form = document.getElementById(config.formId);
      this.fields = config.fields;
      this.submitButton = document.getElementById(config.submitButtonId);
      this.messages = { ...defaultMessages, ...config.messages };
      
      this.init();
    }
    
    init() {
      if (!this.form) return;
      
      if (this.submitButton) {
        this.submitButton.disabled = true;
      }
      
      Object.keys(this.fields).forEach(fieldName => {
        const field = this.form.elements[fieldName];
        if (field) {
          field.addEventListener('input', () => this.validateField(fieldName));
          field.addEventListener('blur', () => this.validateField(fieldName));
        }
      });
      
      this.validateForm();
    }
    
    validateField(fieldName) {
      const field = this.form.elements[fieldName];
      const fieldConfig = this.fields[fieldName];
      const value = field.value.trim();
      let isValid = true;
      let errorMessage = '';
      
      this.clearError(field);
      
      if (fieldConfig.required && !value) {
        isValid = false;
        errorMessage = this.messages.required;
      }
      
      if (isValid && value) {
        if (fieldConfig.type === 'email' && !this.isValidEmail(value)) {
          isValid = false;
          errorMessage = this.messages.email;
        } else if (fieldConfig.type === 'number' && isNaN(value)) {
          isValid = false;
          errorMessage = this.messages.number;
        }
      }
      
      if (isValid && value) {
        if (fieldConfig.minLength && value.length < fieldConfig.minLength) {
          isValid = false;
          errorMessage = this.messages.minLength(fieldConfig.minLength);
        } else if (fieldConfig.maxLength && value.length > fieldConfig.maxLength) {
          isValid = false;
          errorMessage = this.messages.maxLength(fieldConfig.maxLength);
        }
      }
      
      if (isValid && value && fieldConfig.pattern && !fieldConfig.pattern.test(value)) {
        isValid = false;
        errorMessage = this.messages.pattern;
      }
      
      if (!isValid) {
        this.showError(field, errorMessage);
      } else {
        this.markAsValid(field);
      }
      
      this.validateForm();
      return isValid;
    }
    
    validateForm() {
      if (!this.submitButton) return;
      
      const isFormValid = Object.keys(this.fields).every(fieldName => {
        const field = this.form.elements[fieldName];
        const value = field.value.trim();
        const fieldConfig = this.fields[fieldName];
        
        if (fieldConfig.required && !value) return false;
        if (value) {
          if (fieldConfig.type === 'email' && !this.isValidEmail(value)) return false;
          if (fieldConfig.type === 'number' && isNaN(value)) return false;
          if (fieldConfig.minLength && value.length < fieldConfig.minLength) return false;
          if (fieldConfig.maxLength && value.length > fieldConfig.maxLength) return false;
          if (fieldConfig.pattern && !fieldConfig.pattern.test(value)) return false;
        }
        return true;
      });
      
      this.submitButton.disabled = !isFormValid;
      return isFormValid;
    }
    
    showError(field, message) {
      const errorElement = document.createElement('div');
      errorElement.className = 'error-message';
      errorElement.textContent = message;
      
      field.classList.add('invalid');
      field.parentNode.appendChild(errorElement);
    }
    
    clearError(field) {
      field.classList.remove('invalid');
      const errorElement = field.parentNode.querySelector('.error-message');
      if (errorElement) {
        field.parentNode.removeChild(errorElement);
      }
    }
    
    markAsValid(field) {
      field.classList.remove('invalid');
      field.classList.add('valid');
    }
    
    isValidEmail(email) {
      const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return re.test(email);
    }
  }