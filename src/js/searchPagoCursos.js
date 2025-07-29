(function(){
    const inputText = document.querySelector("#search-input");
    const inputBtn = document.querySelector("#search-btn");
    const tableRows = document.querySelector("#search-result");
    const noColumns = 7;
    const endpoint = "/api/pago-curso/";
    let results = [];

    const rowTemplate = `
    <tr>
        <td>{{created_at}}</td>
        <td>{{name}}</td>
        <td>{{student}}</td>
        <td>{{email}}</td>
        <td>$ {{amount}} {{currency}}</td>
        <td>
            <span class="dashboard-table__status dashboard-table__status--{{status_class}}">{{status}}</span>
        </td>
        <td>{{method}}</td>
        <td class="dashboard-table__actions-cell">
            <a href="/kta-admin/comprobante/{{id_payment}}/{{id_student}}" class="dashboard-table__action dashboard-table__action--extra"><i class='bx bxs-file-pdf'></i></a>
        </td>
    </tr>
    `;


    inputText.addEventListener('keydown', (e)=>{
        
        if (e.key !== "Enter") return;

        const inputValue = inputText.value.trim();

        if(inputValue.length == 0)
            location.reload();

        const attribute  = isEmail(inputValue)?"email":"student";

        search(attribute, inputValue);
    })

    inputBtn.addEventListener('click', ()=>{
        const inputValue = inputText.value.trim();

        if(inputValue.length == 0)
            location.reload();

        const attribute  = isEmail(inputValue)?"email":"student";

        search(attribute, inputValue);
    });

    async function search(attribute, value){
        const url = `${endpoint}${attribute}/${value}`;

        try{
            const request = await fetch(url);
            const response = await request.json();
    
            results = response.query;
            
           showResults();
        }catch(error){
            console.log(error);
        }

    }

    function showResults(){
        clearTable();

        if(results.length == 0){
            tableRows.innerHTML = `
                <tr>
                    <td colspan="${noColumns}" class="dashboard-table__no-result">Sin resultados</td>
                </tr>
            `;
            return;
        }

        results.forEach(result =>{
            const row = renderRow(rowTemplate, result);
            tableRows.insertAdjacentHTML('beforeend', row);
        });
    }

    function renderRow(template, data) {
        return template.replace(/{{(.*?)}}/g, (_, key) => {
            if (key === "status_class") {
            return data.status === "pagado" ? "active" : "inactive";
            }

            return data[key] !== undefined ? data[key] : '';
        });
    }


    function clearTable(){
        while(tableRows.firstChild)
            tableRows.removeChild(tableRows.firstChild);
    }

    function isEmail(email) {
      const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return re.test(email);
    }

})();