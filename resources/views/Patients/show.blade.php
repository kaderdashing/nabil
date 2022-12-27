<!DOCTYPE html>
<style>
body {
  background-color: lightblue;
}
</style>
<body>
    


      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{route('Patients.index') }}">Navbar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('Patients.index') }}">Home</a>
              </li>

              <li class="nav-item">
                <a class="nav-link link-primary" href="{{route('Patients.biopsie') }}">Biopsie</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="{{route('Patients.cyto') }}">Cyto</a>
              </li>

              <li class="nav-item dropdown link-warning">
                <a class="nav-link dropdown-toggle link-warning" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  deconnecter
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                 
                  <li><hr class="dropdown-divider"></li>
                  <li><hr class="dropdown-divider"></li>
                  <li>
                  
                    <li>
                      <a class="dropdown-item" href="{{ route('logout') }}" 
                        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-left"></i>
                        <span class="titre text-danger"><b>déconnecter</b></span>
                      </a>
					</li>
				  </li>
				</ul></li></ul></div></div></nav>
				<br><br>
				<div class="container">

							{{$patient->id }}
							{{$patient->name }}
							{{$patient->age }}
							{{$patient->type }}
							{{$patient->num }}
							{{$patient->serie }} 
							<br>
							{{$patient->description }} 

							{{$patient->choices }}

							<br>
							<a href="{{route('Patients.print' , $patient->id) }}" class="btn btn-info m-1">print</a>

							
							</div>
</body>
<script>
    
</script>

