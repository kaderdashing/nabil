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
            patients.innerHTML = `<table class="table" id="mytable">
            <thead class="thead-dark">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">name</th>
                <th scope="col">tel</th>
                <th scope="col">type</th>
                <th scope="col">actions</th>
              </tr>
            </thead>
            <tbody>
            `;

            Object.entries(data)[0][1].forEach(element => {
                table = document.getElementById('mytable');
                var row = ` 
                <td>${element.serie}</td>
                <td>${element.name}</td>
                <td>${element.num } </td>
                <td>${element.choices}</td>
                <td>
                <a href="{{route('Patients.show' , ${element.id}) }}" class="btn btn-info m-1">Details</a>
                         
                        <a href="{{route('Patients.edit' , ${element.id}) }}" > <button class="btn btn-primary"> editer</button></a>
                     
                     
                       
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