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
        console.log(response)
    }).catch(error => {
        console.log(error)
    })
});