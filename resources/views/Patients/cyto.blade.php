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
                <a class="nav-link" href="{{route('Patients.biopsie') }}">Biopsie</a>
              </li>
              <li class="nav-item">
                <a class="nav-link link-primary" href="{{route('Patients.cyto') }}">Cyto</a>
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
            
            
            
            
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                           @csrf
                       </form>
                        </span>
                      </a>
                    </li>
                  
                  </li>
                </ul>
              </li>


            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>

<br> <br>
      <h1 class="mx-3"> CYTO Y</h1>

      <br>
      <div class="container">
    <!-- if validation in the controller fails, show the errors -->
    @if ($errors->any())
       <div class="alert alert-danger">
         <ul>
         @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
         @endforeach
         </ul>
       </div>
    @endif
    @if ($message = Session::has('kader'))

    <div class="alert alert-success ">
    
      
           {{Session::get('kader')}}
    
    </div>
    
    @endif
    

    <div>
    
    <form action="{{ route('Patients.store') }}" method="post" enctype="multipart/form-data">
            <!-- Add CSRF Token -->
            @csrf

            <div class="form-group mt-3">
        

          <div class="row">
            <div class="col">
            <label>nom patient</label>
            <input type="text"  class="form-control" name="nom" placeholder="nom & prenom" required>
            </div>
            <div class="col">
            <label>age</label>
            <input type="text" class="form-control" name="AGE" id="fett"placeholder="47" required>
            </div>
          </div> 

        <div class="form-group">
            <label>TYPE</label>
            <input type="text" class="form-control" name="TYPE" placeholder="type de maladie" required>
        </div>
        <div class="row">
          <div class="col">
            <label class="form-label" for="typePhone">Phone number </label>
            <input type="tel" id="typePhone" name="phone" class="form-control" placeholder="0550 50 50 50"/>
          </div>

          <div class="row">
            <div class="col">
              <label class="form-label" for="prescripteur">Prescripteur </label>
              <input type="text" id="prescripteur" name="prescripteur" class="form-control" placeholder="Mr"/>
            </div>
          <div class="col">
            <label class="form-label" for="typePhone">serie unique </label>
            <input type="text" id="" name="serie" class="form-control" placeholder=""
             value="{{$R}}"/>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <label class="form-label" for="paye">payé </label>
            <input type="tel" id="paye" name="paye" class="form-control" placeholder="2000"/>
          </div>
          <div class="col">
            <label class="form-label" for="reste">reste </label>
            <input type="text" id="rest" name="reste" class="form-control" placeholder="2000"/>
          </div>
        </div>



      </div>
  
      <br>

        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>