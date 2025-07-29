class BuscadorTabla {
  constructor({ inputSelector, buttonSelector, tableSelector, endpoint, template, columnas, atributoBusqueda = null }) {
    this.inputText = document.querySelector(inputSelector);
    this.inputBtn = document.querySelector(buttonSelector);
    this.tableRows = document.querySelector(tableSelector);
    this.endpoint = endpoint;
    this.template = template;
    this.noColumns = columnas;
    this.results = [];

    this.atributoBusqueda = atributoBusqueda; // string o función

    this._setupEvents();
  }

  _setupEvents() {
    this.inputText.addEventListener('keydown', (e) => {
      if (e.key === "Enter") this._handleSearch();
    });

    this.inputBtn.addEventListener('click', () => {
      this._handleSearch();
    });
  }

  _handleSearch() {
    const inputValue = this.inputText.value.trim();
    if (inputValue.length === 0) {
      location.reload();
      return;
    }

    let attribute;

    if (typeof this.atributoBusqueda === 'function') {
      attribute = this.atributoBusqueda(inputValue);
    } else if (typeof this.atributoBusqueda === 'string') {
      attribute = this.atributoBusqueda;
    } else {
      // comportamiento por defecto
      attribute = this._isEmail(inputValue) ? "email" : "student";
    }

    this._search(attribute, inputValue);
  }

  async _search(attribute, value) {
    const url = `${this.endpoint}${attribute}/${value}`;
    try {
      const res = await fetch(url);
      const data = await res.json();
      this.results = data.query || [];
      this._showResults();
    } catch (err) {
      console.error("Error en búsqueda:", err);
    }
  }

  _showResults() {
    this._clearTable();

    if (this.results.length === 0) {
      this.tableRows.innerHTML = `
        <tr>
          <td colspan="${this.noColumns}" class="dashboard-table__no-result">Sin resultados</td>
        </tr>
      `;
      return;
    }

    this.results.forEach(item => {
      item.foto_html = this._renderFoto(item);
      item.iniciales = this._obtenerIniciales(item.name || '');
      const rowHTML = this._renderRow(this.template, item);
      this.tableRows.insertAdjacentHTML('beforeend', rowHTML);
    });
  }

  _renderFoto(data) {
    if (!data.photo) {
      return `
        <div class="dashboard-table__iniciales">
          ${this._obtenerIniciales(data.name || '')}
        </div>`;
    } else {
      return `<img class="dashboard-table__photo--user" src="${data.photo}" alt="foto de perfil del usuario">`;
    }
  }

  _renderRow(template, data) {
    return template.replace(/{{(.*?)}}/g, (_, key) => {
      if (key === "status_class") {
        return data.status === "pagado" ? "active" : "inactive";
      }
      return data[key] !== undefined ? data[key] : '';
    });
  }

  _obtenerIniciales(nombre) {
    const partes = nombre.trim().split(" ");
    return (partes[0]?.[0] || "") + (partes[1]?.[0] || "");
  }

  _clearTable() {
    while (this.tableRows.firstChild) {
      this.tableRows.removeChild(this.tableRows.firstChild);
    }
  }

  _isEmail(str) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(str);
  }
}
