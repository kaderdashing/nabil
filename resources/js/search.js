const form = document.getElementById('search-form');
form.addEventListener('submit', function(e) {
    e.preventDefault();


    const token = document.querySelector('meta[name="csrf-token"]').content;
    const url = this.getAttribute('action');
    const q = document.getElementById('q').value;


    fetch(url, {
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token

        },
        method: 'post',
        body: JSON.stringify({
            q: q
        })
    }).then(response => {
        response.json().then(data => {
            const patients = document.getElementById('aaaa');
            const isadmin = data.user;
            var kader = function(isadmin) {
                if (isadmin === 1) {
                    return "fini"
                } else return ""
            }
            patients.innerHTML = `<table class="table" id="mytable">
            <thead class="thead-dark">
              <tr>
                <th scope="col">${kader(isadmin)}</th>
                <th scope="col">ID</th>
                <th scope="col">name</th>
                <th scope="col">tel</th>
                <th scope="col">type</th>
                
                <th scope="col">action</th>
              </tr>
            </thead>
            <tbody>
            `;
            /*      let func = function(arg1, arg2, ..., argN) {
  return expression;
};  */
            /*    var fini = element.fini;
                console.log(fini); */


            ///////////////////////////////////////////////////////////////////////////////

            Object.entries(data)[0][1].forEach(element => {

                table = document.getElementById('mytable');
                if (isadmin === 1) {
                    var affichage = function(sayi) {

                        if (sayi == 1) { return "oui"; } else { return "non"; }
                    }
                    var sayi = element.fini;
                } else {
                    var affichage = function(sayi) {

                        return ""
                    }

                    sayi = " ";
                }
                var row = `

                <td>${affichage(sayi)}</td>
                <td>${element.serie}</td>
                <td>${element.name}</td>
                <td>${element.num } </td>
                <td>${element.choices}</td>
                <td>
              
                <a href="Patients/${element.id} "  >
                <button class="btn btn-info m-1"> detais</button>
                          
                        <a href="Patients/${element.id}/edit "  >
                        <button class="btn btn-primary"> editer</button> 
                         </a>
                        
                         
                          <button type="submit" class="btn btn-warning ">suprimer</button>
                        
                     

                             </td>
                `;
                table.innerHTML += row
                patients.innerHTML += `
                </tbody>
                `
            });
        })
    }).catch(error => {
        console.log(error)
    })
});