export async function tomSelect(preselectedId = null) {
    const select = document.getElementById('select-cliente');

    if (select.tomselect) {
        select.tomselect.destroy();
    }

    const url = window.APP_URL + '/admin/clientes/TomSelect';
    const data = await fetch(url);

    if (data.ok) {
        const especies = await data.json();

        const tom = new TomSelect("#select-cliente", {
            valueField: 'value',
            labelField: 'label',
            searchField: ['label'],
            options: especies,
            sortField: {
                field: "label",
                direction: "asc"
            }
        });

        if (preselectedId) {
            tom.setValue(preselectedId); 
        }

        return tom;
    }
}
